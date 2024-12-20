<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();
$sessionVars = SessionManager::SessionVariables();

$mobile_no = $sessionVars['mobile_no'];
$user_id = $sessionVars['user_id'];
$role = $sessionVars['role'];

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BEMS - Building Energy Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.0/chartjs-plugin-zoom.min.js"></script>
    <style>
        .energy-flow-card {
            transition: all 0.3s ease;
        }

        .energy-flow-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        #customDateRange {
            display: none;
        }
    </style>
</head>
<?php
    include(BASE_PATH . "assets/html/start-page.php");
    ?>
<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 main-content ">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col-12 p-0">
                    <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Energy Comparision</span></p>
                </div>
            </div>
            <?php
            include(BASE_PATH . "dropdown-selection/device-list.php");
            ?>

            <div class="container-fluid">
                <!-- <header class="bg-primary text-white p-2 mb-3 mt-2">
                    <h1 class="h3">BEMS - Building Energy Monitoring System</h1>
                </header> -->

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <select id="timePeriodSelect" class="form-select">
                            <option value="lastDay">Last Day vs Today</option>
                            <option value="lastWeek">Last Week vs This Week</option>
                            <option value="lastMonth">Last Month vs This Month</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" id="customDateRange" class="form-control" placeholder="Select date range">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Energy Flow Overview
                            </div>
                            <div class="card-body">
                                <div class="energy-flow-card mb-3 p-3 border rounded">
                                    <h5 class="card-title">Main Supply</h5>
                                    <p class="card-text">Current: <span id="mainSupplyEnergyCurrent">0</span> kWh</p>
                                    <p class="card-text">Previous: <span id="mainSupplyEnergyPrevious">0</span> kWh</p>
                                </div>
                                <div class="energy-flow-card mb-3 p-3 border rounded">
                                    <h5 class="card-title">Floor Devices</h5>
                                    <p class="card-text">Current: <span id="floorDevicesEnergyCurrent">0</span> kWh</p>
                                    <p class="card-text">Previous: <span id="floorDevicesEnergyPrevious">0</span> kWh</p>
                                </div>
                                <div class="energy-flow-card p-3 border rounded">
                                    <h5 class="card-title">Switched Devices</h5>
                                    <p class="card-text">Current: <span id="switchedDevicesEnergyCurrent">0</span> kWh</p>
                                    <p class="card-text">Previous: <span id="switchedDevicesEnergyPrevious">0</span> kWh</p>
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
                                <button id="resetZoomComparison" class="btn btn-sm btn-secondary mt-2">Reset Zoom</button>
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
                                                <th>Change (kWh)</th>
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
                                <button id="resetZoomFloorDistribution" class="btn btn-sm btn-secondary mt-2">Reset Zoom</button>
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
                    lastDay: {
                        current: {
                            mainSupply: 3000,
                            floorDevices: 2850,
                            switchedDevices: 2700
                        },
                        previous: {
                            mainSupply: 2900,
                            floorDevices: 2750,
                            switchedDevices: 2600
                        }
                    },
                    lastWeek: {
                        current: {
                            mainSupply: 70000,
                            floorDevices: 66500,
                            switchedDevices: 63000
                        },
                        previous: {
                            mainSupply: 68000,
                            floorDevices: 64600,
                            switchedDevices: 61200
                        }
                    },
                    lastMonth: {
                        current: {
                            mainSupply: 300000,
                            floorDevices: 285000,
                            switchedDevices: 270000
                        },
                        previous: {
                            mainSupply: 290000,
                            floorDevices: 275500,
                            switchedDevices: 261000
                        }
                    }
                };

                const comparisonData = {
                    lastDay: {
                        labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
                        datasets: [{
                                label: 'Today',
                                data: [400, 420, 450, 500, 550, 600, 580, 520],
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Yesterday',
                                data: [380, 400, 430, 480, 520, 570, 550, 500],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    lastWeek: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                                label: 'This Week',
                                data: [10000, 10200, 10500, 10300, 10700, 9500, 9200, 10100, 10300, 10600, 10400, 10800, 9600, 9300],
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Last Week',
                                data: [9500, 9800, 10200, 9900, 10500, 9200, 8900, 9600, 9900, 10300, 10000, 10600, 9300, 9000],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    lastMonth: {
                        labels: Array.from({
                            length: 31
                        }, (_, i) => i + 1),
                        datasets: [{
                                label: 'This Month',
                                data: Array.from({
                                    length: 31
                                }, () => Math.floor(Math.random() * 1000) + 9000),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Last Month',
                                data: Array.from({
                                    length: 31
                                }, () => Math.floor(Math.random() * 1000) + 8500),
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    }
                };

                const deviceData = {
                    lastDay: [{
                            name: 'AC Unit 1',
                            type: 'Switched',
                            floor: '1st',
                            currentLoad: 300,
                            previousLoad: 290
                        },
                        {
                            name: 'Lighting System 1',
                            type: 'Switched',
                            floor: '1st',
                            currentLoad: 150,
                            previousLoad: 145
                        },
                        {
                            name: 'AC Unit 2',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 350,
                            previousLoad: 340
                        },
                        {
                            name: 'Lighting System 2',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 180,
                            previousLoad: 175
                        },
                        {
                            name: 'Office Equipment',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 250,
                            previousLoad: 240
                        }
                    ],
                    lastWeek: [{
                            name: 'AC Unit 1',
                            type: 'Switched',
                            floor: '1st',
                            currentLoad: 7000,
                            previousLoad: 6800
                        },
                        {
                            name: 'Lighting System 1',
                            type: 'Switched',
                            floor: '1st',
                            currentLoad: 3500,
                            previousLoad: 3400
                        },
                        {
                            name: 'AC Unit 2',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 8500,
                            previousLoad: 8200
                        },
                        {
                            name: 'Lighting System 2',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 4200,
                            previousLoad: 4100
                        },
                        {
                            name: 'Office Equipment',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 5700,
                            previousLoad: 5500
                        }
                    ],
                    lastMonth: [{
                            name: 'AC Unit 1',
                            type: 'Switched',
                            floor: '1st',
                            currentLoad: 30000,
                            previousLoad: 29000
                        },
                        {
                            name: 'Lighting System 1',
                            type: 'Switched',
                            floor: '1st',
                            currentLoad: 15000,
                            previousLoad: 14500
                        },
                        {
                            name: 'AC Unit 2',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 35000,
                            previousLoad: 34000
                        },
                        {
                            name: 'Lighting System 2',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 18000,
                            previousLoad: 17500
                        },
                        {
                            name: 'Office Equipment',
                            type: 'Switched',
                            floor: '2nd',
                            currentLoad: 25000,
                            previousLoad: 24000
                        }
                    ]
                };

                const floorDistributionData = {
                    lastDay: {
                        labels: ['1st Floor', '2nd Floor'],
                        datasets: [{
                            label: 'Energy Consumption (kWh)',
                            data: [450, 780],
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
                            data: [10500, 18400],
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
                            data: [45000, 78000],
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
                        data: comparisonData.lastDay,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                zoom: {
                                    zoom: {
                                        wheel: {
                                            enabled: true,
                                        },
                                        pinch: {
                                            enabled: true
                                        },
                                        mode: 'xy',
                                    },
                                    pan: {
                                        enabled: true,
                                        mode: 'xy',
                                    }
                                }
                            }
                        }
                    });

                    const floorDistributionCtx = document.getElementById('floorDistributionChart').getContext('2d');
                    floorDistributionChart = new Chart(floorDistributionCtx, {
                        type: 'bar',
                        data: floorDistributionData.lastDay,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                zoom: {
                                    zoom: {
                                        wheel: {
                                            enabled: true,
                                        },
                                        pinch: {
                                            enabled: true
                                        },
                                        mode: 'xy',
                                    },
                                    pan: {
                                        enabled: true,
                                        mode: 'xy',
                                    }
                                }
                            }
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
                    document.getElementById('mainSupplyEnergyCurrent').textContent = energyData[period].current.mainSupply;
                    document.getElementById('mainSupplyEnergyPrevious').textContent = energyData[period].previous.mainSupply;
                    document.getElementById('floorDevicesEnergyCurrent').textContent = energyData[period].current.floorDevices;
                    document.getElementById('floorDevicesEnergyPrevious').textContent = energyData[period].previous.floorDevices;
                    document.getElementById('switchedDevicesEnergyCurrent').textContent = energyData[period].current.switchedDevices;
                    document.getElementById('switchedDevicesEnergyPrevious').textContent = energyData[period].previous.switchedDevices;
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
                        const change = device.currentLoad - device.previousLoad;
                        changeCell.textContent = `${change} kWh`;
                        if (change > 0) {
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
                document.getElementById('timePeriodSelect').addEventListener('change', function() {
                    const customDateRange = document.getElementById('customDateRange');
                    if (this.value === 'custom') {
                        customDateRange.style.display = 'block';
                    } else {
                        customDateRange.style.display = 'none';
                        updateDashboard();
                    }
                });

                // Initialize Flatpickr for custom date range
                flatpickr("#customDateRange", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    onClose: function(selectedDates, dateStr, instance) {
                        if (selectedDates.length === 2) {
                            console.log("Selected date range:", dateStr);
                            // Here you would typically fetch data for the selected date range
                            // and update the dashboard. For this example, we'll just log the dates.
                            // updateDashboardWithCustomRange(selectedDates[0], selectedDates[1]);
                        }
                    }
                });

                // Add event listeners for reset zoom buttons
                document.getElementById('resetZoomComparison').addEventListener('click', () => {
                    comparisonChart.resetZoom();
                });

                document.getElementById('resetZoomFloorDistribution').addEventListener('click', () => {
                    floorDistributionChart.resetZoom();
                });
            </script>
</body>

</html>
<script src="<?php echo BASE_PATH; ?>assets/js/sidebar-menu.js"></script>
<script src="<?php echo BASE_PATH; ?>BEMS/scripts/popover.js"></script>
<script src="<?php echo BASE_PATH; ?>BEMS/scripts/dropdowns-script.js"></script>
<script src="<?php echo BASE_PATH; ?>BEMS/scripts/next-prev-buttons.js"></script>
<script src="<?php echo BASE_PATH; ?>BEMS/scripts/new-floor-devices.js"></script>
<script src="<?php echo BASE_PATH; ?>BEMS/scripts/new-switched-device.js"></script>
<script src="<?php echo BASE_PATH; ?>BEMS\scripts\new-main-supply-device.js"></script>

<?php

include(BASE_PATH . "assets/html/body-end.php");
include(BASE_PATH . "assets/html/html-end.php");

?>