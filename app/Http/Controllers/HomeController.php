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

            'transactionByMonth' => Transaction::selectRaw('SUM(price) as total, MONTH(time) AS month')
                ->groupByRaw('MONTH(time)')
                ->orderByRaw('MONTH(time) ASC')
                ->get()->map(function ($item) {
                    return [
                        'month' => date('F', strtotime(date("Y-{$item->month}-d"))),
                        'total' => $item->total
                    ];
                }),

            'transactionByDate' => Transaction::selectRaw('SUM(price) as total, DATE(time) AS date')
                ->groupByRaw('DATE(time)')
                ->orderByRaw('DATE(time) ASC')
                ->get()->map(function ($item) {
                    return [
                        'date' => date('d-M-Y', strtotime($item->date)),
                        'total' => $item->total
                    ];
                })
        ]);
    }
}
