@extends('dashBoard')

@section('content')

    <div class="row">

        <div class="col-md-4    ">
            <div class="card text-white bg-info mb-3" style="">
                <div class="card-header">Total Debts</div>
                <div class="card-body">
                    <h5 class="card-title">{{  $allDebts->sum('amount') }} IQD</h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-success mb-3" style="">
                <div class="card-header">Most Repeated Name</div>
                <div class="card-body">
                    <h5 class="card-title">{{$debts->groupBy('name')->map->count()->sortDesc()->keys()->first()}} </h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-danger mb-3" style="">
                <div class="card-header">Today Debts</div>
                <div class="card-body">
                    <h5 class="card-title">{{
                    $allDebts->where('created_at', '>=', \Carbon\Carbon::today())->sum('amount')
 }} IQD</h5>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-striped table-dark">
            <thead>
            <th>ID</th>
            <th> Name</th>
            <th> Amount</th>
            <th> Reason</th>
            <th> Date</th>
            </thead>
            <tbody>
            @foreach($debts as $debt)
                <tr>
                    <td>{{$debt->id}}</td>
                    <td>{{$debt->name}}</td>
                    <td>{{$debt->amount}}</td>
                    <td>{{$debt->reason}}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($debt->created_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $debts->links() }}
        </div>

    </div>

@endsection
