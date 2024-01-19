@extends('dashBoard')

@section('content')
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card text-white bg-info mb-3"  style="height: 150px ">
                <div class="card-header">Today's Income</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{
   $todayIncome
   }} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 mx-auto" >
            <div class="card text-white bg-success mb-3"  style="height: 150px">
                <div class="card-header">Monthly Income</div>
                <div class="card-body">
                    <h5 class="card-title">

                        {{ $monthlyIncome }} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-2  card  mx-auto" style='height: 150px ' >
            <div>
                <canvas id="bar-session"  style="height: 145px "></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var ctx = document.getElementById('bar-session').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'doughnut', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: ['Sessions', 'Bar'],
                        datasets: [{
                            data: [{{$todayDeviceIncome}}, {{$todayBarIncome}}],
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
                                text: "Today's Income",
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
        <div class="col-md-2  card mx-auto " style='height: 150px ' >
            <div>
                <canvas id="bar-session-monthly"  style="height: 145px "></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var ctx = document.getElementById('bar-session-monthly').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'doughnut', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: ['Sessions', 'Bar'],
                        datasets: [{
                            data: [{{$monthlyDeviceIncome}}, {{$monthlyBarIncome}}],
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
                                text: "Monthly Income",
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
        <div class="col-md-4 mx-auto">
            <div class="card text-white bg-danger mb-3" style="
            margin-right: 0px;
            margin-left: 15px;
            height: 150px
            ">
                <div class="card-header">Today's Net Income</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$todayNetIncome}} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-4 mx-auto">
            <div class="card text-white bg-warning mb-3" style="height: 150px " >
                <div class="card-header">Monthly Net Income</div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $monthlyNetIncome }} IQD
                    </h5>

                </div>
            </div>
        </div>
        <div class="col-md-2 mx-auto card  " style='height: 150px ' >
            <div>
                <canvas id="bar-session-net"  style="height: 145px "></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var ctx = document.getElementById('bar-session-net').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'doughnut', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: ['Sessions', 'Bar'],
                        datasets: [{
                            data: [{{$todayNetIncomeDevice}}, {{$todayBarIncome}}],
                            backgroundColor: [

                                'rgba(255, 206, 86, 0.6)',

                                'rgba(153, 102, 255, 0.6)',
                            ],
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: "Today's Net Income",
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
        <div class="col-md-2 mx-auto card  " style='height: 150px ' >
            <div>
                <canvas id="bar-session-monthly-net"  style="height: 145px "></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var ctx = document.getElementById('bar-session-monthly-net').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'doughnut', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: ['Sessions', 'Bar'],
                        datasets: [{
                            data: [{{$monthlyNetIncome}}, {{$monthlyBarIncome}}],
                            backgroundColor: [

                                'rgba(255, 206, 86, 0.6)',

                                'rgba(153, 102, 255, 0.6)',
                            ],
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: "Monthly Net Income",
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
        <div class="col-12 col-lg-6 card  mx-auto " style="height: 200px ">
            <div>
                <canvas id="income"></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var monthlySessionsList = @json($monthlySessionsList);
                //first make a list of unique dates
                var date = [];
                //sort the expenses by date
                monthlySessionsList.sort(function (a, b) {
                    return new Date(a.date) - new Date(b.date);
                });
                for (var i = 0; i < monthlySessionsList.length; i++) {
                    //slice the date to get the month and day only
                    date.push(monthlySessionsList[i].date.slice(8, 10));
                }
                date = date.filter((value, index) => date.indexOf(value) === index);

                var total = [];
                for (var i = 0; i < date.length; i++) {
                    var totalCost = 0;
                    for (var j = 0; j < monthlySessionsList.length; j++) {
                        if (monthlySessionsList[j].date.slice(8, 10) === date[i]) {
                            totalCost += monthlySessionsList[j].cost_after_promo;
                        }
                    }
                    total.push(totalCost);
                }


                var ctx = document.getElementById('income').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: date,
                        datasets: [{
                            data: total,
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
                                text: "Monthly Income",
                            },
                            legend: {
                                display: false,
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>

        <div class="col-12 col-lg-6 card   mx-auto " style="height: 200px">
            <div>
                <canvas id="Yearlyincome"></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var yearlySessionsList = @json($yearlySessionsList);
                //first make a list of unique dates
                var date = [];
                //sort the expenses by date for year
                yearlySessionsList.sort(function (a, b) {
                    return new Date(a.date) - new Date(b.date);
                });
                for (var i = 0; i < yearlySessionsList.length; i++) {
                    //slice the date to get the month and day only
                    date.push(yearlySessionsList[i].date.slice(5, 7));
                }
                date = date.filter((value, index) => date.indexOf(value) === index);
                total = [];
                for (var i = 0; i < date.length; i++) {
                    var totalCost = 0;
                    for (var j = 0; j < yearlySessionsList.length; j++) {
                        if (yearlySessionsList[j].date.slice(5, 7) === date[i]) {
                            totalCost += yearlySessionsList[j].cost_after_promo;
                        }
                    }
                    total.push(totalCost);
                }


                var ctx = document.getElementById('Yearlyincome').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: date,
                        datasets: [{
                            data: total,
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
                                text: "Yearly Income",
                            },
                            legend: {
                                display: false,
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
        <div class="col-12 col-lg-6 card   mx-auto " style="height: 200px">
            <div>
                <canvas id="MonthlyNetIncome"></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var monthlySessionsList = @json($monthlySessionsList);
                //first make a list of unique dates
                var date = [];
                //sort the expenses by date
                monthlySessionsList.sort(function (a, b) {
                    return new Date(a.date) - new Date(b.date);
                });
                for (var i = 0; i < monthlySessionsList.length; i++) {
                    //slice the date to get the month and day only
                    date.push(monthlySessionsList[i].date.slice(8, 10));
                }
                date = date.filter((value, index) => date.indexOf(value) === index);

                var total = [];
                for (var i = 0; i < date.length; i++) {
                    var totalCost = 0;
                    for (var j = 0; j < monthlySessionsList.length; j++) {
                        if (monthlySessionsList[j].date.slice(8, 10) === date[i]) {
                            totalCost += monthlySessionsList[j].cost_after_promo;
                        }
                    }
                    total.push(totalCost);
                }
                //subtract the expenses from the income
                var monthlyExpensesList = @json($monthlyExpensesList);
                var monthlyDebtsList = @json($monthlyDebtsList);
                var monthlyNetIncome = [];
                for (var i = 0; i < date.length; i++) {
                    var totalExpenses = 0;
                    var totalDebts = 0;
                    for (var j = 0; j < monthlyExpensesList.length; j++) {
                        if (monthlyExpensesList[j].date.slice(8, 10) === date[i]) {
                            totalExpenses += monthlyExpensesList[j].amount;
                        }
                    }
                    for (var j = 0; j < monthlyDebtsList.length; j++) {
                        if (monthlyDebtsList[j].date.slice(8, 10) === date[i]) {
                            totalDebts += monthlyDebtsList[j].amount;
                        }
                    }

                    monthlyNetIncome.push((total[i] - totalExpenses) - totalDebts);

                }


                var ctx = document.getElementById('MonthlyNetIncome').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: date,
                        datasets: [{
                            data: monthlyNetIncome,
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
                                text: "Monthly Net Income",
                            },
                            legend: {
                                display: false,
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
        <div class="col-12 col-lg-6 card   mx-auto " style="height: 200px">
            <div>
                <canvas id="YearlyNetIncome"></canvas>
            </div>

            <!-- JavaScript for Chart.js (Item Quantities Chart) -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>


                var yearlySessionsList = @json($yearlySessionsList);
                //first make a list of unique dates
                var date = [];
                //sort the expenses by date for year
                yearlySessionsList.sort(function (a, b) {
                    return new Date(a.date) - new Date(b.date);
                });
                for (var i = 0; i < yearlySessionsList.length; i++) {
                    //slice the date to get the month and day only
                    date.push(yearlySessionsList[i].date.slice(5, 7));
                }
                date = date.filter((value, index) => date.indexOf(value) === index);
                total = [];
                for (var i = 0; i < date.length; i++) {
                    var totalCost = 0;
                    for (var j = 0; j < yearlySessionsList.length; j++) {
                        if (yearlySessionsList[j].date.slice(5, 7) === date[i]) {
                            totalCost += yearlySessionsList[j].cost_after_promo;
                        }
                    }
                    total.push(totalCost);
                }
                //subtract the expenses from the income
                var yearlyExpensesList = @json($yearlyExpensesList);
                var yearlyDebtsList = @json($yearlyDebtsList);
                var yearlyNetIncome = [];
                for (var i = 0; i < date.length; i++) {
                    var totalExpenses = 0;
                    var totalDebts = 0;
                    for (var j = 0; j < yearlyExpensesList.length; j++) {
                        if (yearlyExpensesList[j].date.slice(5, 7) === date[i]) {
                            totalExpenses += yearlyExpensesList[j].amount;
                        }
                    }
                    for (var j = 0; j < yearlyDebtsList.length; j++) {
                        if (yearlyDebtsList[j].date.slice(5, 7) === date[i]) {
                            totalDebts += yearlyDebtsList[j].amount;
                        }
                    }

                    yearlyNetIncome.push(total[i] - totalExpenses - totalDebts);
                }


                var ctx = document.getElementById('YearlyNetIncome').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                    data: {
                        labels: date,
                        datasets: [{
                            data: yearlyNetIncome,
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',

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
                                text: "Yearly Net Income",
                            },
                            legend: {
                                display: false,
                            }
                        }
                        // You can customize chart options here (e.g., title, legend, etc.)
                    }
                });
            </script>
        </div>
    </div>
@endsection
