<?php
	include '../functions.php';

	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$avatar = $_POST['avatar'];
	$bio = $_POST['bio'];
	$email = $_POST['email'];
	$id = $_POST['id'];

	$connection = connect();
	selectdb($connection);
 
	$query = "UPDATE users SET username = '$username', first_name = '$firstname', last_name = '$lastname', avatar = '$avatar', bio = '$bio', email = '$email'  WHERE user_id = '$id';";
		
	mysql_query($query);
 
	mysql_close();
	
	header('Location: ../account.php?id='.$id.'#successful');
	exit();
?>