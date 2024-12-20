<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();
$sessionVars = SessionManager::SessionVariables();

$mobile_no = $sessionVars['mobile_no'];
$user_id = $sessionVars['user_id'];
$role = $sessionVars['role'];

function connectToDatabase($dbname)
{
    $servername = "localhost";
    $username = "root";
    $password = "123456";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function fetchMainDeviceData($main_device_id)
{
    $conn = connectToDatabase("new_bems_user_db");
    $sql = "SELECT * FROM main_supply_devices WHERE main_device_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $main_device_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $data;
}

function fetchFloorDevicesData($main_device_id)
{
    $conn = connectToDatabase("new_bems_user_db");
    $sql = "SELECT * FROM floor_devices WHERE main_device_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $main_device_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $data;
}

function fetchSwitchedDevicesData($main_device_id)
{
    $conn = connectToDatabase("new_bems_user_db");
    $sql = "SELECT * FROM switched_devices WHERE main_device_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $main_device_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $data;
}

function fetchHistoricalData($device_id, $device_db, $start_date, $end_date)
{
    $conn = connectToDatabase($device_db);
    $sql = "SELECT * FROM live_data WHERE device_id = ? AND date_time BETWEEN ? AND ? ORDER BY date_time ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $device_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $data;
}

function fetchAllData($main_device_id, $time_period, $custom_start_date = null, $custom_end_date = null)
{
    $mainDeviceData = fetchMainDeviceData($main_device_id);
    $floorDevicesData = fetchFloorDevicesData($main_device_id);
    $switchedDevicesData = fetchSwitchedDevicesData($main_device_id);

    $now = new DateTime();
    $end_date = $now->format('Y-m-d H:i:s');

    switch ($time_period) {
        case 'lastDay':
            $start_date = $now->modify('-1 day')->format('Y-m-d H:i:s');
            $previous_start_date = $now->modify('-2 days')->format('Y-m-d H:i:s');
            $previous_end_date = $now->modify('-1 day')->format('Y-m-d H:i:s');
            break;
        case 'lastWeek':
            $start_date = $now->modify('-7 days')->format('Y-m-d H:i:s');
            $previous_start_date = $now->modify('-14 days')->format('Y-m-d H:i:s');
            $previous_end_date = $now->modify('-7 days')->format('Y-m-d H:i:s');
            break;
        case 'lastMonth':
            $start_date = $now->modify('-1 month')->format('Y-m-d H:i:s');
            $previous_start_date = $now->modify('-2 months')->format('Y-m-d H:i:s');
            $previous_end_date = $now->modify('-1 month')->format('Y-m-d H:i:s');
            break;
        case 'custom':
            $start_date = $custom_start_date ?? $now->modify('-1 day')->format('Y-m-d H:i:s');
            $end_date = $custom_end_date ?? $end_date;
            $date_diff = strtotime($end_date) - strtotime($start_date);
            $previous_start_date = date('Y-m-d H:i:s', strtotime($start_date) - $date_diff);
            $previous_end_date = $start_date;
            break;
        default:
            $start_date = $now->modify('-1 day')->format('Y-m-d H:i:s');
            $previous_start_date = $now->modify('-2 days')->format('Y-m-d H:i:s');
            $previous_end_date = $now->modify('-1 day')->format('Y-m-d H:i:s');
    }

    $historicalData = [];
    $historicalData['main'] = [
        'current' => fetchHistoricalData($main_device_id, $main_device_id, $start_date, $end_date),
        'previous' => fetchHistoricalData($main_device_id, $main_device_id, $previous_start_date, $previous_end_date)
    ];
    foreach ($floorDevicesData as $device) {
        $historicalData['floor'][$device['floor_device_id']] = [
            'current' => fetchHistoricalData($device['floor_device_id'], $device['floor_device_id'], $start_date, $end_date),
            'previous' => fetchHistoricalData($device['floor_device_id'], $device['floor_device_id'], $previous_start_date, $previous_end_date)
        ];
    }
    foreach ($switchedDevicesData as $device) {
        $historicalData['switched'][$device['switched_device_id']] = [
            'current' => fetchHistoricalData($device['switched_device_id'], $device['switched_device_id'], $start_date, $end_date),
            'previous' => fetchHistoricalData($device['switched_device_id'], $device['switched_device_id'], $previous_start_date, $previous_end_date)
        ];
    }

    return [
        'mainDevice' => $mainDeviceData,
        'floorDevices' => $floorDevicesData,
        'switchedDevices' => $switchedDevicesData,
        'historicalData' => $historicalData,
        'timePeriod' => [
            'current' => [
                'start' => $start_date,
                'end' => $end_date
            ],
            'previous' => [
                'start' => $previous_start_date,
                'end' => $previous_end_date
            ]
        ]
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $main_device_id = $_POST['main_device_id'] ?? 'transformer_1';
    $time_period = $_POST['time_period'] ?? 'lastDay';
    $custom_start_date = $_POST['start_date'] ?? null;
    $custom_end_date = $_POST['end_date'] ?? null;
    $data = fetchAllData($main_device_id, $time_period, $custom_start_date, $custom_end_date);

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
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

<body>
    <?php include(BASE_PATH . "assets/html/start-page.php"); ?>

    <div class="d-flex flex-column flex-shrink-0 p-3 main-content">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col-12 p-0">
                    <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Energy Comparison</span></p>
                </div>
            </div>
            <?php include(BASE_PATH . "dropdown-selection/device-list.php"); ?>

            <div class="container-fluid">
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.0/chartjs-plugin-zoom.min.js"></script>
    <script>
        let comparisonChart, floorDistributionChart, deviceTypeChart;
        let flatpickr;

        async function fetchData(mainDeviceId, timePeriod, startDate, endDate) {
            try {
                const formData = new FormData();
                formData.append('main_device_id', mainDeviceId);
                formData.append('time_period', timePeriod);
                if (timePeriod === 'custom') {
                    formData.append('start_date', startDate);
                    formData.append('end_date', endDate);
                }

                const response = await fetch('energycomparision3.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return await response.json();
            } catch (error) {
                console.error("Could not fetch data:", error);
                return null;
            }
        }

        function updateEnergyFlow(data) {
            if (!data || !data.historicalData || !data.historicalData.main) {
                console.error("Invalid data structure for energy flow");
                return;
            }
            const mainSupplyCurrent = data.historicalData.main.current;
            const mainSupplyPrevious = data.historicalData.main.previous;
            const currentEnergy = mainSupplyCurrent[mainSupplyCurrent.length - 1]?.energy_kwh_total || 'N/A';
            const previousEnergy = mainSupplyPrevious[mainSupplyPrevious.length - 1]?.energy_kwh_total || 'N/A';
            document.getElementById('mainSupplyEnergyCurrent').textContent = currentEnergy;
            document.getElementById('mainSupplyEnergyPrevious').textContent = previousEnergy;

            let floorCurrentTotal = 0;
            let floorPreviousTotal = 0;
            Object.values(data.historicalData.floor || {}).forEach(floor => {
                floorCurrentTotal += parseFloat(floor.current[floor.current.length - 1]?.energy_kwh_total || 0);
                floorPreviousTotal += parseFloat(floor.previous[floor.previous.length - 1]?.energy_kwh_total || 0);
            });
            document.getElementById('floorDevicesEnergyCurrent').textContent = floorCurrentTotal.toFixed(2);
            document.getElementById('floorDevicesEnergyPrevious').textContent = floorPreviousTotal.toFixed(2);

            let switchedCurrentTotal = 0;
            let switchedPreviousTotal = 0;
            Object.values(data.historicalData.switched || {}).forEach(switched => {
                switchedCurrentTotal += parseFloat(switched.current[switched.current.length - 1]?.energy_kwh_total || 0);
                switchedPreviousTotal += parseFloat(switched.previous[switched.previous.length - 1]?.energy_kwh_total || 0);
            });
            document.getElementById('switchedDevicesEnergyCurrent').textContent = switchedCurrentTotal.toFixed(2);
            document.getElementById('switchedDevicesEnergyPrevious').textContent = switchedPreviousTotal.toFixed(2);
        }

        function updateComparisonChart(data) {
            if (!data || !data.historicalData || !data.historicalData.main) {
                console.error("Invalid data structure for comparison chart");
                return;
            }
            const mainSupplyCurrent = data.historicalData.main.current;
            const mainSupplyPrevious = data.historicalData.main.previous;
            const currentLabels = mainSupplyCurrent.map(entry => new Date(entry.date_time).toLocaleString());
            const previousLabels = mainSupplyPrevious.map(entry => new Date(entry.date_time).toLocaleString());
            const currentEnergyData = mainSupplyCurrent.map(entry => entry.energy_kwh_total);
            const previousEnergyData = mainSupplyPrevious.map(entry => entry.energy_kwh_total);

            comparisonChart.data.labels = [...previousLabels, ...currentLabels];
            comparisonChart.data.datasets[0].data = [...previousEnergyData, ...currentEnergyData];
            comparisonChart.data.datasets[0].label = 'Energy Consumption (kWh)';
            comparisonChart.options.plugins.annotation = {
                annotations: {
                    line1: {
                        type: 'line',
                        xMin: previousLabels.length - 1,
                        xMax: previousLabels.length - 1,
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 2,
                    }
                }
            };
            comparisonChart.update();
        }

        function updateDeviceTable(data) {
            if (!data || !data.floorDevices || !data.switchedDevices) {
                console.error("Invalid data structure for device table");
                return;
            }
            const deviceEnergyTable = document.getElementById('deviceEnergyTable');
            deviceEnergyTable.innerHTML = '';

            data.floorDevices.forEach(device => {
                const historicalData = data.historicalData.floor[device.floor_device_id];
                addDeviceRow(deviceEnergyTable, device.floor_device_name, 'Floor', device.floor_name, historicalData);
            });

            data.switchedDevices.forEach(device => {
                const historicalData = data.historicalData.switched[device.switched_device_id];
                addDeviceRow(deviceEnergyTable, device.switched_device_name, 'Switched', device.floor_name, historicalData);
            });
        }

        function addDeviceRow(table, name, type, floor, historicalData) {
            const row = table.insertRow();
            row.insertCell(0).textContent = name;
            row.insertCell(1).textContent = type;
            row.insertCell(2).textContent = floor;
            const currentLoad = historicalData.current[historicalData.current.length - 1]?.energy_kwh_total || 'N/A';
            const previousLoad = historicalData.previous[historicalData.previous.length - 1]?.energy_kwh_total || 'N/A';
            row.insertCell(3).textContent = currentLoad;
            row.insertCell(4).textContent = previousLoad;
            const change = (parseFloat(currentLoad) - parseFloat(previousLoad)).toFixed(2);
            const changeCell = row.insertCell(5);
            changeCell.textContent = change;
            if (parseFloat(change) > 0) {
                changeCell.classList.add('text-danger');
            } else if (parseFloat(change) < 0) {
                changeCell.classList.add('text-success');
            }
        }

        function updateFloorDistributionChart(data) {
            if (!data || !data.floorDevices) {
                console.error("Invalid data structure for floor distribution chart");
                return;
            }
            const floorData = {};
            data.floorDevices.forEach(device => {
                const historicalData = data.historicalData.floor[device.floor_device_id];
                if (!floorData[device.floor_name]) {
                    floorData[device.floor_name] = 0;
                }
                floorData[device.floor_name] += parseFloat(historicalData.current[historicalData.current.length - 1]?.energy_kwh_total || 0);
            });

            floorDistributionChart.data.labels = Object.keys(floorData);
            floorDistributionChart.data.datasets[0].data = Object.values(floorData);
            floorDistributionChart.update();
        }

        function updateDeviceTypeChart(data) {
            if (!data || !data.switchedDevices) {
                console.error("Invalid data structure for device type chart");
                return;
            }
            const deviceTypes = {};
            data.switchedDevices.forEach(device => {
                if (!deviceTypes[device.role]) {
                    deviceTypes[device.role] = 0;
                }
                deviceTypes[device.role]++;
            });

            deviceTypeChart.data.labels = Object.keys(deviceTypes);
            deviceTypeChart.data.datasets[0].data = Object.values(deviceTypes);
            deviceTypeChart.update();
        }

        function initCharts() {
            const ctxComparison = document.getElementById('energyComparisonChart').getContext('2d');
            comparisonChart = new Chart(ctxComparison, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Energy (kWh)',
                        data: [],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
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
                            }
                        }
                    }
                }
            });

            const ctxFloorDistribution = document.getElementById('floorDistributionChart').getContext('2d');
            floorDistributionChart = new Chart(ctxFloorDistribution, {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            const ctxDeviceType = document.getElementById('deviceTypeChart').getContext('2d');
            deviceTypeChart = new Chart(ctxDeviceType, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        }

        let group_list = document.getElementById('group-list');
        var group_name = localStorage.getItem("GroupNameValue");

        if (group_name == "" || group_name == null) {
            group_name = group_list.value;
        }

        async function updateDashboard() {
            const mainDeviceId = group_name;
            const timePeriod = document.getElementById('timePeriodSelect').value;
            let startDate, endDate;
            if (timePeriod === 'custom') {
                [startDate, endDate] = document.getElementById('customDateRange').value.split(' to ');
            }
            const data = await fetchData(mainDeviceId, timePeriod, startDate, endDate);
            if (data) {
                updateEnergyFlow(data);
                updateComparisonChart(data);
                updateDeviceTable(data);
                updateFloorDistributionChart(data);
                updateDeviceTypeChart(data);
            } else {
                console.error("Failed to update dashboard due to invalid data");
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
            updateDashboard();

            flatpickr = flatpickr("#customDateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        updateDashboard();
                    }
                }
            });

            document.getElementById('timePeriodSelect').addEventListener('change', function() {
                const customDateRange = document.getElementById('customDateRange');
                if (this.value === 'custom') {
                    customDateRange.style.display = 'block';
                } else {
                    customDateRange.style.display = 'none';
                    updateDashboard();
                }
            });

            document.getElementById('resetZoomComparison').addEventListener('click', () => {
                comparisonChart.resetZoom();
            });

            document.getElementById('resetZoomFloorDistribution').addEventListener('click', () => {
                floorDistributionChart.resetZoom();
            });

            setInterval(updateDashboard, 5 * 60 * 1000);
        });
    </script>
</body>

</html>
<?php
include(BASE_PATH . "assets/js/sidebar-menu.js");
include(BASE_PATH . "assets/html/body-end.php");
include(BASE_PATH . "assets/html/html-end.php");
?>

