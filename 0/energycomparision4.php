<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BEMS - Building Energy Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .energy-flow-card {
            transition: all 0.3s ease;
        }
        .energy-flow-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        .increased-load {
            background-color: #ffeeba;
            border-left: 5px solid #ffc107;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <header class="bg-primary text-white p-3 mb-4">
            <h1 class="h3">BEMS - Building Energy Monitoring System</h1>
        </header>

        <div class="row mb-4">
            <div class="col-12 mb-3">
                <select id="timePeriodSelect" class="form-select">
                    <option value="today">Today</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="lastWeek">Last Week</option>
                    <option value="lastMonth">Last Month</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Energy Flow Overview
                    </div>
                    <div class="card-body">
                        <div class="energy-flow-card mb-3 p-3 border rounded">
                            <h5 class="card-title">Main Supply</h5>
                            <p class="card-text">Total Energy: <span id="mainSupplyEnergy">0</span> kWh</p>
                        </div>
                        <div class="energy-flow-card mb-3 p-3 border rounded">
                            <h5 class="card-title">Floor Devices</h5>
                            <p class="card-text">Total Energy: <span id="floorDevicesEnergy">0</span> kWh</p>
                        </div>
                        <div class="energy-flow-card p-3 border rounded">
                            <h5 class="card-title">Switched Devices</h5>
                            <p class="card-text">Total Energy: <span id="switchedDevicesEnergy">0</span> kWh</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Energy Consumption Comparison
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="energyComparisonChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Device Energy Consumption
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Device</th>
                                        <th>Type</th>
                                        <th>Floor</th>
                                        <th>Current Load (kWh)</th>
                                        <th>Previous Load (kWh)</th>
                                        <th>Change</th>
                                    </tr>
                                </thead>
                                <tbody id="deviceEnergyTable">
                                    <!-- Table rows will be dynamically populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Load Distribution by Floor
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="floorDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Device Type Distribution
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="deviceTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data (replace with actual data fetching logic)
        const energyData = {
            today: {
                mainSupply: 10000,
                floorDevices: 9500,
                switchedDevices: 9000
            },
            yesterday: {
                mainSupply: 9800,
                floorDevices: 9300,
                switchedDevices: 8800
            },
            lastWeek: {
                mainSupply: 68000,
                floorDevices: 64600,
                switchedDevices: 61200
            },
            lastMonth: {
                mainSupply: 290000,
                floorDevices: 275500,
                switchedDevices: 261000
            }
        };

        const comparisonData = {
            today: {
                labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [1500, 1800, 2200, 2500, 2300, 1900],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            yesterday: {
                labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [1400, 1700, 2100, 2400, 2200, 1800],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            lastWeek: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [9500, 9800, 10200, 9900, 10500, 9200, 8900],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            lastMonth: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [68000, 72000, 75000, 70000],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        };

        const deviceData = {
            today: [
                { name: 'AC Unit 1', type: 'Switched', floor: '1st', currentLoad: 1000, previousLoad: 950 },
                { name: 'Lighting System 1', type: 'Switched', floor: '1st', currentLoad: 500, previousLoad: 480 },
                { name: 'AC Unit 2', type: 'Switched', floor: '2nd', currentLoad: 1200, previousLoad: 1100 },
                { name: 'Lighting System 2', type: 'Switched', floor: '2nd', currentLoad: 600, previousLoad: 570 },
                { name: 'Office Equipment', type: 'Switched', floor: '2nd', currentLoad: 800, previousLoad: 750 }
            ],
            yesterday: [
                { name: 'AC Unit 1', type: 'Switched', floor: '1st', currentLoad: 950, previousLoad: 920 },
                { name: 'Lighting System 1', type: 'Switched', floor: '1st', currentLoad: 480, previousLoad: 470 },
                { name: 'AC Unit 2', type: 'Switched', floor: '2nd', currentLoad: 1100, previousLoad: 1050 },
                { name: 'Lighting System 2', type: 'Switched', floor: '2nd', currentLoad: 570, previousLoad: 550 },
                { name: 'Office Equipment', type: 'Switched', floor: '2nd', currentLoad: 750, previousLoad: 730 }
            ],
            lastWeek: [
                { name: 'AC Unit 1', type: 'Switched', floor: '1st', currentLoad: 6800, previousLoad: 6500 },
                { name: 'Lighting System 1', type: 'Switched', floor: '1st', currentLoad: 3400, previousLoad: 3300 },
                { name: 'AC Unit 2', type: 'Switched', floor: '2nd', currentLoad: 8200, previousLoad: 7900 },
                { name: 'Lighting System 2', type: 'Switched', floor: '2nd', currentLoad: 4100, previousLoad: 4000 },
                { name: 'Office Equipment', type: 'Switched', floor: '2nd', currentLoad: 5500, previousLoad: 5300 }
            ],
            lastMonth: [
                { name: 'AC Unit 1', type: 'Switched', floor: '1st', currentLoad: 29000, previousLoad: 28000 },
                { name: 'Lighting System 1', type: 'Switched', floor: '1st', currentLoad: 14500, previousLoad: 14000 },
                { name: 'AC Unit 2', type: 'Switched', floor: '2nd', currentLoad: 35000, previousLoad: 34000 },
                { name: 'Lighting System 2', type: 'Switched', floor: '2nd', currentLoad: 17500, previousLoad: 17000 },
                { name: 'Office Equipment', type: 'Switched', floor: '2nd', currentLoad: 23500, previousLoad: 23000 }
            ]
        };

        const floorDistributionData = {
            today: {
                labels: ['1st Floor', '2nd Floor'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [1500, 2600],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            yesterday: {
                labels: ['1st Floor', '2nd Floor'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [1430, 2420],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            lastWeek: {
                labels: ['1st Floor', '2nd Floor'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [10200, 17800],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            lastMonth: {
                labels: ['1st Floor', '2nd Floor'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [43500, 76000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        };

        const deviceTypeData = {
            labels: ['AC Units', 'Lighting Systems', 'Office Equipment'],
            datasets: [{
                label: 'Number of Devices',
                data: [2, 2, 1],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Initialize charts
        let comparisonChart, floorDistributionChart, deviceTypeChart;

        function initCharts() {
            const comparisonCtx = document.getElementById('energyComparisonChart').getContext('2d');
            comparisonChart = new Chart(comparisonCtx, {
                type: 'bar',
                data: comparisonData.today,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const floorDistributionCtx = document.getElementById('floorDistributionChart').getContext('2d');
            floorDistributionChart = new Chart(floorDistributionCtx, {
                type: 'pie',
                data: floorDistributionData.today,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            const deviceTypeCtx = document.getElementById('deviceTypeChart').getContext('2d');
            deviceTypeChart = new Chart(deviceTypeCtx, {
                type: 'doughnut',
                data: deviceTypeData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        function updateCharts(period) {
            comparisonChart.data = comparisonData[period];
            comparisonChart.update();

            floorDistributionChart.data = floorDistributionData[period];
            floorDistributionChart.update();
        }

        function updateEnergyFlow(period) {
            document.getElementById('mainSupplyEnergy').textContent = energyData[period].mainSupply;
            document.getElementById('floorDevicesEnergy').textContent = energyData[period].floorDevices;
            document.getElementById('switchedDevicesEnergy').textContent = energyData[period].switchedDevices;
        }

        function updateDeviceTable(period) {
            const deviceEnergyTable = document.getElementById('deviceEnergyTable');
            deviceEnergyTable.innerHTML = '';
            deviceData[period].forEach(device => {
                const row = deviceEnergyTable.insertRow();
                row.insertCell(0).textContent = device.name;
                row.insertCell(1).textContent = device.type;
                row.insertCell(2).textContent = device.floor;
                row.insertCell(3).textContent = device.currentLoad;
                row.insertCell(4).textContent = device.previousLoad;
                const changeCell = row.insertCell(5);
                const change = ((device.currentLoad - device.previousLoad) / device.previousLoad * 100).toFixed(2);
                changeCell.textContent = `${change}%`;
                if (change > 5) {
                    row.classList.add('increased-load');
                    changeCell.innerHTML += ' <i class="bi bi-arrow-up-circle-fill text-danger"></i>';
                }
            });
        }

        function updateDashboard() {
            const period = document.getElementById('timePeriodSelect').value;
            updateEnergyFlow(period);
            updateCharts(period);
            updateDeviceTable(period);
        }

        // Initialize the dashboard
        initCharts();
        updateDashboard();

        // Add event listener for time period selection
        document.getElementById('timePeriodSelect').addEventListener('change', updateDashboard);
    </script>
</body>
</html>