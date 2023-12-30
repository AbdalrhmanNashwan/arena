@extends('dashBoard')

@section('content')

    <div class="row">

        <div class="col-md-4 ">
            <div class="card text-white bg-info mb-3" style="">
                <div class="card-header">Total Expenses</div>
                <div class="card-body">
                    <h5 class="card-title">{{  $allExpenses->sum('amount') }} IQD</h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-success mb-3" style="">
                <div class="card-header">Most Repeated Category</div>
                <div class="card-body">
                    <h5 class="card-title">{{$expenses->groupBy('category')->map->count()->sortDesc()->keys()->first()}} </h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-danger mb-3" style="">
                <div class="card-header">Today Expense</div>
                <div class="card-body">
                    <h5 class="card-title">{{
                    $allExpenses->where('created_at', '>=', \Carbon\Carbon::today())->sum('amount')
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
            <th> Category</th>
            <th> Notes</th>
            <th> Date</th>
            </thead>
            <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{$expense->id}}</td>
                    <td>{{$expense->name}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->category}}</td>
                    <td>{{$expense->notes}}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($expense->created_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $expenses->links() }}
        </div>

    </div>

@endsection
