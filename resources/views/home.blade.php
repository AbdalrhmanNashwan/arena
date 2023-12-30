
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
                            // Get the data passed from the controller
                            var itemNames = @json($itemNames);
                            var itemQuantities = @json($itemQuantities);

                            // Create a stunning chart (e.g., pie chart) to display item quantities
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
                                    },

                                    ]
                                },
                                options: {
                                    maintainAspectRatio: false,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Sales of Bar Items',
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

                        <!-- JavaScript for Chart.js (Average Minutes Chart) -->
                        <script>
                            // Get the data passed from the controller
                            var sessionDevices = @json($sessionsDevices);

                            // Extract device numbers and total minutes from the data
                            var gameTypes = sessionDevices.map(session => session.game_type);
                            var averageMinutes = sessionDevices.map(session => session.hours_played);

                            // Create a bar chart for average playing minutes
                            var ctx2 = document.getElementById('averageMinutes').getContext('2d');
                            var chart2 = new Chart(ctx2, {
                                type: 'pie',
                                data: {
                                    labels: gameTypes,
                                    datasets: [{
                                        data: averageMinutes,
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
                            // Get the data passed from the controller
                            var itemNames = @json($itemNames);
                            var itemQuantities = @json($itemQuantities);

                            // Create a stunning chart (e.g., pie chart) to display item quantities
                            var ctx = document.getElementById('itemQuantities2').getContext('2d');

                            // Create a bar chart for average playing minutes
                            var ctx2 = document.getElementById('itemQuantities2').getContext('2d');
                            var chart2 = new Chart(ctx2, {
                                type: 'line',
                                data: {
                                    labels:  ['1','2','3','4','5','6','7','8','9','10','11','12'
                                        ,'13','14','15','16','17','18','19','20','21','22','23','24','25','26','27',
                                        '28','29','30','31'
                                    ],
                                    datasets: [{
                                        data: averageMinutes,
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
                                            text: 'Monthly Expenses (IQD)',

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
                            // Get the data passed from the controller
                            var sessionDevices = @json($sessionsDevices);

                            // Extract device numbers and total minutes from the data
                            var gameTypes = sessionDevices.map(session => session.game_type);
                            var averageMinutes = sessionDevices.map(session => session.hours_played);

                            // Create a bar chart for average playing minutes
                            var ctx2 = document.getElementById('averageMinutes2').getContext('2d');
                            var chart2 = new Chart(ctx2, {
                                type: 'doughnut',
                                data: {
                                    labels: gameTypes,
                                    datasets: [
                                        {
                                            data: averageMinutes,
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
                                            text: 'Profit per Device (IQD)',

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
                            // Get the data passed from the controller
                            var itemNames = @json($itemNames);
                            var itemQuantities = @json($itemQuantities);


                            // Create a bar chart for average playing minutes
                            var ctx2 = document.getElementById('itemQuantities3').getContext('2d');
                            var chart2 = new Chart(ctx2, {
                                type: 'line',
                                data: {
                                    labels: ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'],
                                    datasets: [{
                                        data: averageMinutes,
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
                                            text: 'Yearly Profits (IQD)',

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
                            // Get the data passed from the controller
                            var sessionDevices = @json($sessionsDevices);

                            // Extract device numbers and total minutes from the data
                            var gameTypes = sessionDevices.map(session => session.game_type);
                            var averageMinutes = sessionDevices.map(session => session.hours_played);

                            // Create a bar chart for average playing minutes
                            var ctx2 = document.getElementById('averageMinutes4').getContext('2d');
                            var chart2 = new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: gameTypes,
                                    datasets: [{
                                        data: averageMinutes,
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
                                            text: 'Expenses (IQD)',

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
