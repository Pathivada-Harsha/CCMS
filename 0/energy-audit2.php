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

// Database connection
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname1 = "new_bems_user_db";
$dbname2 = "new_bems_all";

$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['fetch_transformerListData'])) {
    $sqlTransformerList = "SELECT id, main_device_id FROM $dbname1.main_supply_devices";
    $transformerListResult = $conn->query($sqlTransformerList);
    $transformerListData = [];

    // Check if the query returned any results
    if ($transformerListResult && $transformerListResult->num_rows > 0) {
        while ($row = $transformerListResult->fetch_assoc()) {
            $transformerListData[] = $row;
        }
    } else {
        // Handle empty result set
        echo json_encode(['error' => 'No transformers found or query error']);
        $conn->close();
        exit;
    }
    echo json_encode([

        'transformerList' => $transformerListData,

    ]);
    $conn->close();
    exit;
}

if (isset($_GET['fetchTotalCountOfFloors'])) {
    $transformerName = $_GET['tname'];
    $floorName = $_GET['fname'];

    if (empty($transformerName) || empty($floorName)) {
        echo json_encode(["status" => "Invalid input data."]);
        exit;
    }

    // Queries to count single-phase and three-phase devices
    $sqlCountSinglePhase = "SELECT COUNT(fd.id) AS singlePhaseCount, GROUP_CONCAT(phase) AS phasesSingle
                            FROM $dbname1.floor_devices AS fd 
                            JOIN $dbname2.floor_devices_data_table AS nfd 
                            ON nfd.device_id = fd.floor_device_id 
                            WHERE phase != 'three' AND main_device_id = '$transformerName' AND floor_device_id = '$floorName'";
                            
    $sqlCountThreePhase = "SELECT COUNT(fd.id) AS threePhaseCount, GROUP_CONCAT(phase) AS phasesThree
                           FROM $dbname1.floor_devices AS fd 
                           JOIN $dbname2.floor_devices_data_table AS nfd 
                           ON nfd.device_id = fd.floor_device_id 
                           WHERE phase = 'three' AND main_device_id = '$transformerName' AND floor_device_id = '$floorName'";

    // Execute the queries
    $singleQueryResult = $conn->query($sqlCountSinglePhase);
    $threeQueryResult = $conn->query($sqlCountThreePhase);

    // Initialize results
    $countResultSingle = 0;
    $countResultThree = 0;
    $phasesSingle = [];
    $phasesThree = [];

    // Process single-phase count and phase names
    if ($singleQueryResult && $singleQueryResult->num_rows > 0) {
        $row = $singleQueryResult->fetch_assoc();
        $countResultSingle = $row['singlePhaseCount'];
        $phasesSingle = !empty($row['phasesSingle']) ? explode(',', $row['phasesSingle']) : [];
    }

    // Process three-phase count and phase names
    if ($threeQueryResult && $threeQueryResult->num_rows > 0) {
        $row = $threeQueryResult->fetch_assoc();
        $countResultThree = $row['threePhaseCount'];
        $phasesThree = !empty($row['phasesThree']) ? explode(',', $row['phasesThree']) : [];
    }

    // Return results as JSON
    echo json_encode([
        'floorsCompleteSingleCount' => $countResultSingle,
        'floorsCompleteThreeCount' => $countResultThree,
        'phasesSingle' => $phasesSingle,
        'phasesThree' => $phasesThree
    ]);

    $conn->close();
    exit;
}



if (isset($_GET['fetch_transformerData'])) {
    // Check if transformer_name is set in the request
    if (isset($_GET['transformer_name'])) {
        $transformerName = $_GET['transformer_name'];
        $sqlThreezPhaseTransformers = "SELECT *
        FROM $dbname2.main_supply_device_data as ms join $dbname1.main_supply_devices as md on ms.device_id=md.main_device_id WHERE ms.device_id='$transformerName'";

        $ThreezPhaseTransformersResult = $conn->query($sqlThreezPhaseTransformers);

        $ThreezPhaseTransformersData = [];

        if ($ThreezPhaseTransformersResult && $ThreezPhaseTransformersResult->num_rows > 0 || $ThreezPhaseTransformersResult && $ThreezPhaseTransformersResult->num_rows > 0) {
            while ($row = $ThreezPhaseTransformersResult->fetch_assoc()) {
                $ThreezPhaseTransformersData[] = $row;
            }
        } else {
            // Optional: Add error message in case of failure or no data
            echo json_encode(['error' => 'No data found for the specified transformer']);
            $conn->close();
            exit;
        }

    } else {
        // If no specific transformer is requested, set transformersData to null
        $ThreezPhaseTransformersData = null;

    }


    echo json_encode([
        'transformersData' => $ThreezPhaseTransformersData,

    ]);

    $conn->close();
    exit;
}

if (isset($_GET['fetch_FloorsData'])) {
    $transformerName = $_GET['transformer_name'];
    // Queries to fetch data
    $sqlFloorsData = "SELECT * FROM $dbname2.floor_devices_data_table as fd1  join $dbname1.floor_devices as fd2 on fd1.device_id = fd2.floor_device_id where fd2.main_device_id='$transformerName'";
    $FloorsResult = $conn->query($sqlFloorsData);
    $FloorsData = [];
    if ($FloorsResult && $FloorsResult->num_rows > 0) {

        while ($row = $FloorsResult->fetch_assoc()) {
            $FloorsData[] = $row; // Collect three phase floors data
        }

    } else {
        // Error handling for no data or failure
        echo json_encode(['error' => 'No data found for the specified transformer floors']);
        $conn->close();
        exit;
    }

    // Send the final data in JSON format
    echo json_encode([
        'floorsData' => $FloorsData
    ]);

    $conn->close();
    exit;
}

//Floor Wise Consumed Load 
if (isset($_GET['fetch_floor_consumed_Data'])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];
    if (empty($transformerName) || empty($floorName)) {
        echo json_encode(["status" => "Invalid input data."]);
        exit;
    }
    $sqlThreezPhaseTransformers = "SELECT * FROM $dbname2.floor_devices_data_table as fd1  join $dbname1.floor_devices as fd2 on fd1.device_id = fd2.floor_device_id where fd2.main_device_id='$transformerName' and fd1.device_id='$floorName'";

    $ThreezPhaseTransformersResult = $conn->query($sqlThreezPhaseTransformers);

    $ThreezPhaseTransformersData = [];


    if ($ThreezPhaseTransformersResult && $ThreezPhaseTransformersResult->num_rows > 0) {
        while ($row = $ThreezPhaseTransformersResult->fetch_assoc()) {
            $ThreezPhaseTransformersData[] = $row;
        }
    } else {
        // Optional: Add error message in case of failure or no data
        echo json_encode(['error' => 'No data found for the specified transformer']);
        $conn->close();
        exit;
    }
    echo json_encode([
        'floordevicesdata' => $ThreezPhaseTransformersData,

    ]);

    $conn->close();
    exit;
}

if (isset($_GET['fetch_three_phase_devices_data'])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];

    // Input validation
    if (empty($transformerName) || empty($floorName)) {
        echo json_encode(["status" => "Invalid input data."]);
        exit;
    }


    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT * from $dbname2.switched_three_phase_devices_data as sdt join $dbname1.switched_devices as sd on sdt.device_id=sd.switched_device_id where sd.phase='three' and sd.floor_device_id='$floorName' and sd.main_device_id='$transformerName'");
    // $stmt->bind_param("ss", $floorName, $transformerName);
    $stmt->execute();
    $result = $stmt->get_result();

    $ThreezPhaseTransformersData = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ThreezPhaseTransformersData[] = $row;
        }
    } else {
        echo json_encode(['error' => 'No data found for the specified transformer']);
        $stmt->close();
        $conn->close();
        exit;
    }

    // Return JSON response
    echo json_encode(['switchthreephasedata' => $ThreezPhaseTransformersData]);

    $stmt->close();
    $conn->close();
    exit;
}


// Check if the request method is POST to add new three phase device
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $device_name = $_POST['device_name'];
    $transformer_name = $_POST['transformer_name'];
    $floor_name = $_POST['floor_name'];
    $phase='three';
    // Ensure device name is provided
    if (empty($device_name)) {
        echo "Device name is required.";
        $conn->close();
        exit;
    }

    // Check if the device name already exists for the same floor and transformer
    $check_sql = "SELECT * FROM $dbname1.switched_devices  WHERE switched_device_id = ? and phase=?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $device_name,$phase);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<span style='color:red;font-weight:bold'> Name Already Exists for the selected Floor and Transformer. Please Choose Another Name.</span>";
        $check_stmt->close();
        $conn->close();
        exit;
    }

    $check_stmt->close();
    // Fill remaining 73 columns with 0
    $default_values = array_fill(0, 70, 0);

    // Get the current datetime
    $current_datetime = date('Y-m-d H:i:s');

    $sqladdnew = "INSERT INTO $dbname1.switched_devices (main_device_id, floor_device_id, switched_device_id, phase,switched_device_name,role,login_id)
    VALUES (?,?,?,?,?,?,?)";
    $stmtaddnew = $conn->prepare($sqladdnew);
    $stmtaddnew->bind_param("ssssssi", $transformer_name, $floor_name, $device_name, $phase,$device_name,$role,$user_login_id);

    // Execute the statement and check for success
    if ($stmtaddnew->execute()) {
        echo "Device successfully added!";
    $sql = "INSERT INTO $dbname2.switched_three_phase_devices_data (device_id , kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg , kva_5_avg , kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins , pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 , lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 , lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 , neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 , energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 , lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor , load_factor_ph1 , load_factor_ph2 , load_factor_ph3 , location , signal_level , Date_Time)
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
    $stmt->bind_param("ss", $device_name, $current_datetime);
    $stmt->execute();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    exit;
}

//refresh three phase devices table after add new device or deleted exsited device
if (isset($_GET['get_three_phase_data'])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];

    // Query the updated data for the devices on this floor and transformer
    $sql = "SELECT * from $dbname2.switched_three_phase_devices_data as sdt join $dbname1.switched_devices as sd on sdt.device_id=sd.switched_device_id where sd.phase='three' and sd.floor_device_id=? and sd.main_device_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $floorName,$transformerName);
    $stmt->execute();
    $result = $stmt->get_result();

    $devices = [];
    while ($row = $result->fetch_assoc()) {
        $devices[] = $row;  // Collect each device's data
    }

    // Return the device data as JSON
    echo json_encode(["devices" => $devices]);

    $stmt->close();
    $conn->close();
    exit;
}


if (isset($_GET['delete_three_phase_row'])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];
    $deviceName = $_GET['device'];

    // Ensure the inputs are not empty before proceeding
    if (empty($transformerName) || empty($floorName) || empty($deviceName)) {
        echo json_encode(["status" => "Invalid input data."]);
        exit;
    }

    // Prepare the SQL DELETE query
    $sql = "DELETE FROM $dbname1.switched_devices WHERE main_device_id=? and floor_device_id=? and switched_device_id = ? ";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss",$transformerName, $floorName , $deviceName);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(["status" => "Device Deleted Successfully!"]);
            $sqlExist="DELETE from $dbname2.switched_three_phase_devices_data where device_id=?";
            $Existstmt = $conn->prepare($sqlExist);
            $Existstmt->bind_param("s", $deviceName) ;
            $Existstmt->execute();
           
        } else {
            echo json_encode(["status" => "Failed to delete device."]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle any SQL preparation errors
        echo json_encode(["status" => "Error preparing the SQL query."]);
    }

    // Close the database connection
    $conn->close();
    exit;
}

if(isset($_GET["three_phase_devices_count"])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];
    $stmt = $conn->prepare("SELECT count(sdt.id) as count from $dbname2.switched_three_phase_devices_data as sdt join $dbname1.switched_devices as sd on sdt.device_id=sd.switched_device_id where sd.phase='three' and sd.floor_device_id='$floorName' and sd.main_device_id='$transformerName'");
    $stmt->execute();
    $result = $stmt->get_result();

    $ThreezPhaseDevicesCount= [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ThreezPhaseDevicesCount[] = $row;
        }
    } else {
        echo json_encode(['error' => 'No data found for the specified transformer']);
        $stmt->close();
        $conn->close();
        exit;
    }

    // Return JSON response
    echo json_encode(['switchedThreePhaseDevicesCount' => $ThreezPhaseDevicesCount]);

    $stmt->close();
    $conn->close();
    exit;
}
  

if (isset($_GET['SinglephaseDevicesCount'])) {
    // Get the parameters
    $transformerName = $_GET['transformer_name'] ?? '';
    $floorName = $_GET['floor_name'] ?? '';

    // Escape the input parameters to prevent SQL injection
    $transformerName = $conn->real_escape_string($transformerName);
    $floorName = $conn->real_escape_string($floorName);

    // SQL query to fetch device count
    $sql = "SELECT COUNT(sp.id) as device_count 
            from $dbname2.switched_single_phase_devices_data  as sp
            join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id 
            WHERE sd.main_device_id = '$transformerName' 
            AND sd.Floor_device_id = '$floorName' and sd.phase !='three'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['device_count' => $row['device_count']]);
    } else {
        // Return 0 if no data found
        echo json_encode(['device_count' => 0]);
    }

    // Close the connection
    $conn->close();
    exit;
}


if (isset($_GET['fetch_phaseData'])) {
    // Get the parameters
    $transformerName = $_GET['transformer_name'] ?? '';
    $floorName = $_GET['floor_name'] ?? '';
    $phaseName = $_GET['phase_name'] ?? '';

    // Escape the input parameters to prevent SQL injection
    $transformerName = $conn->real_escape_string($transformerName);
    $floorName = $conn->real_escape_string($floorName);
    $phaseName = $conn->real_escape_string($phaseName);

    // SQL query to fetch data from single_phase_devices_data
    $sqlPhase = "SELECT *
                 FROM $dbname2.switched_single_phase_devices_data as sp join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id
                 WHERE sd.main_device_id = '$transformerName' AND sd.Floor_device_id = '$floorName' AND sd.phase = '$phaseName'";

    $result = $conn->query($sqlPhase);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        // Return an empty array if no data is found
        echo json_encode(['phaseData' => []]);
        exit;
    }

    // Return data as JSON
    echo json_encode(['phaseData' => $data]);

    // Close the connection
    $conn->close();
    exit;
}


if (isset($_GET['fetch_singlePhaseModalData'])) {
    if (isset($_GET['transformer_name']) && $_GET['floor_name']) {

        $transformerName = $_GET['transformer_name'] ?? '';
        $floorName = $_GET['floor_name'] ?? '';

        $sqlRPhase = "SELECT count(sp.id) as rPhaseDevicesCount,sum(sp.energy_kwh_total) as rPhaseDevicesInstalledLoad,sum(sp.energy_kvah_total) as rPhaseDevicesConsumingLoad from $dbname2.switched_single_phase_devices_data as sp join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id where main_device_id='$transformerName' and floor_device_id='$floorName' and phase='R Phase'";
        $sqlYPhase = "SELECT count(sp.id) as yPhaseDevicesCount,sum(sp.energy_kwh_total) as yPhaseDevicesInstalledLoad,sum(sp.energy_kvah_total) as yPhaseDevicesConsumingLoad from $dbname2.switched_single_phase_devices_data  as sp join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id  where main_device_id='$transformerName' and floor_device_id='$floorName' and phase='Y Phase'";
        $sqlBPhase = "SELECT count(sp.id) as bPhaseDevicesCount,sum(sp.energy_kwh_total) as bPhaseDevicesInstalledLoad,sum(sp.energy_kvah_total) as bPhaseDevicesConsumingLoad from $dbname2.switched_single_phase_devices_data  as sp join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id where main_device_id='$transformerName' and floor_device_id='$floorName' and phase='B Phase'";

        $RPhaseResult = $conn->query($sqlRPhase);
        $YPhaseResult = $conn->query($sqlYPhase);
        $BPhaseResult = $conn->query($sqlBPhase);
        $RPhaseData = [];
        $YPhaseData = [];
        $BPhaseData = [];

        if ($RPhaseResult && $RPhaseResult->num_rows > 0) {
            while ($row = $RPhaseResult->fetch_assoc()) {
                $RPhaseData[] = $row;
            }
        } else {
            // Optional: Add error message in case of failure or no data
            echo json_encode(['error' => 'No data found for the R Phase']);
            $conn->close();
            exit;
        }
        if ($YPhaseResult && $YPhaseResult->num_rows > 0) {
            while ($row = $YPhaseResult->fetch_assoc()) {
                $YPhaseData[] = $row;
            }
        } else {
            // Optional: Add error message in case of failure or no data
            echo json_encode(['error' => 'No data found for the Y Phase']);
            $conn->close();
            exit;
        }

        if ($BPhaseResult && $BPhaseResult->num_rows > 0) {
            while ($row = $BPhaseResult->fetch_assoc()) {
                $BPhaseData[] = $row;
            }
        } else {
            // Optional: Add error message in case of failure or no data
            echo json_encode(['error' => 'No data found for the Y Phase']);
            $conn->close();
            exit;
        }
    } else {
        // If no specific transformer is requested, set transformersData to null
        $RPhaseData = null;
        $YPhaseData = null;
        $BPhaseData = null;
    }
    // Return the transformer list and the transformer data as JSON
    echo json_encode([
        'RPhaseData' => $RPhaseData,
        'YPhaseData' => $YPhaseData,
        'BPhaseData' => $BPhaseData
    ]);

    $conn->close();
    exit;
}

if (isset($_GET['fetch_Total_Installed_loads'])) {
    // Get the parameters
    $transformerName = $_GET['transformer_name'] ?? '';
    $floorName = $_GET['floor_name'] ?? '';
    // Escape the input parameters to prevent SQL injection
    $transformerName = $conn->real_escape_string($transformerName);
    $floorName = $conn->real_escape_string($floorName);
    // SQL query to fetch data from single_phase_devices_data
    $sqlTotal_Consuming_Installed_loads = "
                 SELECT sum(energy_kwh_total) as Total_kw,sum(energy_kvah_total) as Total_kva
                 FROM  $dbname2.switched_single_phase_devices_data  as sp
                join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id
                 WHERE sd.main_device_id = '$transformerName' AND sd.floor_device_id = '$floorName' ";

    $result = $conn->query($sqlTotal_Consuming_Installed_loads);

    $Total_Consuming_Installed_loadsdata = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Total_Consuming_Installed_loadsdata[] = $row;
        }
    } else {
        // Return an empty array if no data found
        echo json_encode(['Total_Installed_loads' => []]);
        exit;
    }

    // Return data as JSON
    echo json_encode(['Total_Installed_loads' => $Total_Consuming_Installed_loadsdata]);

    // Close the connection
    $conn->close();
    exit;
}

if (isset($_GET['Total_Installed_loads_Of_Three_Phase'])) {
    // Get the parameters
    $transformerName = $_GET['transformer_name'] ?? '';
    $floorName = $_GET['floor_name'] ?? '';
    // Escape the input parameters to prevent SQL injection
    $transformerName = $conn->real_escape_string($transformerName);
    $floorName = $conn->real_escape_string($floorName);
    // SQL query to fetch data from single_phase_devices_data
    $sqlTotal_Installed_loads = "SELECT sum(sp.energy_kwh_total) as Total_Three_phase_kw,sum(sp.energy_kwh_total) as Total_Three_phase_kva
                 FROM  $dbname2.switched_three_phase_devices_data  as sp
                join $dbname1.switched_devices as sd on sp.device_id = sd.switched_device_id
                 WHERE sd.main_device_id = '$transformerName' AND sd.floor_device_id = '$floorName' ";

    $result = $conn->query($sqlTotal_Installed_loads);

    $Total_Installed_loadsdata = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Total_Installed_loadsdata[] = $row;
        }
    } else {
        // Return an empty array if no data found
        echo json_encode(['Total_Installed_loads' => []]);
        exit;
    }

    // Return data as JSON
    echo json_encode(['Total_Installed_loads' => $Total_Installed_loadsdata]);

    // Close the connection
    $conn->close();
    exit;
}

if (isset($_GET['insert_single_phase_device'])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];
    $phaseName = $_GET['phase'];
    $deviceName = $_GET['device_name'];

    if (empty($deviceName)) {
        echo json_encode(["status" => "Device name is required."]);
        $conn->close();
        exit;
    }

    // Check if the device name already exists for the same floor and transformer
    $check_sql = "SELECT * FROM $dbname1.switched_devices WHERE switched_device_id = ? AND phase IN ('R phase', 'Y phase', 'B phase')";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $deviceName);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => $deviceName." Name Already Exists for the selected Floor and Transformer. Please Choose Another Name."]);
        $check_stmt->close();
        $conn->close();
        exit;
    }

    $check_stmt->close();

    // Insert the data into switched_devices table
    $sql = "INSERT INTO $dbname1.switched_devices (main_device_id, floor_device_id, switched_device_id, phase) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $transformerName, $floorName, $deviceName, $phaseName);

    if ($stmt->execute()) 
    {
       

        $default_values = array_fill(0, 70, 0);  // Create an array of 70 zeros

        // Get the current datetime
        $current_datetime = date('Y-m-d H:i:s');

        // Prepare the SQL for switched_single_phase_devices_data table
        $sql = "INSERT INTO $dbname2.switched_single_phase_devices_data (device_id , kw_5_avg , kw_10_avg , kw_15_avg , kw_1_avg , kva_5_avg , kva_10_avg , kva_15_avg , kva_1_avg , kw_ph1 , kw_ph2 , kw_ph3 , kva_ph1 , kva_ph2 , kva_ph3 , pf_total , pf_5mins , pf_10mins , pf_15mins , lag_kvah_ph1 , lag_kvah_ph2 , lag_kvah_ph3 , lag_kvah_total , lead_kvah_ph1 , lead_kvah_ph2 , lead_kvah_ph3 , lead_kvah_total , lag_kwh_ph1 , lag_kwh_ph2 , lag_kwh_ph3 , lag_kwh_total , lead_kwh_ph1 , lead_kwh_ph2 , lead_kwh_ph3 , lead_kwh_total , onboard_temp , voltage_ph1 , voltage_ph2 , voltage_ph3 , current_ph1 , current_ph2 , current_ph3 , neutral_current , energy_kwh_ph1 , energy_kwh_ph2 , energy_kwh_ph3 , energy_kwh_total , energy_kvah_ph1 , energy_kvah_ph2 , energy_kvah_ph3 , energy_kvah_total , lag_kvarh_ph1 , lag_kvarh_ph2 , lag_kvarh_ph3 , lag_kvarh_total , lead_kvarh_ph1 , lead_kvarh_ph2 , lead_kvarh_ph3 , lead_kvarh_total , frequency_ph1 , frequency_ph2 , frequency_ph3 , powerfactor_ph1 , powerfactor_ph2 , powerfactor_ph3 , load_factor , load_factor_ph1 , load_factor_ph2 , load_factor_ph3 , location , signal_level , Date_Time)
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

        $stmt = $conn->prepare($sql);

        // Bind the device name and current datetime
        $stmt->bind_param("ss", $deviceName, $current_datetime);

        if ($stmt->execute()) {
            echo json_encode(["status" => "Device successfully added!"]);
        } else {
            echo json_encode(["status" => "Failed to insert device data."]);
        }

        $stmt->close();
        $conn->close();
        exit;

    } else {
        echo json_encode(["status" => "Failed to insert device."]);
        $stmt->close();
        $conn->close();
        exit;
    }
}



if (isset($_GET['delete_single_phase_row'])) {
    $transformerName = $_GET['transformer_name'];
    $floorName = $_GET['floor_name'];
    $deviceName = $_GET['device'];
    $phase = $_GET['phase']; // Corrected from $GET['phase'] to $_GET['phase']

    // Ensure the inputs are not empty before proceeding
    if (empty($transformerName) || empty($floorName) || empty($deviceName) || empty($phase)) {
        echo json_encode(["status" => "Invalid input data."]);
        exit;
    }

    // Prepare the SQL DELETE query
    $sql = "DELETE FROM $dbname1.switched_devices WHERE main_device_id = ? AND floor_device_id = ? AND switched_device_id = ? AND phase in ('R phase', 'Y phase', 'B phase')";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $transformerName, $floorName, $deviceName);

        // Execute the query
        if ($stmt->execute())
        {
            $sql = "DELETE FROM $dbname2.Switched_single_phase_devices_data  WHERE device_id = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $deviceName);
            if ($stmt->execute()) {
            echo json_encode(["status" => "Device Deleted Successfully!"]);
            }
        } else {
            echo json_encode(["status" => "Failed to delete device."]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["status" => "Error preparing the SQL query."]);
    }

    // Close the database connection
    $conn->close();
    exit;
}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <title>Energy Audit</title>
    <?php include(BASE_PATH . "assets/html/start-page.php"); ?>
</head>

<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 main-content">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col-12 p-0">
                    <p class="m-0 p-0">Pages / </span><span>Energy Audit </span></p>
                </div>
            </div>
            <?php include(BASE_PATH . "dropdown-selection/tranformer-device-list.php");?>
            <div class="row">
                    <div class="card mt-3 shadow">
                        <div class="card-head text-center text-bold mt-3">
                            <h4 class="text-primary">Transformer Supply</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="card">
                                        <div class="card text-center shadow" onclick="consumedLoadModal()">
                                            <div class="card-body m-0 p-0 pointer">
                                                <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-down-fill text-success water-flow-down"></i>Consumed Load</p>
                                                <h6 class="text-primary">kWh <span id="transformer_kwh_total_load">0</span></h6>
                                                <h6 class="text-primary">kVAh <span id="transformer_kvah_total_load">0</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-2">
                                        <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#">
                                            <div class="card-body m-0 p-0">
                                                <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-up-fill text-danger water-flow-up"></i>Installed Load</p>
                                                <h6 class="text-primary">kWh <span id="floor_kw_total_load">0</span></h6>
                                                <h6 class="text-primary">kVAh <span id="floor_kvah_total_load">0</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="card text-center shadow h-100" onclick="">
                                        <div class="card-head">
                                            <h6 class="card-text fw-semibold text-info-emphasis m-0 py-1 pt-4"><i class="bi bi-diagram-3 text-danger"></i>Transformer Connected Devices<h6>
                                            <h5 class="text-primary pt-3">Three Phase : <span id='three_phase_total_devices_count'>0</span></h5>
                                            <h5 class="text-primary pt-3">Single Phase : <span id='single_phase_total_devices_count'>0</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mt-3 shadow">
                        <div class="card-head">
                            <h4 class="text-center mt-2 text-primary">Main Supply</h4>
                        </div>
                        <div class="card-body" style="height: 400px; overflow-y: auto;">
                            <div id="transformerdata">
                                <!-- Data Will Add Dynamically From DB -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
    <?php
    include(BASE_PATH . "BEMS/modals/singlephase-view.php");
    include(BASE_PATH . "BEMS/modals/rphase.php");
    include(BASE_PATH . "BEMS/modals/yphase.php");
    include(BASE_PATH . "BEMS/modals/bphase.php");
    include(BASE_PATH . "BEMS/modals/consumed-load.php");
    include(BASE_PATH . "BEMS/modals/smart-power-hub.php");
    include(BASE_PATH . "BEMS/modals/add_three_phase_device.php");
    include(BASE_PATH . "BEMS/modals/threephase.php");
    include(BASE_PATH . "BEMS/modals/single_phase_modals.php");
    include(BASE_PATH . "BEMS/modals/add_single_phase_device.php");
    include(BASE_PATH . "BEMS/modals/floors_device_consumed_data.php");
    include(BASE_PATH . "addnewtransformer1.php");
    ?>
    <script src="<?php echo BASE_PATH; ?>assets/js/sidebar-menu.js"></script>
    <script src="<?php echo BASE_PATH; ?>BEMS/scripts/energy-audit3.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/project/dashboard.js"></script>

    <?php
    include(BASE_PATH . "assets/html/body-end.php");
    include(BASE_PATH . "assets/html/html-end.php");
    ?>