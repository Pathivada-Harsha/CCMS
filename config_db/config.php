<?php

$ip_address = $_SERVER['REMOTE_ADDR'];
$db_all="ccms_all";
if($ip_address=="::1")
{
	define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','123456');
	
	define('DB_USER', 'new_ccms_user_db');
	define('DB_ALL', 'new_ccms_all');

}
else
{
	define('HOST','95.111.238.141');
	define('USERNAME', 'istlabsonline_db_user');
	define('PASSWORD','istlabsonline_db_pass');
	define('DB_USER', 'new_ccms_user_db');
	define('DB_ALL', 'new_ccms_all');
}


?>