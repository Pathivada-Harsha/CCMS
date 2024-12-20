<?php
require_once '../../base-path/config-path.php';
require_once BASE_PATH_1 . 'config_db/config.php';
require_once BASE_PATH_1 . 'session/session-manager.php';

// Check session and retrieve session variables
SessionManager::checkSession();
$sessionVars = SessionManager::SessionVariables();
$mobile_no = $sessionVars['mobile_no'];
$user_id = $sessionVars['user_id'];
$role = $sessionVars['role'];
$user_login_id = $sessionVars['user_login_id'];

// Initialize variables
$return_response = "";
$user_devices = "";

$update_data = false;

//$device_id = "CCMS_1";

$voltage_ph1 = "--";
$voltage_ph2 = "--";
$voltage_ph3 = "--";
$current_ph1 = "--";
$current_ph2 = "--";
$current_ph3 = "--";
$energy_kwh_total = "--";
$energy_kvah_total = "--";
$kw_total = "--";
$kva_total = "--";
$total_light = "--";
$on_light = "--";
$off_light = "--";
$on_off_status = "--";
$frame_date_time = "--";
$kw_1 = "--";
$kw_2 = "--";
$kw_3 = "--";


// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
	$device_id = filter_input(INPUT_POST, 'DEVICE_ID', FILTER_SANITIZE_STRING); 

    // Connect to the database using procedural mysqli
	$conn_db_all = mysqli_connect(HOST, USERNAME, PASSWORD, Bems_ALL);
	if (!$conn_db_all) {
		die("Connection failed: " . mysqli_connect_error());
	} else {
        // Prepare SQL statement based on the device status
		//$sql = "SELECT device_id, voltage_ph1, voltage_ph2, voltage_ph3, current_ph1, current_ph2, current_ph3, energy_kwh_total, energy_kvah_total, kw_total, kva_total, on_off_status, date_time, ping_time, kw_1, kw_2, kw_3 FROM live_data_updates WHERE device_id = ?";
		$sql = "SELECT device_id, voltage_ph1, voltage_ph2, voltage_ph3, current_ph1, current_ph2, current_ph3, energy_kwh_total, energy_kvah_total, lead_kwh_total, lead_kvah_total,  date_time, ping_time,kw_5_avg, kw_10_avg, kw_15_avg FROM live_data_updates WHERE device_id = ?";

        // Use prepared statement to execute the query
		$stmt = mysqli_prepare($conn_db_all, $sql);
		if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $device_id); // 's' for string type
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Check if there are rows returned
            if (mysqli_num_rows($result) > 0) {
            	$r = mysqli_fetch_assoc($result);
                // Process each row
            	$update_data = true;
            	$frame_date_time = date("H:i:s d-m-Y", strtotime($r['date_time']));
            	$ping_date_time = date("H:i:s d-m-Y", strtotime($r['ping_time']));
            	$device_id = $r['device_id'];

            	$voltage_ph1 = $r['voltage_ph1'];
            	$voltage_ph2 = $r['voltage_ph2'];
            	$voltage_ph3 = $r['voltage_ph3'];
            	$current_ph1 = $r['current_ph1'];
            	$current_ph2 = $r['current_ph2'];
            	$current_ph3 = $r['current_ph3'];
            	$energy_kwh_total = $r['energy_kwh_total'];
            	$energy_kvah_total = $r['energy_kvah_total'];
            	$kw_total = $r['lead_kwh_total'];
            	$kva_total = $r['lead_kvah_total'];
            	
            	$kw_1 = $r['kw_5_avg'];
            	$kw_2 = $r['kw_10_avg'];
            	$kw_3 = $r['kw_15_avg'];


			}
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // SQL preparation failed
        	$return_response = 'Failed to prepare SQL statement';
        }

        $total_lights = "--";
        $on_lights = "--";
        $off_lights = "--";

        if ($update_data) {
        	

        	$return_response = array(
        		"V_PH1" => $voltage_ph1,
        		"V_PH2" => $voltage_ph2,
        		"V_PH3" => $voltage_ph3,
        		"I_PH1" => $current_ph1,
        		"I_PH2" => $current_ph2,
        		"I_PH3" => $current_ph3,
        		"KWH" => $energy_kwh_total,
        		"KVAH" => $energy_kvah_total,
        		"KW" => $kw_total,
        		"KVA" => $kva_total,
        		
        		"DATE_TIME" => $frame_date_time,
        		"KW_R" => $kw_1,
        		"KW_Y" => $kw_2,
        		"KW_B" => $kw_3
        	);
        }

        // Close database connection
        mysqli_close($conn_db_all);
    }
} else {
    // Handle case where request method is not POST
	$return_response .= '<tr><td colspan="6" class="text-danger">Input Data Not Valid</td></tr>';
} 

// Output JSON response
echo json_encode($return_response);
?>
