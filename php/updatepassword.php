 <?php
	$id = $_POST['id'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	 
	include '../functions.php';
	 
	if($password1 != $password2)
		header('Location: ../account.php?id='.$id.'#failed');
	 
	if(strlen($username) > 30)
		header('Location: ../account.php?id='.$id.'#failed');
		
	$hash = hash('sha256', $password1);
	 
	function createSalt()
	{
		$text = md5(uniqid(rand(), true));
		return substr($text, 0, 3);
	}
	 
	$salt = createSalt();

	$password = hash('sha256', $salt . $hash);
	
	$connection = connect();
	selectdb($connection);
	 
	$query = "UPDATE users SET password = '$password', salt = '$salt' WHERE user_id = '$id';";
			
	mysql_query($query);
	 
	mysql_close();
	 
	header('Location: ../account.php?id='.$id.'#succsessful');
?>