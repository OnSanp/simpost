<?php

function connect(){
	include 'includes/connection.php';
	$connection = mysql_connect($host, $dbuser, $dbpassword);
	return $connection;
}

function close($con){
	mysqli_close($con);
}

function selectdb($conn){
	include 'includes/connection.php';
	mysql_select_db($dbname, $conn);
}

	$connection = connect();
	selectdb($connection);
	
	$sql = "SELECT favicon FROM settings";
	$favicon=mysql_query($sql,$connection) or die(mysql_error());
	$favicon=mysql_result($favicon, 0);
?>