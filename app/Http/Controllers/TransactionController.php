<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Transaction::when($request->date, function ($q) use ($request) {
            $q->whereRaw('DATE(time) = ?', [$request->date]);
        })->when($request->month, function ($q) use ($request) {
            $q->selectRaw('SUM(price) as price, COUNT(id) AS qty, DATE(time) AS date')
                ->groupByRaw('DATE(time)')
                ->orderByRaw('DATE(time) ASC')
                ->whereMonth('time', $request->month);
        })->whereYear('time', date('Y'));

        return view('transaction.index', [
            'transactions' => $request->month ? $query->get()->map(function ($item) {
                return [
                    'date' => date('Y-m-d', strtotime($item->date)),
                    'qty' => $item->qty,
                    'price' => $item->price
                ];
            }) : $query->get(),

            'qty' => $query->count(),
            'total' => $query->sum('price'),
            'date' => $request->date,
            'month' => $request->month,
        ]);
    }
}
