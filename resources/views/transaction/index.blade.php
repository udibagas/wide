@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body bg-danger text-white">
                    <div>Total</div>
                    <h1>{{number_format($total)}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body bg-info text-white">
                    <div>Qty</div>
                    <h1>{{number_format($qty)}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        @if ($date)
        <div class="card-header">{{date('d-M-Y', strtotime($date))}}</div>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Code</th>
                    <th class="text-center">Profile</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                <tr>
                    <td>{{date('H:i', strtotime($t->time))}}</td>
                    <td>{{$t->code}}</td>
                    <td class="text-center">
                        {{$t->validity}} - {{$t->profile}}
                    </td>
                    <td class="text-right">{{number_format($t->price)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        @if ($month)
        <div class="card-header">{{date('F Y', mktime(0,0,0,((int) $month), 0, date('Y') ))}}</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                <tr>
                    <td>
                        <a href="/transaction?date={{$t['date']}}">
                            {{date('d-M-Y', strtotime($t['date']))}}
                        </a>
                    </td>
                    <td class="text-center">{{$t['qty']}}</td>
                    <td class="text-right">{{number_format($t['price'])}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
