@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body bg-primary text-white">
                    <div>Today</div>
                    <h1> Rp {{number_format($today)}} </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body bg-success text-white">
                    <div>This Month</div>
                    <h1> Rp {{number_format($thisMonth)}} </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body bg-danger text-white">
                    <div>Total</div>
                    <h1> Rp {{number_format($total)}} </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> Transaction By Month </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionByMonth as $t)
                        <tr>
                            <td>{{$t['month']}}</td>
                            <td class="text-right">{{number_format($t['total'])}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> Transaction By Date </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionByDate as $t)
                        <tr>
                            <td>{{$t['date']}}</td>
                            <td class="text-right">{{number_format($t['total'])}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="text-center">
        <a href="/transaction/refresh" class="btn btn-outline-primary">REFRESH</a>
    </div> --}}
</div>
@endsection
