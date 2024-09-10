
@extends('dashBoard')

@section('content')
    <!-- Chart Container for Item Quantities -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="row">
        <div class="col-md-3 mx-auto">
            <div class="card text-white bg-danger mb-3"  style="height: 150px ">
                <div class="card-header">Current Month Income</div>
                <div class="card-body">
                    <h5 class="card-title">
                       {{$currentMonthIncome}} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card text-white bg-info mb-3"  style="height: 150px ">
                <div class="card-header">Current Month Debts</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$currentMonthDebts}} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card text-white bg-success mb-3"  style="height: 150px ">
                <div class="card-header">Current Month Expenses</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$currentMonthExpenses}} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card text-white bg-warning mb-3"  style="height: 150px ">
                <div class="card-header">Current Month Net Income</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$currentMonthNet}} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 card mt-4 mx-auto " style="height: 200px">
            <div id="averageMinutesChart" >
                <canvas id="itemQuantities2"></canvas>

            </div>

            <!-- JavaScript for Chart.js (Average Minutes Chart) -->
            <script>
                //get the monthly expenses
                var monthlyexpenses = @json($monthlyExpenses);
                //first make a list of unique dates
                var date = [];
                //sort the expenses by date
                monthlyexpenses.sort(function (a, b) {
                    return new Date(a.date) - new Date(b.date);
                });
                for (var i = 0; i < monthlyexpenses.length; i++) {
                    //slice the date to get the month and day only
                    date.push(monthlyexpenses[i].date.slice(8, 10));
                }
                date = date.filter((value, index) => date.indexOf(value) === index);

                //then make a list of total expenses for each date
                var total = [];
                for (var i = 0; i < date.length; i++) {
                    var totalCost = 0;
                    for (var j = 0; j < monthlyexpenses.length; j++) {
                        if (monthlyexpenses[j].date.slice(8, 10) === date[i]) {
                            totalCost += monthlyexpenses[j].amount;
                        }
                    }
                    total.push(totalCost);
                }
                var ctx = document.getElementById('itemQuantities2').getContext('2d');

                // Create a bar chart for average playing minutes
                var ctx2 = document.getElementById('itemQuantities2').getContext('2d');
                var chart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels:  date,
                        datasets: [{
                            data: total,
                            backgroundColor: [
                                //suggest colors
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                            ],

                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Expenses Last 30 Days (IQD)',

                            },   legend: {
                                display: false,
                            }

                        }
                    }
                });
            </script>
        </div>
        <div class="col-12 col-lg-3 card mt-4 ">
            <div id="averageMinutesChart" style="height: 200px" >
                <canvas id="averageMinutes2"></canvas>
            </div>

            <!-- JavaScript for Chart.js (Average Minutes Chart) -->
            <script>

                var totalCostCollection = @json($totalCostCollection);

                // Extract device numbers and total minutes from the data
                var gameTypes = Object.keys(totalCostCollection);
                var totalCost = Object.values(totalCostCollection);

                // Create a bar chart for average playing minutes
                var ctx2 = document.getElementById('averageMinutes2').getContext('2d');
                var chart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: gameTypes,
                        datasets: [
                            {
                                data: totalCost,
                                backgroundColor: [
                                    //suggest colors
                                    'rgba(255, 159, 64, 0.6)' ,
                                    'rgba(75, 192, 128, 0.6)',
                                    'rgba(255, 99, 71, 0.6)' ,
                                    'rgba(0, 128, 128, 0.6)',
                                    'rgba(218, 112, 214, 0.6)' ,
                                ],



                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Current Month Total Cost (IQD)',

                            },

                        }
                    }
                });
            </script>
        </div>
        <div class="col-12 col-lg-8 card mt-4 mx-auto "style="height: 200px" >
            <div id="averageMinutesChart" >
                <canvas id="itemQuantities3"></canvas>
            </div>

            <!-- JavaScript for Chart.js (Average Minutes Chart) -->
            <script>
                var monthlyDebts = @json($monthlyDebts);
                //first make a list of unique dates
                var date = [];
                //sort the expenses by date
                monthlyDebts.sort(function (a, b) {
                    return new Date(a.date) - new Date(b.date);
                });
                for (var i = 0; i < monthlyDebts.length; i++) {
                    //slice the date to get the month and day only
                    date.push(monthlyDebts[i].date.slice(8, 10));
                }
                date = date.filter((value, index) => date.indexOf(value) === index);

                //then make a list of total expenses for each date
                var total = [];
                for (var i = 0; i < date.length; i++) {
                    var totalCost = 0;
                    for (var j = 0; j < monthlyDebts.length; j++) {
                        if (monthlyDebts[j].date.slice(8, 10) === date[i]) {
                            totalCost += monthlyDebts[j].amount;
                        }
                    }
                    total.push(totalCost);
                }

                // Create a bar chart for average playing minutes
                var ctx2 = document.getElementById('itemQuantities3').getContext('2d');
                var chart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: date,
                        datasets: [{
                            data: total,
                            backgroundColor: [
                                //suggest colors
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                            ],

                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Debts Current Month (IQD)',

                            },
                            legend: {
                                display: false,
                            }

                        }
                    }
                });
            </script>
        </div>
        <div class="col-12 col-lg-3 card  " >
            <div id="averageMinutesChart2" style="height: 200px">
                <canvas id="averageMinutes"></canvas>
            </div>
            <script>
                var sessiondevices = @json($sessionsDevices);

                //extract the game types without duplicates
                var gameTypes = sessiondevices.map(session => session.game_type);
                gameTypes = gameTypes.filter((value, index) => gameTypes.indexOf(value) === index);
                //extract the total minutes for each game type
                var totalHoursList = [];
                for (var i = 0; i < gameTypes.length; i++) {
                    var totalHours = 0;
                    for (var j = 0; j < sessiondevices.length; j++) {
                        if (sessiondevices[j].game_type === gameTypes[i]) {
                            totalHours += sessiondevices[j].minutes_played/60;
                        }
                    }
                    totalHoursList.push(totalHours.toFixed(2));
                }
                var ctx2 = document.getElementById('averageMinutes').getContext('2d');
                var chart2 = new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: gameTypes,
                        datasets: [{
                            data: totalHoursList,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                            ],

                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Playing Hours per Device (Current Month)',
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>

@endsection
