@extends('dashBoard')

@section('content')
    <style>
        .table-striped.table-dark th,
        .table-striped.table-dark td:nth-child(5) {
            max-width: 200px; /* Adjust the maximum width as needed */
            overflow-wrap: break-word;
        }
    </style>
    <div class="row">

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3" style="">
                <div class="card-header">Most Played Device</div>
                <div class="card-body">
                    <h5 class="card-title">{{
                    $allSessions->groupBy('game_type')->map->count()->sortDesc()->keys()->first()
}}</h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-success mb-3" style="">
                <div class="card-header">Average playing Time(Minutes)</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{
                    //show average playing minutes with one decimal
                    number_format($allSessions->avg('minutes_played'), 1)
}}
Minutes
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-danger mb-3" style="">
                <div class="card-header">Today Income</div>
                <div class="card-body">
                    <h5 class="card-title">{{
                    $allSessions->where('created_at', '>=', \Carbon\Carbon::today())->sum('total_cost')
 }} IQD</h5>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-striped table-dark">
            <thead>
            <th>ID</th>
            <th>Type</th>
            <th>Minutes</th>
            <th>Room Cost</th>
            <th>Bar Items</th>
            <th>Bar Cost</th>
            <th>Total Cost</th>
            <th>Promo</th>
            <th>New Cost</th>
            <th>Group</th>
            <th>Card</th>
            <th>Card Type</th>
            <th>Date</th>
            </thead>
            <tbody>
            @foreach($sessions as $session)
                <tr>
                    <td>{{$session->id}}</td>
                    <td>{{$session->game_type}}</td>
                    <td>{{$session->minutes_played}}</td>
                    <td>{{$session->room_cost}}</td>
                    <td>{{$session->bar_items}}</td>
                    <td>{{$session->bar_cost}}</td>
                    <td>{{$session->total_cost}}</td>
                    <td>{{$session->promo_percent}}</td>
                    <td>{{$session->cost_after_promo}}</td>
                    <td>{{$session->group}}</td>
                    <td>{{$session->card}}</td>
                    <td>{{$session->card_type}}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($session->created_at))}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $sessions->links() }}
        </div>

    </div>

@endsection
