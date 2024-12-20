<?php
require_once '../../base-path/config-path.php';
require_once BASE_PATH_1 . 'config_db/config.php';
require_once BASE_PATH_1 . 'session/session-manager.php';

SessionManager::checkSession();
$sessionVars = SessionManager::SessionVariables();
$mobile_no = $sessionVars['mobile_no'];
$user_id = $sessionVars['user_id'];
$role = $sessionVars['role'];
$user_login_id = $sessionVars['user_login_id'];
//==================================//
$return_response = "";
$device_list = array ();
$user_devices="";
$total_switch_point=0;
//==================================//

//$group_id="ALL";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["GROUP_ID"])) {
	$group_id = $_POST['GROUP_ID'];

	include_once(BASE_PATH_1 . "common-files/selecting_group_device.php");
	$_SESSION["DEVICES_LIST"] = json_encode($device_list);

	if ($user_devices != "") {
		$user_devices = substr($user_devices, 0, -1);
	}

	$device_ids = explode(",", $user_devices);

// Count the number of device IDs
	$num_devices = count($device_ids);

// Prepare placeholders for mysqli_stmt_bind_param
$param_type = str_repeat("s", $num_devices); // Assuming all are strings

// Initialize parameters array
$params = array();
foreach ($device_ids as $device_id) {
	$params[] = $device_id;
}


$installed_lights = 0;
$installed_load = 0;
$kw = 0;
$kva = 0;
$kwh = 0;
$faulty_lights = 0;
$switch_points = 0;
$active_switch_points = 0;
$inactive_switch_points = 0;
$poor_network = 0;
$uninstalled_devices = 0;
$power_failure_count = 0;
$power_failure_count_in_poor_nw = 0;
$auto_system_on = 0;
$manual_on = 0;
$off = 0;
$installed_switch_points = 0;

// Database connection

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, Bems_ALL);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
} else {
	$sql_lights = "SELECT  COALESCE(SUM(poor_network) , 0) AS poor_network, COALESCE(SUM(power_failure) , 0) AS power_failure,
	 COALESCE(SUM(faulty) , 0) AS faulty, COALESCE(SUM(energy_kwh_total) , 0) AS energy_kwh_total, COALESCE(SUM(installed_status) , 0)
	  AS installed_status FROM live_data_updates WHERE device_id IN ($user_devices)";

	if ($result = mysqli_query($conn, $sql_lights)) {
		if (mysqli_num_rows($result) > 0) {
			while ($rl = mysqli_fetch_assoc($result)) {
				
				$installed_switch_points = $rl['installed_status'];
				// $kwh = $rl['energy_kwh_total'];
			}
		}
		mysqli_free_result($result);
	}
	

    // Fetch data for installed status
	$sql_installed_status = "SELECT COALESCE(SUM(active_device), 0) AS active_device, COALESCE(SUM(poor_network), 0) 
AS poor_network, COALESCE(SUM(power_failure), 0) AS power_failure, COALESCE(SUM(faulty), 0) AS faulty
 FROM live_data_updates WHERE device_id IN ($user_devices) AND installed_status = 1";

	if ($result = mysqli_query($conn, $sql_installed_status)) {
		if (mysqli_num_rows($result) > 0) {
			while ($r_installed_status = mysqli_fetch_assoc($result)) {
				$active_switch_points = $r_installed_status['active_device'];
				$poor_network = $r_installed_status['poor_network'];
				$power_failure_count = $r_installed_status['power_failure'];
				$inactive_switch_points = $r_installed_status['faulty'];
			}
		}
		mysqli_free_result($result);
	}

    

    mysqli_close($conn);
}

//Calculate uninstalled devices
$uninstalled_devices = $total_switch_point - $installed_switch_points;

// Prepare response array

$return_response = array(
    "user_devices" => $user_devices,   // Assuming $user_devices contains the list of devices
     "TOTAL_UNITS" => $total_switch_point,
     "SWITCH_POINTS" => $installed_switch_points,
    "UNINSTALLED_UNITS" => $uninstalled_devices,
    "ACTIVE_SWITCH" => $active_switch_points,
    "POOR_NW" => $poor_network,
    "POWER_FAILURE" => $power_failure_count,
    "FAULTY_SWITCH" => $inactive_switch_points
);
} else {
    // Handle if POST data is not set
	$return_response = array(
		"SWITCH_POINTS" => "--",
		"ACTIVE_SWITCH" => "--",
		"FAULTY_SWITCH" => "--",
		
		"POOR_NW" => $poor_network,
		"TOTAL_UNITS" => $total_switch_point,
		"UNISTALLED_UNITS" => $uninstalled_devices,
		"POWER_FAILURE" => $power_failure_count,
		
	);
}

// Return JSON response
echo json_encode($return_response);
?>
