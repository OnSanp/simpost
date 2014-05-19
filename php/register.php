<?php 
	include '../functions.php';
	 
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$avatar = $_POST['avatar'];

	if($password1 != $password2)
		header('Location: ../settings.php#failed');
	 
	if(strlen($username) > 30)
		header('Location: ../settings.php#failed');
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
	 
	$username = mysql_real_escape_string($username);
	 
	$query = "INSERT INTO users ( username, first_name, last_name, password, email, salt, avatar )
			VALUES ( '$username', '$firstname', '$lastname', '$password', '$email', '$salt', '$avatar' );";
	mysql_query($query);
	 
	mysql_close();
	 
	header('Location: ../settings.php#succsessful');
?>