<?php
$mysql_hostname  =  "localhost"; // host name
$mysql_user  =  "root"; // username
$mysql_password  =  ""; // password
$mysql_database  =  "tutorial"; //database name
$db  =  mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);
if($db){
}else{
	echo mysqli_error($db);
}
?>