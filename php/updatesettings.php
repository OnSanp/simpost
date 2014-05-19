<?php
	include '../functions.php';

	$blogname = $_POST['blogname'];
	$favicon = $_POST['favicon'];
	$logo = $_POST['logo'];
	$footer = $_POST['footer'];

	$connection = connect();
	selectdb($connection);
 
	$query = "UPDATE settings SET blog_name = '$blogname', logo = '$logo', favicon = '$favicon', footer = '$footer'";
		
	mysql_query($query);
 
	mysql_close();
	
	header('Location: ../settings.php#successful');
	exit();

?> 