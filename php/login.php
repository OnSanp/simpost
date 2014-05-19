<?php
	include '../functions.php';

	ob_start();
	session_start();
	 
	$username = $_POST['username'];
	$password = $_POST['password'];
	 
	if($username == "" || $password == ""){
		header('Location: ../login/#failed');
		exit();
	} 
	 
	$connection = connect();
	selectdb($connection);
	 
	$username = mysql_real_escape_string($username);
	$query = "SELECT user_id, username, password, salt
			FROM users
			WHERE username = '$username';";
	 
	$result = mysql_query($query);
	 
	if(mysql_num_rows($result) == 0)
	{
		header('Location: ../login/#failed');
	}
	 
	$userData = mysql_fetch_array($result, MYSQL_ASSOC);
	$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
	 
	if($hash != $userData['password'])
	{
		header('Location: ../login/');
	}else{ 
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $userData['user_id'];
		$_SESSION['sess_username'] = $userData['username'];
		session_write_close();
		header('Location: ../');
	}
?>