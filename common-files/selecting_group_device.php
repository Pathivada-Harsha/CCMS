<?php

$group_id = strtoupper(trim($group_id));
$conn_user = mysqli_connect(HOST, USERNAME, PASSWORD, DB_USER);
if (!$conn_user) {
	die("Connection failed: " . mysqli_connect_error());
} else {

	$sql = "";
	$group_by = "device_group_or_area";
	$stmt = "";
	$total_switch_point = 0;
	$group_id = htmlspecialchars(mysqli_real_escape_string($conn_user, $group_id));
	require_once("client-super-admin-device-names.php");


	if ($group_id == "ALL") {
		$sql = "SELECT main_device_id AS device_id ,main_device_name as device_name
				FROM main_supply_devices where login_id =?
				UNION ALL
				SELECT floor_device_id AS device_id,floor_device_name as device_name
				FROM floor_devices where login_id=?
				UNION ALL
				SELECT switched_device_id AS device_id,switched_device_name as device_name
				FROM switched_devices where login_id=?
				ORDER BY LENGTH(device_id), device_id";
		$stmt = mysqli_prepare($conn_user, $sql);
		mysqli_stmt_bind_param($stmt, "iii", $user_login_id,$user_login_id, $user_login_id);
	} else {

		$sql_group = "SELECT group_by FROM device_selection_group WHERE login_id = ?";
		$stmt_group = mysqli_prepare($conn_user, $sql_group);
		mysqli_stmt_bind_param($stmt_group, "i", $user_login_id);

		if (mysqli_stmt_execute($stmt_group)) {
			mysqli_stmt_store_result($stmt_group);
			mysqli_stmt_bind_result($stmt_group, $group_by);
			mysqli_stmt_fetch($stmt_group);
		}
		mysqli_stmt_close($stmt_group);

		//$sql = "SELECT $list FROM user_device_group_view WHERE login_id = ? AND $group_by = ?  ORDER BY LENGTH(device_id), device_id";
		$sql = "SELECT main_device_id AS device_id ,main_device_name as device_name
	FROM main_supply_devices where login_id =? and main_device_id =?
	union all
	SELECT floor_device_id AS device_id,floor_device_name as device_name
	FROM floor_devices where login_id=? and main_device_id =?
	UNION ALL
	SELECT switched_device_id AS device_id,switched_device_name as device_name
	FROM switched_devices where login_id=? and main_device_id =?
	ORDER BY LENGTH(device_id), device_id";
		$stmt = mysqli_prepare($conn_user, $sql);
		mysqli_stmt_bind_param($stmt, "isisis", $user_login_id, $group_id,$user_login_id, $group_id,$user_login_id, $group_id);

	}
	if (mysqli_stmt_execute($stmt)) {
		$results = mysqli_stmt_get_result($stmt);
		if (mysqli_num_rows($results) > 0) {
			while ($r = mysqli_fetch_assoc($results)) {
				$device_list[] = array("D_ID" => $r['device_id'], "D_NAME" => $r['device_name']);
				$user_devices = $user_devices . "'" . $r['device_id'] . "',";
				$total_switch_point += 1;
			}
		}
	}
	mysqli_close($conn_user);

}


?>