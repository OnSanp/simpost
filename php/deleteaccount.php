 <?php
	$id = $_POST['id'];
	$site = $_POST['site'];
	
	include '../functions.php';
	
	$connection = connect();
	selectdb($connection);
	
	$query = "SELECT COUNT(user_id) FROM users;";
	$result = mysql_query($query);
	$result = mysql_result($text, 0);
	
	if ($result > 0){
	
	$query = "DELETE FROM users WHERE user_id = '$id';";
	mysql_query($query);
	mysql_close();
	
	if($site = "manage"){
	}else{
		session_start();
		session_destroy();
	}
	
	if($site == "manage"){
		header('Location: ../manageusers.php#successful');
		exit();
	}else{
		header('Location: ../#successful');
		exit();
	}
	}else{
		header('Location: ../account.php?id='.$id.'#failed');
		exit();
	}
?>