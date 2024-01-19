@extends('dashBoard')

@section('content')
    <style>
        .paid-debt td {
            text-decoration: line-through;
            color: #6c757d;
        }
    </style>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Debts</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $allDebts->where('paid', false)->sum('amount') }} IQD</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Most Repeated Name</div>
                <div class="card-body">
                    <h5 class="card-title">{{$debts->groupBy('name')->map->count()->sortDesc()->keys()->first()}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Today Debts</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $allDebts->where('date', '>=', \Carbon\Carbon::today())->where('paid', false)->sum('amount') }} IQD</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 ">
        <div class="text-right">
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#createDebtModal" style="margin-bottom: 10px">
            Create New Debt
        </button>
        </div>

        <table class="table table-striped table-dark">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Paid</th>
            <th>Paid Date</th>
            <th>Date</th>
            <th>Actions</th>
            </thead>
            <tbody>
            @foreach($debts as $debt)
                <tr class="{{ $debt->paid ? 'paid-debt' : '' }}">
                    <td>{{$debt->id}}</td>
                    <td>{{$debt->name}}</td>
                    <td>{{$debt->amount}}</td>
                    <td>{{$debt->reason}}</td>
                    <td>
                        <form action="{{ route('debt.updatePaidStatus', $debt->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="debt-{{ $debt->id }}" name="paid" onchange="this.form.submit()" {{ $debt->paid ? 'checked' : '' }}>
                                <label class="custom-control-label" for="debt-{{ $debt->id }}"></label>
                            </div>
                        </form>
                    </td>
                    <td>{{ $debt->paid_date ? date('Y-m-d H:i', strtotime($debt->paid_date)) : '' }}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($debt->date))}}</td>
                    <td>
                        @if(!$debt->paid)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $debt->id }}">Edit</button>
                        @endif
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $debt->id }}">Delete</button>
                    </td>
                </tr>

                <div class="modal fade" id="deleteModal{{ $debt->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $debt->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $debt->id }}">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this debt?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('debt.destroy', $debt->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{ $debt->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $debt->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $debt->id }}">Edit Debt</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('debt.updateAmount', $debt->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount" value="{{ $debt->amount }}">
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
        <div class="pagination justify-content-center">
            {{ $debts->links() }}
        </div>
    </div>

    <div class="modal fade" id="createDebtModal" tabindex="-1" role="dialog" aria-labelledby="createDebtModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDebtModalLabel">Create New Debt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('debt.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>

                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <input type="text" class="form-control" id="reason" name="reason" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Debt</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
