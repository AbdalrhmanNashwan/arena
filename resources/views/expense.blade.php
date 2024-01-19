@extends('dashBoard')

@section('content')

    <div class="row">

        <div class="col-md-4 ">
            <div class="card text-white bg-info mb-3" style="">
                <div class="card-header">Monthly Expenses</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $allExpenses->where('date', '>=', \Carbon\Carbon::now()->subMonth())->sum('amount') }}
                        IQD</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-success mb-3" style="">
                <div class="card-header">Most Repeated Category</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $expenses->groupBy('category')->map->count()->sortDesc()->keys()->first() }} </h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card text-white bg-danger mb-3" style="">
                <div class="card-header">Today Expense</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $allExpenses->where('date', '>=', \Carbon\Carbon::today())->sum('amount') }}
                        IQD</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createExpenseModal"
                    style="margin-bottom: 10px">
                Create New Expense
            </button>
        </div>

        <table class="table table-striped table-dark">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Notes</th>
            <th>Date</th>
            <th>Actions</th>
            </thead>
            <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>{{ $expense->notes }}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($expense->date)) }}</td>
                    <td>

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editModal{{ $expense->id }}">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $expense->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="deleteModal{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $expense->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $expense->id }}">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Expense?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('expense.destroy', $expense->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>


                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Add this code inside the loop where you generate modals for each expense -->
                <div class="modal fade" id="editModal{{ $expense->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="editModalLabel{{ $expense->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $expense->id }}">Edit Expense</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('expense.updateAmount', $expense->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <!-- Input field for editing amount -->
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount"
                                               value="{{ $expense->amount }}">
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
            {{ $expenses->links() }}
        </div>
    </div>

    <div class="modal fade" id="createExpenseModal" tabindex="-1" role="dialog" aria-labelledby="createExpenseModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createExpenseModalLabel">Create New Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('expense.store') }}" method="POST">
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
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" class="form-control" id="notes" name="notes" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Expense</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
