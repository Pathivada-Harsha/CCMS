<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BEMS - Building Energy Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                        <div class="mb-3">
                            <label for="comparisonPeriod" class="form-label">Comparison Period</label>
                            <select id="comparisonPeriod" class="form-select">
                                <option value="last-week">Last Week</option>
                                <option value="last-month">Last Month</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div id="customDateRange" class="mb-3" style="display: none;">
                            <label for="dateRange" class="form-label">Custom Date Range</label>
                            <input type="text" id="dateRange" class="form-control" placeholder="Select date range">
                        </div>
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
            mainSupply: 10000,
            floorDevices: 9500,
            switchedDevices: 9000
        };

        const comparisonData = {
            'last-week': {
                labels: ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [8500, 8700, 8900, 9100, 9300, 9500, 9700, 10000],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            'last-month': {
                labels: [...Array(30).keys()].map(i => `${30-i} days ago`),
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [...Array(30)].map(() => Math.floor(Math.random() * (10000 - 8000 + 1)) + 8000),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            'custom': {
                labels: [],
                datasets: [{
                    label: 'Energy Consumption (kWh)',
                    data: [],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        };

        const deviceData = [
            { name: 'AC Unit 1', type: 'Switched', floor: '1st', currentLoad: 1000, previousLoad: 950 },
            { name: 'Lighting System 1', type: 'Switched', floor: '1st', currentLoad: 500, previousLoad: 480 },
            { name: 'AC Unit 2', type: 'Switched', floor: '2nd', currentLoad: 1200, previousLoad: 1100 },
            { name: 'Lighting System 2', type: 'Switched', floor: '2nd', currentLoad: 600, previousLoad: 570 },
            { name: 'Office Equipment', type: 'Switched', floor: '2nd', currentLoad: 800, previousLoad: 750 }
        ];

        const floorDistributionData = {
            labels: ['1st Floor', '2nd Floor', '3rd Floor'],
            datasets: [{
                label: 'Energy Consumption (kWh)',
                data: [3000, 4000, 2500],
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

        // Update energy flow overview
        document.getElementById('mainSupplyEnergy').textContent = energyData.mainSupply;
        document.getElementById('floorDevicesEnergy').textContent = energyData.floorDevices;
        document.getElementById('switchedDevicesEnergy').textContent = energyData.switchedDevices;

        // Create energy comparison chart
        const comparisonCtx = document.getElementById('energyComparisonChart').getContext('2d');
        let comparisonChart = new Chart(comparisonCtx, {
            type: 'bar',
            data: comparisonData['last-week'],
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

        // Populate device energy table
        const deviceEnergyTable = document.getElementById('deviceEnergyTable');
        deviceData.forEach(device => {
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

        // Create floor distribution chart
        const floorDistributionCtx = document.getElementById('floorDistributionChart').getContext('2d');
        new Chart(floorDistributionCtx, {
            type: 'pie',
            data: floorDistributionData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Create device type chart
        const deviceTypeCtx = document.getElementById('deviceTypeChart').getContext('2d');
        new Chart(deviceTypeCtx, {
            type: 'doughnut',
            data: deviceTypeData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Set up comparison period selection
        const comparisonPeriodSelect = document.getElementById('comparisonPeriod');
        const customDateRangeDiv = document.getElementById('customDateRange');
        const dateRangeInput = document.getElementById('dateRange');

        comparisonPeriodSelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                customDateRangeDiv.style.display = 'block';
            } else {
                customDateRangeDiv.style.display = 'none';
                updateComparisonChart(this.value);
            }
        });

        // Set up date range picker
        flatpickr(dateRangeInput, {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates) {
                if (selectedDates.length === 2) {
                    // Here you would typically fetch data for the selected date range
                    // For this example, we'll just generate random data
                    const start = selectedDates[0];
                    const end = selectedDates[1];
                    const days = (end - start) / (1000 * 60 * 60 * 24) + 1;
                    
                    comparisonData.custom.labels = [...Array(days)].map((_, i) => {
                        const date = new Date(start);
                        date.setDate(date.getDate() + i);
                        return date.toISOString().split('T')[0];
                    });
                    comparisonData.custom.datasets[0].data = [...Array(days)].map(() => 
                        Math.floor(Math.random() * (10000 - 8000 + 1)) + 8000
                    );
                    
                    updateComparisonChart('custom');
                }
            }
        });

        function updateComparisonChart(period) {
            comparisonChart.data = comparisonData[period];
            comparisonChart.update();
        }
    </script>
</body>
</html>