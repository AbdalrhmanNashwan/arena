@extends('dashBoard')

@section('content')
    <style>
        .table-striped.table-dark th,
        .table-striped.table-dark td:nth-child(5) {
            max-width: 200px; /* Adjust the maximum width as needed */
            overflow-wrap: break-word;
        }
        .table td, .table th {

            font-size: 0.9rem;
        }
    </style>
    <div class="row">

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3" style="">
                <div class="card-header">Today's Sessions</div>
                <div class="card-body">
                    <h5 class="card-title">{{
       $todaySessions->count()
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
    $todaySessions->sum('total_cost')
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
            <th>Actions</th>
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
                    <td>{{ date('Y-m-d H:i', strtotime($session->date))}}</td>
                    <td>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $session->id }}">
                                Edit
                            </button>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $session->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="deleteModal{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $session->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $session->id }}">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this session?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('session.destroy', $session->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Add this code inside the loop where you generate modals for each debt -->
                <div class="modal fade" id="editModal{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $session->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $session->id }}">Edit Debt</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('session.update', $session->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <label for="amount">Total Cost (Before)</label>
                                        <input type="text" class="form-control" id="total_cost" name="total_cost" value="{{ $session->total_cost }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Promo</label>
                                        <input type="text" class="form-control" id="promo_percent" name="promo_percent" value="{{ $session->promo_percent }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Total Cost (After)</label>
                                        <input type="text" class="form-control" id="cost_after_promo" name="cost_after_promo" value="{{ $session->cost_after_promo }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Amount</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            </tbody>
        </table>
        <div class="">
            {{
     $sessions->links()
      }}
        </div>

    </div>

@endsection
