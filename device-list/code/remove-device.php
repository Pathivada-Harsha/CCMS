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

$return_response = "";
$add_confirm = false;
$code = "";

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $dbname1 = "new_bems_user_db";
    $dbname2 = "new_bems_all";

    // Create connection for $dbname1
    $conn1 = new mysqli($servername, $username, $password, $dbname1);
    if ($conn1->connect_error) {
        die("Connection failed: " . $conn1->connect_error);
    }

    // Create connection for $dbname2
    $conn2 = new mysqli($servername, $username, $password, $dbname2);
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }

    // Secure the device_id from POST request
    $device_id = htmlspecialchars(mysqli_real_escape_string($conn1, $_POST['D_ID']));

    if ($device_id == "") {
        echo json_encode("Invalid device ID");
        $conn1->close();
        $conn2->close();
        exit();
    }

    // Check user permissions
    $sql = "SELECT device_add_remove FROM user_permissions WHERE login_id = ?";
    $stmt = $conn1->prepare($sql);
    $stmt->bind_param("s", $user_login_id);
    $stmt->execute();
    $stmt->bind_result($device_add_remove);
    $stmt->fetch();
    $stmt->close();

    if ($device_add_remove != 1) {
        echo json_encode("No permission to delete the device");
        $conn1->close();
        $conn2->close();
        exit();
    }

    $device_deleted = false;

    // Try deleting from main_supply_devices
    $sql = "DELETE FROM main_supply_devices WHERE main_device_id = ? AND login_id = ?";
    $stmt = $conn1->prepare($sql);
    $stmt->bind_param("si", $device_id, $user_login_id);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $sql1 = "DELETE FROM main_supply_device_data WHERE device_id = ?";
        $stmt1 = $conn2->prepare($sql1);
        $stmt1->bind_param("s", $device_id);
        if ($stmt1->execute()) {
            $device_deleted = true;
        }
        $stmt1->close();
    }
    $stmt->close();

    // If not found in main_supply_devices, try floor_devices
    if (!$device_deleted) {
        $sql = "DELETE FROM floor_devices WHERE floor_device_id = ? AND login_id = ?";
        $stmt = $conn1->prepare($sql);
        $stmt->bind_param("si", $device_id, $user_login_id);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $sql1 = "DELETE FROM floor_devices_data_table WHERE device_id = ?";
            $stmt1 = $conn2->prepare($sql1);
            $stmt1->bind_param("s", $device_id);
            if ($stmt1->execute()) {
                $device_deleted = true;
            }
            $stmt1->close();
        }
        $stmt->close();
    }

    // If not found in floor_devices, try switched_devices
    if (!$device_deleted) {
        $sql = "DELETE FROM switched_devices WHERE switched_device_id = ? AND login_id = ?";
        $stmt = $conn1->prepare($sql);
        $stmt->bind_param("si", $device_id, $user_login_id);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            // Try deleting from single phase data
            $sql1 = "DELETE FROM switched_single_phase_devices_data WHERE device_id = ?";
            $stmt1 = $conn2->prepare($sql1);
            $stmt1->bind_param("s", $device_id);
            $stmt1->execute();
            $stmt1->close();

            // Also try deleting from three phase data
            $sql2 = "DELETE FROM switched_three_phase_devices_data WHERE device_id = ?";
            $stmt2 = $conn2->prepare($sql2);
            $stmt2->bind_param("s", $device_id);
            $stmt2->execute();
            $stmt2->close();

            $device_deleted = true;
        }
        $stmt->close();
    }

    $return_response = $device_deleted ? "Device deleted successfully" : "Device not found or could not be deleted";

    $conn1->close();
    $conn2->close();
} else {
    $return_response = "Invalid request method";
}

echo json_encode($return_response);
?>