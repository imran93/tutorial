<?php

define('BASE_PATH','http://localhost/');
define('DB_HOST', 'localhost');
define('DB_NAME', '139996');
define('DB_USER','139996');
define('DB_PASSWORD','Hbv776677');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>
