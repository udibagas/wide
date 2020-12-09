<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'today' => Transaction::whereDay('time', date('d'))
                ->whereMonth('time', date('m'))
                ->whereYear('time', date('Y'))
                ->sum('price'),

            'thisMonth' => Transaction::whereMonth('time', date('m'))
                ->whereYear('time', date('Y'))
                ->sum('price'),

            'total' => Transaction::sum('price'),

            'transactionByMonth' => Transaction::selectRaw('SUM(price) as total, COUNT(id) AS qty, MONTH(time) AS month')
                ->whereYear('time', date('Y'))
                ->groupByRaw('MONTH(time)')
                ->orderByRaw('MONTH(time) ASC')
                ->get()->map(function ($item) {
                    return [
                        'month' => date('F', strtotime(date("Y-{$item->month}-d"))),
                        'qty' => $item->qty,
                        'total' => $item->total
                    ];
                }),

            'transactionByDate' => Transaction::selectRaw('SUM(price) as total, COUNT(id) AS qty, DATE(time) AS date')
                ->whereYear('time', date('Y'))
                ->whereMonth('time', date('m'))
                ->groupByRaw('DATE(time)')
                ->orderByRaw('DATE(time) ASC')
                ->get()->map(function ($item) {
                    return [
                        'date' => date('d-M-Y', strtotime($item->date)),
                        'qty' => $item->qty,
                        'total' => $item->total
                    ];
                })
        ]);
    }
}
