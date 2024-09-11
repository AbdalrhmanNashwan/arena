@extends('dashBoard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Date Selection and Search Section -->
            <div class="col-md-3 bg-light p-4">
                <h4 class="text-center mb-3">Select Date Range</h4>
                <form action="{{ route('income') }}" method="get" class="d-flex flex-column align-items-center">
                    <div class="mb-3 w-100">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="mb-3 w-100">
                        <label for="end_date" class="form-label">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div>
                        <label>Select Table to Display:</label>
                        <div>
                            <input type="radio" id="sessions" name="table" value="sessions" {{ $tableToShow == 'sessions' ? 'checked' : '' }}>
                            <label for="sessions">Sessions</label>
                            <input type="radio" id="debts" name="table" value="debts" {{ $tableToShow == 'debts' ? 'checked' : '' }}>
                            <label for="debts">Debts</label>
                            <input type="radio" id="expenses" name="table" value="expenses" {{ $tableToShow == 'expenses' ? 'checked' : '' }}>
                            <label for="expenses">Expenses</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 w-100">Search</button>
                </form>
            </div>

            <!-- Cards and Charts Section -->
            <div class="col-md-9 p-4">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center mt-4">
                    @php
                        $colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
                        $labels = [
                            'Playing Cost' => $totalPlayingCost,
                            'Bar Cost' => $totalBarCost,
                            'Debts' => $totalDebts,
                            'Expenses' => $totalExpenses,
                            'Net Income' => $totalNetIncome
                        ];
                        $i = 0;
                    @endphp
                    @foreach ($labels as $title => $value)
                        <div class="col">
                            <div class="card text-white {{ $colors[$i++] }} mb-3">
                                <div class="card-header">{{ $title }}</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ number_format($value, 2) }} IQD</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <canvas id="incomeComparisonChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Table Section: Moved outside the row to ensure it spans the entire width -->
        <div class="row mt-5">
            <div class="col-12">
                <h4>{{ ucfirst($tableToShow) }}</h4>
                @if($items->isNotEmpty())
                    <!-- Add scroll container -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                @foreach($items->first()->getAttributes() as $key => $value)
                                    <th>{{ ucfirst($key) }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    @foreach($item->getAttributes() as $key => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $items->links() }}
                @else
                    <p>No data available for the selected range.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr(".date-picker", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

            var ctx = document.getElementById('incomeComparisonChart').getContext('2d');
            var incomeComparisonChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Playing Income', 'Bar Income'],
                    datasets: [{
                        label: 'Income Comparison',
                        data: [{{ $totalPlayingCost ?? 0 }}, {{ $totalBarCost ?? 0 }}],
                        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection
