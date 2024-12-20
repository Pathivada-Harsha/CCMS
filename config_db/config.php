<?php

$ip_address = $_SERVER['REMOTE_ADDR'];

if($ip_address=="::1")
{
	define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','123456');
	
	define('DB_USER', 'new_bems_user_db');
	define('DB_ALL', 'new_bems_all');
	define('Bems_ALL', 'new_bems_all');

}
else
{
	define('HOST','95.111.238.141');
	define('USERNAME', 'istlabsonline_db_user');
	define('PASSWORD','istlabsonline_db_pass');
	define('DB_USER', 'ccms_user_details');
	define('DB_ALL', 'ccms_all_devices');
}
$central_db=DB_ALL;
$users_db=DB_USER;

?>