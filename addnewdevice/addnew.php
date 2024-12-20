<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';


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

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "new_bems_user_db";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
// function test_input($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }
$transErr = "";
$Err = "";

// Handle HTML form submissions separately
if (isset($_GET['new_Main_Supply_Device'])) {
    $maindevice_name = $_GET['maindeviceId'];

    // Validate device name
    if (empty($maindevice_name)) {
        $transErr = "Device ID is required";
        echo json_encode(['status' => 'error', 'message' => $transErr]);
        exit;
    } else {
        // Prepare the SQL statement to check for existing device
        $sql = "SELECT COUNT(main_device_id) as count FROM Main_supply_devices WHERE main_device_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $maindevice_name);

        // Execute and check if query was successful
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                $response = [
                    'status' => 'error',
                    'message' => 'Device ID already exists'
                ];
            } else {
                // Prepare insert statement
                $default_values = array_fill(0, 70, 0);

                // Get the current datetime
                $current_datetime = date('Y-m-d H:i:s');

                $sql = "INSERT INTO Main_supply_devices (main_device_id,main_device_name,role,login_id) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $maindevice_name,$maindevice_name,$role,$user_login_id);

                if ($stmt->execute()) {
                    $sql = "INSERT INTO main_supply_device_data (device_id , kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg , kva_5_avg , kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins , pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 , lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 , lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 , neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 , energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 , lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor , load_factor_ph1 , load_factor_ph2 , load_factor_ph3 , location , signal_level , Date_Time)
    VALUES (?, " . implode(',', $default_values) . ", ?)
    ON DUPLICATE KEY UPDATE 
    kw_5_avg = VALUES(kw_5_avg), kw_10_avg = VALUES(kw_10_avg), kw_15_avg = VALUES(kw_15_avg), kw_1_avg = VALUES(kw_1_avg),
    kva_5_avg = VALUES(kva_5_avg), kva_10_avg = VALUES(kva_10_avg), kva_15_avg = VALUES(kva_15_avg), kva_1_avg = VALUES(kva_1_avg),
    kw_ph1 = VALUES(kw_ph1), kw_ph2 = VALUES(kw_ph2), kw_ph3 = VALUES(kw_ph3), kva_ph1 = VALUES(kva_ph1), kva_ph2 = VALUES(kva_ph2), kva_ph3 = VALUES(kva_ph3),
    pf_total = VALUES(pf_total), pf_5mins = VALUES(pf_5mins), pf_10mins = VALUES(pf_10mins), pf_15mins = VALUES(pf_15mins),
    lag_kvah_ph1 = VALUES(lag_kvah_ph1), lag_kvah_ph2 = VALUES(lag_kvah_ph2), lag_kvah_ph3 = VALUES(lag_kvah_ph3), lag_kvah_total = VALUES(lag_kvah_total),
    lead_kvah_ph1 = VALUES(lead_kvah_ph1), lead_kvah_ph2 = VALUES(lead_kvah_ph2), lead_kvah_ph3 = VALUES(lead_kvah_ph3), lead_kvah_total = VALUES(lead_kvah_total),
    lag_kwh_ph1 = VALUES(lag_kwh_ph1), lag_kwh_ph2 = VALUES(lag_kwh_ph2), lag_kwh_ph3 = VALUES(lag_kwh_ph3), lag_kwh_total = VALUES(lag_kwh_total),
    lead_kwh_ph1 = VALUES(lead_kwh_ph1), lead_kwh_ph2 = VALUES(lead_kwh_ph2), lead_kwh_ph3 = VALUES(lead_kwh_ph3), lead_kwh_total = VALUES(lead_kwh_total),
    onboard_temp = VALUES(onboard_temp), voltage_ph1 = VALUES(voltage_ph1), voltage_ph2 = VALUES(voltage_ph2), voltage_ph3 = VALUES(voltage_ph3),
    current_ph1 = VALUES(current_ph1), current_ph2 = VALUES(current_ph2), current_ph3 = VALUES(current_ph3), neutral_current = VALUES(neutral_current),
    energy_kwh_ph1 = VALUES(energy_kwh_ph1), energy_kwh_ph2 = VALUES(energy_kwh_ph2), energy_kwh_ph3 = VALUES(energy_kwh_ph3), energy_kwh_total = VALUES(energy_kwh_total),
    energy_kvah_ph1 = VALUES(energy_kvah_ph1), energy_kvah_ph2 = VALUES(energy_kvah_ph2), energy_kvah_ph3 = VALUES(energy_kvah_ph3), energy_kvah_total = VALUES(energy_kvah_total),
    lag_kvarh_ph1 = VALUES(lag_kvarh_ph1), lag_kvarh_ph2 = VALUES(lag_kvarh_ph2), lag_kvarh_ph3 = VALUES(lag_kvarh_ph3), lag_kvarh_total = VALUES(lag_kvarh_total),
    lead_kvarh_ph1 = VALUES(lead_kvarh_ph1), lead_kvarh_ph2 = VALUES(lead_kvarh_ph2), lead_kvarh_ph3 = VALUES(lead_kvarh_ph3), lead_kvarh_total = VALUES(lead_kvarh_total),
    frequency_ph1 = VALUES(frequency_ph1), frequency_ph2 = VALUES(frequency_ph2), frequency_ph3 = VALUES(frequency_ph3),
    powerfactor_ph1 = VALUES(powerfactor_ph1), powerfactor_ph2 = VALUES(powerfactor_ph2), powerfactor_ph3 = VALUES(powerfactor_ph3),
    load_factor = VALUES(load_factor), load_factor_ph1 = VALUES(load_factor_ph1), load_factor_ph2 = VALUES(load_factor_ph2), load_factor_ph3 = VALUES(load_factor_ph3),
    location = VALUES(location), signal_level = VALUES(signal_level), Date_Time = VALUES(Date_Time)";

                    // Prepare the statement
                    $stmt = $conn->prepare($sql);
                    // Bind parameters, including the datetime
                    $stmt->bind_param("ss", $maindevice_name, $current_datetime);
                    $stmt->execute();
                    $response = [
                        'status' => 'success',
                        'message' => 'Device updated successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Error inserting device: ' . $stmt->error
                    ];
                }
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Query failed: ' . $stmt->error
            ];
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        echo json_encode($response);
        exit;
    }
}



// Process the form data if no errors
//     if (empty($transErr)) {
//         // Prepare the SQL statement with a placeholder
//         $sql = "INSERT INTO Main_supply_devices (main_device_id) VALUES (?)";
//         $stmt = $conn->prepare($sql);

//         // Bind the parameter (s = string, since transformer_name is likely a string)
//         $stmt->bind_param("s", $maindevice_name);

//         // Execute the prepared statement
//         if ($stmt->execute()) {
//             $transErr = "New device added successfully";
//         } else {
//             echo "Error: " . $stmt->error;
//         }

//         // Close the statement
//         $stmt->close();

//         // Redirect to prevent form resubmission
//         header("Location: " . $_SERVER['PHP_SELF']);
//         exit();
//     }

// 



// Function to sanitize input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// Handle API requests (Check if request contains JSON data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    // Set the header to return JSON
    header('Content-Type: application/json');

    // Get raw POST data
    $data = file_get_contents("php://input");
    $request = json_decode($data, true);

    if ($request && isset($request['devices']) && is_array($request['devices'])) {
        $devices = $request['devices'];
        $response = [];

        // Check the type of devices being submitted
        if (isset($request['type']) && $request['type'] === 'switch_devices') {
            // Handle switched devices
            foreach ($devices as $device) {
                $mainSupplyDevice = $conn->real_escape_string($device['mainSupplyDevice']);
                $floorDevice = $conn->real_escape_string($device['floorDevice']);
                $phase = $conn->real_escape_string($device['phase']);
                $deviceId = $conn->real_escape_string($device['deviceId']);
                $singlephase = $conn->real_escape_string($device['singlephase']);

                if (!empty($deviceId)) {
                    // $sql = "SELECT COUNT(switched_device_id) as count FROM Switched_devices
                    // WHERE switched_device_id= '$deviceId' and main_device_id = '$mainSupplyDevice' and floor_device_id='$floorDevice'";
                    if (!empty($singlephase)) {
                        $sql = "SELECT COUNT(switched_device_id) as count FROM Switched_devices
                    WHERE switched_device_id= '$deviceId' ";
                    } else {
                        $sql = "SELECT COUNT(switched_device_id) as count FROM Switched_devices
                    WHERE switched_device_id= '$deviceId' and  phase='$phase'";
                    }
                    // Execute the query
                    $result = $conn->query($sql);

                    // Check if query was successful
                    if ($result) {
                        // Fetch the result as an associative array
                        $row = $result->fetch_assoc();
                        $count = $row['count'];  // The count of matching device_id entries
                        if ($count > 0) {
                            $Err = "Device Id already exists";
                            $response['status'] = 'error';
                            $response['message'] = 'Device Id already exists' . $conn->error;
                            echo json_encode($response);
                        }
                    } else {
                        echo "Error executing query: " . $conn->error;
                    }
                }
                if (empty($Err)) {
                    $sql = "";
                    if (!empty($singlephase)) {
                        $sql = "INSERT INTO Switched_devices (main_device_id, floor_device_id,switched_device_id,phase,switched_device_name,role,login_id)
                        VALUES ('$mainSupplyDevice','$floorDevice','$deviceId','$singlephase','$deviceId','$role',$user_login_id')";
                        if (!$conn->query($sql)) {
                            $response['status'] = 'error';
                            $response['message'] = 'Error inserting data: ' . $conn->error;
                            echo json_encode($response);
                            $conn->close();
                            exit();
                        } else {
                            // Success response
                            $default_values = array_fill(0, 70, 0);

                            // Get the current datetime
                            $current_datetime = date('Y-m-d H:i:s');

                            // $sql = "INSERT INTO switched_single_phase_devices_data (device_id ,kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg ,kva_5_avg ,
                            // kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins ,
                            // pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 ,
                            // lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 ,
                            // lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 ,
                            // neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 ,
                            // energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 ,
                            // lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor ,
                            // load_factor_ph1 ,load_factor_ph2 ,load_factor_ph3 ,location ,signal_level ,Date_Time )
                            // VALUES (?, " . implode(',', $default_values) . ", ?)";
                             $sql = "INSERT INTO switched_single_phase_devices_data (device_id , kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg , kva_5_avg , kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins , pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 , lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 , lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 , neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 , energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 , lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor , load_factor_ph1 , load_factor_ph2 , load_factor_ph3 , location , signal_level , Date_Time)
                             VALUES (?, " . implode(',', $default_values) . ", ?)
                             ON DUPLICATE KEY UPDATE 
                             kw_5_avg = VALUES(kw_5_avg), kw_10_avg = VALUES(kw_10_avg), kw_15_avg = VALUES(kw_15_avg), kw_1_avg = VALUES(kw_1_avg),
                             kva_5_avg = VALUES(kva_5_avg), kva_10_avg = VALUES(kva_10_avg), kva_15_avg = VALUES(kva_15_avg), kva_1_avg = VALUES(kva_1_avg),
                             kw_ph1 = VALUES(kw_ph1), kw_ph2 = VALUES(kw_ph2), kw_ph3 = VALUES(kw_ph3), kva_ph1 = VALUES(kva_ph1), kva_ph2 = VALUES(kva_ph2), kva_ph3 = VALUES(kva_ph3),
                             pf_total = VALUES(pf_total), pf_5mins = VALUES(pf_5mins), pf_10mins = VALUES(pf_10mins), pf_15mins = VALUES(pf_15mins),
                             lag_kvah_ph1 = VALUES(lag_kvah_ph1), lag_kvah_ph2 = VALUES(lag_kvah_ph2), lag_kvah_ph3 = VALUES(lag_kvah_ph3), lag_kvah_total = VALUES(lag_kvah_total),
                             lead_kvah_ph1 = VALUES(lead_kvah_ph1), lead_kvah_ph2 = VALUES(lead_kvah_ph2), lead_kvah_ph3 = VALUES(lead_kvah_ph3), lead_kvah_total = VALUES(lead_kvah_total),
                             lag_kwh_ph1 = VALUES(lag_kwh_ph1), lag_kwh_ph2 = VALUES(lag_kwh_ph2), lag_kwh_ph3 = VALUES(lag_kwh_ph3), lag_kwh_total = VALUES(lag_kwh_total),
                             lead_kwh_ph1 = VALUES(lead_kwh_ph1), lead_kwh_ph2 = VALUES(lead_kwh_ph2), lead_kwh_ph3 = VALUES(lead_kwh_ph3), lead_kwh_total = VALUES(lead_kwh_total),
                             onboard_temp = VALUES(onboard_temp), voltage_ph1 = VALUES(voltage_ph1), voltage_ph2 = VALUES(voltage_ph2), voltage_ph3 = VALUES(voltage_ph3),
                             current_ph1 = VALUES(current_ph1), current_ph2 = VALUES(current_ph2), current_ph3 = VALUES(current_ph3), neutral_current = VALUES(neutral_current),
                             energy_kwh_ph1 = VALUES(energy_kwh_ph1), energy_kwh_ph2 = VALUES(energy_kwh_ph2), energy_kwh_ph3 = VALUES(energy_kwh_ph3), energy_kwh_total = VALUES(energy_kwh_total),
                             energy_kvah_ph1 = VALUES(energy_kvah_ph1), energy_kvah_ph2 = VALUES(energy_kvah_ph2), energy_kvah_ph3 = VALUES(energy_kvah_ph3), energy_kvah_total = VALUES(energy_kvah_total),
                             lag_kvarh_ph1 = VALUES(lag_kvarh_ph1), lag_kvarh_ph2 = VALUES(lag_kvarh_ph2), lag_kvarh_ph3 = VALUES(lag_kvarh_ph3), lag_kvarh_total = VALUES(lag_kvarh_total),
                             lead_kvarh_ph1 = VALUES(lead_kvarh_ph1), lead_kvarh_ph2 = VALUES(lead_kvarh_ph2), lead_kvarh_ph3 = VALUES(lead_kvarh_ph3), lead_kvarh_total = VALUES(lead_kvarh_total),
                             frequency_ph1 = VALUES(frequency_ph1), frequency_ph2 = VALUES(frequency_ph2), frequency_ph3 = VALUES(frequency_ph3),
                             powerfactor_ph1 = VALUES(powerfactor_ph1), powerfactor_ph2 = VALUES(powerfactor_ph2), powerfactor_ph3 = VALUES(powerfactor_ph3),
                             load_factor = VALUES(load_factor), load_factor_ph1 = VALUES(load_factor_ph1), load_factor_ph2 = VALUES(load_factor_ph2), load_factor_ph3 = VALUES(load_factor_ph3),
                             location = VALUES(location), signal_level = VALUES(signal_level), Date_Time = VALUES(Date_Time)";

                            // Prepare the statement
                            $stmt = $conn->prepare($sql);
                            // Bind parameters, including the datetime
                            $stmt->bind_param("ss", $deviceId, $current_datetime);
                            if ($stmt->execute()) {
                                // Success response
                                $response['status'] = 'success';
                                $response['message'] = 'Devices updated successfully.';
                                echo json_encode($response);
                                $conn->close();
                                exit();

                            } else {
                                $response = [
                                    'status' => 'error',
                                    'message' => 'Error inserting device: ' . $stmt->error
                                ];
                            }
                        }
                    } else {
                       
                          $sql = "INSERT INTO Switched_devices (main_device_id, floor_device_id,switched_device_id,phase,switched_device_name,role,login_id)
                        VALUES ('$mainSupplyDevice','$floorDevice','$deviceId','$phase','$deviceId','$role','$user_login_id')";
                    
                    if (!$conn->query($sql)) {
                        $response['status'] = 'error';
                        $response['message'] = 'Error inserting data: ' . $conn->error;
                        echo json_encode($response);
                        $conn->close();
                        exit();
                    } else {
                        // Success response
                        $default_values = array_fill(0, 70, 0);

                            // Get the current datetime
                            $current_datetime = date('Y-m-d H:i:s');

                            $sql = "INSERT INTO switched_three_phase_devices_data (device_id , kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg , kva_5_avg , kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins , pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 , lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 , lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 , neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 , energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 , lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor , load_factor_ph1 , load_factor_ph2 , load_factor_ph3 , location , signal_level , Date_Time)
                            VALUES (?, " . implode(',', $default_values) . ", ?)
                            ON DUPLICATE KEY UPDATE 
                            kw_5_avg = VALUES(kw_5_avg), kw_10_avg = VALUES(kw_10_avg), kw_15_avg = VALUES(kw_15_avg), kw_1_avg = VALUES(kw_1_avg),
                            kva_5_avg = VALUES(kva_5_avg), kva_10_avg = VALUES(kva_10_avg), kva_15_avg = VALUES(kva_15_avg), kva_1_avg = VALUES(kva_1_avg),
                            kw_ph1 = VALUES(kw_ph1), kw_ph2 = VALUES(kw_ph2), kw_ph3 = VALUES(kw_ph3), kva_ph1 = VALUES(kva_ph1), kva_ph2 = VALUES(kva_ph2), kva_ph3 = VALUES(kva_ph3),
                            pf_total = VALUES(pf_total), pf_5mins = VALUES(pf_5mins), pf_10mins = VALUES(pf_10mins), pf_15mins = VALUES(pf_15mins),
                            lag_kvah_ph1 = VALUES(lag_kvah_ph1), lag_kvah_ph2 = VALUES(lag_kvah_ph2), lag_kvah_ph3 = VALUES(lag_kvah_ph3), lag_kvah_total = VALUES(lag_kvah_total),
                            lead_kvah_ph1 = VALUES(lead_kvah_ph1), lead_kvah_ph2 = VALUES(lead_kvah_ph2), lead_kvah_ph3 = VALUES(lead_kvah_ph3), lead_kvah_total = VALUES(lead_kvah_total),
                            lag_kwh_ph1 = VALUES(lag_kwh_ph1), lag_kwh_ph2 = VALUES(lag_kwh_ph2), lag_kwh_ph3 = VALUES(lag_kwh_ph3), lag_kwh_total = VALUES(lag_kwh_total),
                            lead_kwh_ph1 = VALUES(lead_kwh_ph1), lead_kwh_ph2 = VALUES(lead_kwh_ph2), lead_kwh_ph3 = VALUES(lead_kwh_ph3), lead_kwh_total = VALUES(lead_kwh_total),
                            onboard_temp = VALUES(onboard_temp), voltage_ph1 = VALUES(voltage_ph1), voltage_ph2 = VALUES(voltage_ph2), voltage_ph3 = VALUES(voltage_ph3),
                            current_ph1 = VALUES(current_ph1), current_ph2 = VALUES(current_ph2), current_ph3 = VALUES(current_ph3), neutral_current = VALUES(neutral_current),
                            energy_kwh_ph1 = VALUES(energy_kwh_ph1), energy_kwh_ph2 = VALUES(energy_kwh_ph2), energy_kwh_ph3 = VALUES(energy_kwh_ph3), energy_kwh_total = VALUES(energy_kwh_total),
                            energy_kvah_ph1 = VALUES(energy_kvah_ph1), energy_kvah_ph2 = VALUES(energy_kvah_ph2), energy_kvah_ph3 = VALUES(energy_kvah_ph3), energy_kvah_total = VALUES(energy_kvah_total),
                            lag_kvarh_ph1 = VALUES(lag_kvarh_ph1), lag_kvarh_ph2 = VALUES(lag_kvarh_ph2), lag_kvarh_ph3 = VALUES(lag_kvarh_ph3), lag_kvarh_total = VALUES(lag_kvarh_total),
                            lead_kvarh_ph1 = VALUES(lead_kvarh_ph1), lead_kvarh_ph2 = VALUES(lead_kvarh_ph2), lead_kvarh_ph3 = VALUES(lead_kvarh_ph3), lead_kvarh_total = VALUES(lead_kvarh_total),
                            frequency_ph1 = VALUES(frequency_ph1), frequency_ph2 = VALUES(frequency_ph2), frequency_ph3 = VALUES(frequency_ph3),
                            powerfactor_ph1 = VALUES(powerfactor_ph1), powerfactor_ph2 = VALUES(powerfactor_ph2), powerfactor_ph3 = VALUES(powerfactor_ph3),
                            load_factor = VALUES(load_factor), load_factor_ph1 = VALUES(load_factor_ph1), load_factor_ph2 = VALUES(load_factor_ph2), load_factor_ph3 = VALUES(load_factor_ph3),
                            location = VALUES(location), signal_level = VALUES(signal_level), Date_Time = VALUES(Date_Time)";
                            // Prepare the statement
                            $stmt = $conn->prepare($sql);
                            // Bind parameters, including the datetime
                            $stmt->bind_param("ss", $deviceId, $current_datetime);
                            if ($stmt->execute()) {
                                // Success response
                                $response['status'] = 'success';
                                $response['message'] = 'Devices updated successfully.';
                                echo json_encode($response);
                                $conn->close();
                                exit();

                            } else {
                                $response = [
                                    'status' => 'error',
                                    'message' => 'Error inserting device: ' . $stmt->error
                                ];
                            }
                        
                    }
                }
                }
            }
        } elseif (isset($request['type']) && $request['type'] === 'floor_devices') {
            // Handle saved devices
            $devices = $request['devices'];

            foreach ($devices as $device) {
                // Fetch device data safely
                $mainSupplyDevice = $conn->real_escape_string($device['mainSupplyDevice']);
                $phase = $conn->real_escape_string($device['phase']);
                $deviceId = $conn->real_escape_string($device['deviceId']);
                $newFloorName = $conn->real_escape_string($device['newFloorName']);
                $singlephase = $conn->real_escape_string($device['singlephase']);
                // Initialize error variable


                // Assuming $conn is your database connection
                if (!empty($deviceId)) {
                    $sql = "SELECT COUNT(floor_device_id) as count FROM floor_devices 
                    WHERE floor_device_id= '$deviceId' ";

                    // Execute the query
                    $result = $conn->query($sql);

                    // Check if query was successful
                    if ($result) {
                        // Fetch the result as an associative array
                        $row = $result->fetch_assoc();
                        $count = $row['count'];  // The count of matching device_id entries
                        if ($count > 0) {
                            $Err = "Device Id already exists";
                            $response['status'] = 'error';
                            $response['message'] = 'Device Id already exists';
                        }
                    } else {
                        echo "Error executing query: " . $conn->error;
                    }
                }
                if (!empty($newFloorName)) {
                    $sql = "SELECT COUNT(floor_name) as count FROM floor_devices WHERE floor_name=  '$newFloorName' and main_device_id = '$mainSupplyDevice' ";

                    // Execute the query
                    $result = $conn->query($sql);

                    // Check if query was successful
                    if ($result) {
                        // Fetch the result as an associative array
                        $row = $result->fetch_assoc();
                        $count = $row['count'];  // The count of matching floor_name entries
                        if ($count > 0) {
                            $Err = "Floor name already exists";
                            $response['status'] = 'error';
                            $response['message'] = 'Floor name already exists';
                        }
                    } else {
                        echo "Error executing query: " . $conn->error;
                    }
                }

                // Insert the data into the database if no errors
                if (empty($Err)) {
                    $sql = "";
                    if (!empty($singlephase)) {
                        $sql = "INSERT INTO floor_devices (main_device_id, floor_name, phase, floor_device_id,floor_device_name,role,login_id) 
                            VALUES ('$mainSupplyDevice', '$newFloorName', '$singlephase', '$deviceId','$deviceId','$role','$user_login_id')";
                    } else {
                        $sql = "INSERT INTO floor_devices (main_device_id, floor_name, phase, floor_device_id,floor_device_name,role,login_id) 
                            VALUES ('$mainSupplyDevice', '$newFloorName', '$phase', '$deviceId','$deviceId','$role','$user_login_id')";
                        
                    }
                    // Check if the insertion is successful
                    if (!$conn->query($sql)) {
                        // Error response in case of SQL failure
                        $response['status'] = 'error';
                        $response['message'] = 'Error inserting data: ' . $conn->error;
                        echo json_encode($response);
                        $conn->close();
                        exit();
                    } else {
                        $default_values = array_fill(0, 70, 0);

                        // Get the current datetime
                        $current_datetime = date('Y-m-d H:i:s');

                        // $sql = "INSERT INTO floor_devices_data_table (device_id ,kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg ,kva_5_avg ,
                        //     kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins ,
                        //     pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 ,
                        //     lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 ,
                        //     lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 ,
                        //     neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 ,
                        //     energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 ,
                        //     lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor ,
                        //     load_factor_ph1 ,load_factor_ph2 ,load_factor_ph3 ,location ,signal_level ,Date_Time )
                        //     VALUES (?, " . implode(',', $default_values) . ", ?)";
                        $sql = "INSERT INTO floor_devices_data_table (device_id , kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg , kva_5_avg , kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins , pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 , lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 , lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 , neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 , energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 , lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor , load_factor_ph1 , load_factor_ph2 , load_factor_ph3 , location , signal_level , Date_Time)
                             VALUES (?, " . implode(',', $default_values) . ", ?)
                             ON DUPLICATE KEY UPDATE 
                             kw_5_avg = VALUES(kw_5_avg), kw_10_avg = VALUES(kw_10_avg), kw_15_avg = VALUES(kw_15_avg), kw_1_avg = VALUES(kw_1_avg),
                             kva_5_avg = VALUES(kva_5_avg), kva_10_avg = VALUES(kva_10_avg), kva_15_avg = VALUES(kva_15_avg), kva_1_avg = VALUES(kva_1_avg),
                             kw_ph1 = VALUES(kw_ph1), kw_ph2 = VALUES(kw_ph2), kw_ph3 = VALUES(kw_ph3), kva_ph1 = VALUES(kva_ph1), kva_ph2 = VALUES(kva_ph2), kva_ph3 = VALUES(kva_ph3),
                             pf_total = VALUES(pf_total), pf_5mins = VALUES(pf_5mins), pf_10mins = VALUES(pf_10mins), pf_15mins = VALUES(pf_15mins),
                             lag_kvah_ph1 = VALUES(lag_kvah_ph1), lag_kvah_ph2 = VALUES(lag_kvah_ph2), lag_kvah_ph3 = VALUES(lag_kvah_ph3), lag_kvah_total = VALUES(lag_kvah_total),
                             lead_kvah_ph1 = VALUES(lead_kvah_ph1), lead_kvah_ph2 = VALUES(lead_kvah_ph2), lead_kvah_ph3 = VALUES(lead_kvah_ph3), lead_kvah_total = VALUES(lead_kvah_total),
                             lag_kwh_ph1 = VALUES(lag_kwh_ph1), lag_kwh_ph2 = VALUES(lag_kwh_ph2), lag_kwh_ph3 = VALUES(lag_kwh_ph3), lag_kwh_total = VALUES(lag_kwh_total),
                             lead_kwh_ph1 = VALUES(lead_kwh_ph1), lead_kwh_ph2 = VALUES(lead_kwh_ph2), lead_kwh_ph3 = VALUES(lead_kwh_ph3), lead_kwh_total = VALUES(lead_kwh_total),
                             onboard_temp = VALUES(onboard_temp), voltage_ph1 = VALUES(voltage_ph1), voltage_ph2 = VALUES(voltage_ph2), voltage_ph3 = VALUES(voltage_ph3),
                             current_ph1 = VALUES(current_ph1), current_ph2 = VALUES(current_ph2), current_ph3 = VALUES(current_ph3), neutral_current = VALUES(neutral_current),
                             energy_kwh_ph1 = VALUES(energy_kwh_ph1), energy_kwh_ph2 = VALUES(energy_kwh_ph2), energy_kwh_ph3 = VALUES(energy_kwh_ph3), energy_kwh_total = VALUES(energy_kwh_total),
                             energy_kvah_ph1 = VALUES(energy_kvah_ph1), energy_kvah_ph2 = VALUES(energy_kvah_ph2), energy_kvah_ph3 = VALUES(energy_kvah_ph3), energy_kvah_total = VALUES(energy_kvah_total),
                             lag_kvarh_ph1 = VALUES(lag_kvarh_ph1), lag_kvarh_ph2 = VALUES(lag_kvarh_ph2), lag_kvarh_ph3 = VALUES(lag_kvarh_ph3), lag_kvarh_total = VALUES(lag_kvarh_total),
                             lead_kvarh_ph1 = VALUES(lead_kvarh_ph1), lead_kvarh_ph2 = VALUES(lead_kvarh_ph2), lead_kvarh_ph3 = VALUES(lead_kvarh_ph3), lead_kvarh_total = VALUES(lead_kvarh_total),
                             frequency_ph1 = VALUES(frequency_ph1), frequency_ph2 = VALUES(frequency_ph2), frequency_ph3 = VALUES(frequency_ph3),
                             powerfactor_ph1 = VALUES(powerfactor_ph1), powerfactor_ph2 = VALUES(powerfactor_ph2), powerfactor_ph3 = VALUES(powerfactor_ph3),
                             load_factor = VALUES(load_factor), load_factor_ph1 = VALUES(load_factor_ph1), load_factor_ph2 = VALUES(load_factor_ph2), load_factor_ph3 = VALUES(load_factor_ph3),
                             location = VALUES(location), signal_level = VALUES(signal_level), Date_Time = VALUES(Date_Time)";

                        // Prepare the statement
                        $stmt = $conn->prepare($sql);
                        // Bind parameters, including the datetime
                        $stmt->bind_param("ss", $deviceId, $current_datetime);
                        if ($stmt->execute()) {
                            // Success response
                            $response['status'] = 'success';
                            $response['message'] = 'Devices updated successfully.';
                        } else {
                            $response = [
                                'status' => 'error',
                                'message' => 'Error inserting device: ' . $stmt->error
                            ];
                        }

                    }
                }
            }

            // Send the final response back
            echo json_encode($response);
            $conn->close();
            exit();
        }





    } else {
        // Invalid JSON data
        $response['status'] = 'error';
        $response['message'] = 'Invalid data provided.';
        echo json_encode($response);
    }

    exit(); // Stop script execution after handling JSON response
}



// Handle the fetch request for transformers and buildings
if (isset($_GET['fetch_data'])) {
    header('Content-Type: application/json');

    $response = array();
    $mainSupplyDevice = array();

    $sql_mainSupplyDevice = "SELECT main_device_id FROM main_supply_devices";
    $result_mainSupplyDevice = $conn->query($sql_mainSupplyDevice);

    if ($result_mainSupplyDevice->num_rows > 0) {
        while ($row = $result_mainSupplyDevice->fetch_assoc()) {
            $mainSupplyDevice[] = $row;
        }
    }

    $response['mainSupplyDevice'] = $mainSupplyDevice;
    echo json_encode($response);
    exit();
}

if (isset($_GET['get_floor_devices']) && isset($_GET['main_device_id'])) {
    header('Content-Type: application/json');

    $response = array();
    $main_device_id = $_GET['main_device_id'];

    $sql_floors = "SELECT floor_device_id FROM floor_devices WHERE main_device_id= '$main_device_id'";
    $result_floors = $conn->query($sql_floors);
    $floors = array();

    if ($result_floors->num_rows > 0) {
        while ($row = $result_floors->fetch_assoc()) {
            $floors[] = $row;
        }
    }

    $response['floors'] = $floors;
    echo json_encode($response);
    exit();
}



?>