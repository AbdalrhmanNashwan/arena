
    @extends('dashBoard')

    @section('content')
            <!-- Chart Container for Item Quantities -->
                <div class="row">
                    <div class="col-12 col-lg-8 card   mx-auto " style="height: 200px" >
                        <div id="itemQuantitiesChart" >
                            <canvas id="itemQuantities"></canvas>
                        </div>

                        <!-- JavaScript for Chart.js (Item Quantities Chart) -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            var itemDataCollection = @json($itemDataCollection);

                            // Extract the item names and quantities
                            var itemNames = Object.keys(itemDataCollection);
                            var itemQuantities = Object.values(itemDataCollection);
                            //sort the items by quantity
                            console.log(itemNames);
                            // Create a stunning chart (e.g., bar chart) to display item quantities
                            var ctx = document.getElementById('itemQuantities').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'bar', // You can choose other chart types (e.g., 'bar', 'line', etc.)
                                data: {
                                    labels: itemNames,
                                    datasets: [{
                                        data: itemQuantities,
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
                                            text: 'Sales of Bar Items Last 30 Days',
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
                                            text: 'Playing Hours per Device',
                                        }
                                    }
                                }
                            });
                        </script>
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
                                return new Date(a.created_at) - new Date(b.created_at);
                            });
                            for (var i = 0; i < monthlyexpenses.length; i++) {
                                //slice the date to get the month and day only
                                date.push(monthlyexpenses[i].created_at.slice(8, 10));
                            }
                            date = date.filter((value, index) => date.indexOf(value) === index);

                            //then make a list of total expenses for each date
                            var total = [];
                            for (var i = 0; i < date.length; i++) {
                                var totalCost = 0;
                                for (var j = 0; j < monthlyexpenses.length; j++) {
                                    if (monthlyexpenses[j].created_at.slice(8, 10) === date[i]) {
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
                                            text: 'Total Cost Last 30 Day (IQD)',

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
                                return new Date(a.created_at) - new Date(b.created_at);
                            });
                            for (var i = 0; i < monthlyDebts.length; i++) {
                                //slice the date to get the month and day only
                                date.push(monthlyDebts[i].created_at.slice(8, 10));
                            }
                            date = date.filter((value, index) => date.indexOf(value) === index);

                            //then make a list of total expenses for each date
                            var total = [];
                            for (var i = 0; i < date.length; i++) {
                                var totalCost = 0;
                                for (var j = 0; j < monthlyDebts.length; j++) {
                                    if (monthlyDebts[j].created_at.slice(8, 10) === date[i]) {
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
                                            text: 'Debts Last 30 Days (IQD)',

                                        },
                                        legend: {
                                            display: false,
                                        }

                                    }
                                }
                            });
                        </script>
                    </div>
                    <div class="col-12 col-lg-3 card mt-4 " >
                        <div id="averageMinutesChart4" style="height: 200px">
                            <canvas id="averageMinutes4"></canvas>
                        </div>

                        <!-- JavaScript for Chart.js (Average Minutes Chart) -->
                        <script>

                            // Create a bar chart for average playing minutes
                            var ctx2 = document.getElementById('averageMinutes4').getContext('2d');
                            var chart2 = new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: gameTypes,
                                    datasets: [{
                                        data: totalCost,
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
                                            text: 'Today Cost (IQD)',

                                        },legend: {
                                            display: false,
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>

    @endsection
