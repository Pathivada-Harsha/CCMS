<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();

$sessionVars = SessionManager::SessionVariables();
$servername = "localhost";
$username = "root";
$password = "123456";

// Handle API requests
if (isset($_GET['energyconsumption'])) {
    header('Content-Type: application/json');
    
    try {
        if (!isset($_GET['D_id'])) {
            throw new Exception("Missing device ID.");
        }
        
        if (!isset($_GET['fromdate'], $_GET['fromtime'], $_GET['todate'], $_GET['totime'])) {
            throw new Exception("Missing date/time parameters.");
        }
        
        $device_id = $_GET['D_id'];
        $fromdate = filter_var($_GET['fromdate'], FILTER_SANITIZE_STRING);
        $fromtime = filter_var($_GET['fromtime'], FILTER_SANITIZE_STRING);
        $todate = filter_var($_GET['todate'], FILTER_SANITIZE_STRING);
        $totime = filter_var($_GET['totime'], FILTER_SANITIZE_STRING);
        
        // Database connection
        $conn = mysqli_connect($servername, $username, $password);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        $db = strtolower($device_id);
        
        // Validate dates
        $from_datetime = strtotime($fromdate . ' ' . $fromtime);
        $to_datetime = strtotime($todate . ' ' . $totime);
        
        if ($from_datetime === false || $to_datetime === false) {
            throw new Exception("Invalid date/time format.");
        }

        // Query for 'from' data with next available time
        $query_from = "SELECT device_id, date_time, energy_kwh_total, energy_kvah_total 
                      FROM `$db`.`live_data` 
                      WHERE DATE(date_time) = ? 
                      AND TIME(date_time) >= ? 
                      ORDER BY date_time ASC 
                      LIMIT 1";
                      
        $stmt_from = $conn->prepare($query_from);
        $stmt_from->bind_param("ss", $fromdate, $fromtime);
        $stmt_from->execute();
        $result_from = $stmt_from->get_result();
        
        // If no result found on the same day, try next day's first record
        if ($result_from->num_rows === 0) {
            $next_date = date('Y-m-d', strtotime($fromdate . ' +1 day'));
            $query_from = "SELECT device_id, date_time, energy_kwh_total, energy_kvah_total 
                          FROM `$db`.`live_data` 
                          WHERE DATE(date_time) = ? 
                          ORDER BY date_time ASC 
                          LIMIT 1";
            $stmt_from = $conn->prepare($query_from);
            $stmt_from->bind_param("s", $next_date);
            $stmt_from->execute();
            $result_from = $stmt_from->get_result();
        }
        
        if ($result_from->num_rows === 0) {
            throw new Exception("No data found for the 'From' date time range.");
        }
        
        $from_data = $result_from->fetch_assoc();
        $stmt_from->close();
        
        // Query for 'to' data with previous available time
        $query_to = "SELECT device_id, date_time, energy_kwh_total, energy_kvah_total 
                    FROM `$db`.`live_data` 
                    WHERE DATE(date_time) = ? 
                    AND TIME(date_time) <= ? 
                    ORDER BY date_time DESC 
                    LIMIT 1";
                    
        $stmt_to = $conn->prepare($query_to);
        $stmt_to->bind_param("ss", $todate, $totime);
        $stmt_to->execute();
        $result_to = $stmt_to->get_result();
        
        // If no result found on the same day, try previous day's last record
        if ($result_to->num_rows === 0) {
            $prev_date = date('Y-m-d', strtotime($todate . ' -1 day'));
            $query_to = "SELECT device_id, date_time, energy_kwh_total, energy_kvah_total 
                        FROM `$db`.`live_data` 
                        WHERE DATE(date_time) = ? 
                        ORDER BY date_time DESC 
                        LIMIT 1";
            $stmt_to = $conn->prepare($query_to);
            $stmt_to->bind_param("s", $prev_date);
            $stmt_to->execute();
            $result_to = $stmt_to->get_result();
        }
        
        if ($result_to->num_rows === 0) {
            throw new Exception("No data found for the 'To' date time range.");
        }
        
        $to_data = $result_to->fetch_assoc();
        $stmt_to->close();
        
        // Calculate differences
        $diff_kwh = $to_data['energy_kwh_total'] - $from_data['energy_kwh_total'];
        $diff_kvah = $to_data['energy_kvah_total'] - $from_data['energy_kvah_total'];
        
        // Format the actual times used for display
        $actual_from_time = date('Y-m-d H:i:s', strtotime($from_data['date_time']));
        $actual_to_time = date('Y-m-d H:i:s', strtotime($to_data['date_time']));
        
        echo json_encode([
            "status" => "success",
            "data" => [
                'diff_kwh' => $diff_kwh,
                'diff_kvah' => $diff_kvah,
                'actual_from_time' => $actual_from_time,
                'actual_to_time' => $actual_to_time
            ]
        ]);
        
        $conn->close();
        exit;
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <title>Energy Consumption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <style>
        .btn-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .flatpickr-input {
            font-size: 1rem;
            padding: 8px;
        }
        .result-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .result-header {
            background: #336eff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }
        .result-body {
            padding: 20px;
        }
        .time-comparison {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .consumption-values {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 15px;
        }
        .consumption-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .consumption-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #336eff;
        }
        .time-note {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }
        .alert-custom {
            border-left: 4px solid #336eff;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <?php include(BASE_PATH . "assets/html/start-page.php"); ?>
    
    <div class="d-flex flex-column flex-shrink-0 p-3 main-content">
        <div class="container-fluid">
            <div class="row d-flex align-items-center mb-4">
                <div class="col-12 p-0">
                    <p class="m-0 p-0">
                        <span class="text-body-tertiary">Pages / </span>
                        <span>Energy Consumption</span>
                    </p>
                </div>
            </div>
            
            <?php include(BASE_PATH . "dropdown-selection/group-device-list.php"); ?>
            
            <div class="container mt-2">
                <div class="row">
                    <!-- Date Time Selection Cards -->
                    <div class="col-6">
                        <div class="card p-3">
                            <h5 class="card-title">From</h5>
                            <div class="mb-3">
                                <label for="from-datepicker" class="form-label">Date</label>
                                <input type="text" class="form-control" id="from-datepicker" placeholder="Select Date">
                            </div>
                            <div class="mb-3">
                                <label for="from-timepicker" class="form-label">Time</label>
                                <input type="text" class="form-control" id="from-timepicker" placeholder="Select Time">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card p-3">
                            <h5 class="card-title">To</h5>
                            <div class="mb-3">
                                <label for="to-datepicker" class="form-label">Date</label>
                                <input type="text" class="form-control" id="to-datepicker" placeholder="Select Date">
                            </div>
                            <div class="mb-3">
                                <label for="to-timepicker" class="form-label">Time</label>
                                <input type="text" class="form-control" id="to-timepicker" placeholder="Select Time">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-3">
                    <button onclick="getData()" class="btn btn-primary">Calculate Energy Consumption</button>
                </div>

                <!-- Results Card -->
                <div id="results-container" style="display: none;" class="result-card mt-4">
                    <div class="result-header">
                        Energy Consumption Results
                    </div>
                    <div class="result-body">
                        <div id="status"></div>
                        <div id="results-content" style="display: none;">
                            <div class="time-comparison">
                                <h6 class="mb-3">Time Range Comparison</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Requested Time Range:</strong>
                                        <div id="requested-time-range" class="time-note"></div>
                                    </div>
                                    <div class="col-6">
                                        <strong>Actual Time Range Used:</strong>
                                        <div id="actual-time-range" class="time-note"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="consumption-values">
                                <div class="consumption-item">
                                    <div class="mb-2">Energy Consumption (kWh)</div>
                                    <div id="kwh-value" class="consumption-value">-</div>
                                </div>
                                <div class="consumption-item">
                                    <div class="mb-2">Energy Consumption (kVAh)</div>
                                    <div id="kvah-value" class="consumption-value">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#from-datepicker", { dateFormat: "Y-m-d" });
            flatpickr("#to-datepicker", { dateFormat: "Y-m-d" });
            flatpickr("#from-timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:S",
                time_24hr: true
            });
            flatpickr("#to-timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:S",
                time_24hr: true
            });
        });

        async function getData() {
            const fromdate = document.getElementById("from-datepicker").value;
            const fromtime = document.getElementById("from-timepicker").value;
            const todate = document.getElementById("to-datepicker").value;
            const totime = document.getElementById("to-timepicker").value;
            const resultsContainer = document.getElementById("results-container");
            const statusElement = document.getElementById("status");
            const resultsContent = document.getElementById("results-content");
            
            // Reset display states
            resultsContainer.style.display = 'none';
            statusElement.innerHTML = '';
            resultsContent.style.display = 'none';
            
            try {
                if (!fromdate || !fromtime || !todate || !totime) {
                    throw new Error("Please fill out all fields");
                }

                if (new Date(fromdate + " " + fromtime) > new Date(todate + " " + totime)) {
                    throw new Error("'From Date' and 'From Time' should be earlier than 'To Date' and 'To Time'.");
                }

                const device_id = localStorage.getItem("SELECTED_ID") || document.getElementById('device_id').value;
                
                const response = await fetch(window.location.href + 
                    `?energyconsumption&D_id=${device_id}&fromdate=${fromdate}&fromtime=${fromtime}&todate=${todate}&totime=${totime}`);
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const data = await response.json();
                resultsContainer.style.display = 'block';
                
                if (data.status === "success") {
                    // Clear any previous error messages
                    statusElement.innerHTML = '';
                    
                    // Show results content
                    resultsContent.style.display = 'block';
                    
                    // Display requested time range
                    document.getElementById("requested-time-range").innerHTML = `
                        From: ${fromdate} ${fromtime}<br>
                        To: ${todate} ${totime}
                    `;
                    
                    // Display actual time range
                    document.getElementById("actual-time-range").innerHTML = `
                        From: ${data.data.actual_from_time}<br>
                        To: ${data.data.actual_to_time}
                    `;
                    
                    // Display consumption values
                    document.getElementById("kwh-value").textContent = data.data.diff_kwh.toFixed(2);
                    document.getElementById("kvah-value").textContent = data.data.diff_kvah.toFixed(2);
                } else {
                    throw new Error(data.message);
                }
                
            } catch (error) {
                // Show results container and error message
                resultsContainer.style.display = 'block';
                statusElement.innerHTML = `<div class="alert alert-danger">${error.message}</div>`;
                resultsContent.style.display = 'none';
            }
        }
    </script>

    <script src="<?php echo BASE_PATH; ?>assets/js/sidebar-menu.js"></script>
    
    <?php
    include(BASE_PATH . "assets/html/body-end.php");
    include(BASE_PATH . "assets/html/html-end.php");
    ?>
</body>
</html>