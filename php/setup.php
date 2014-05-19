<?php
	$blogname = $_POST['blogname'];
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	$avatar = $_POST['avatar'];
	$dbname = $_POST['dbname'];
	$dbuser = $_POST['dbuser'];
	$dbpassword = $_POST['dbpassword'];
	$host = $_POST['host'];
	
	$content = '<?php
					$host = "'.$host.'";
					$dbuser = "'.$dbuser.'";
					$dbpassword = "'.$dbpassword.'";
					$dbname = "'.$dbname.'";
				?>';
				
	$file = "../includes/connection.php"; 
	$handler = fOpen($file , 'w+'); 
	fWrite($handler , $content); 
	fClose($handler);
	
	/* create tables */
	
	mysql_connect($host, $dbuser, $dbpassword) or die(mysql_error()); 
	mysql_select_db($dbname) or die(mysql_error());
	mysql_query("CREATE TABLE users(user_id INTEGER AUTO_INCREMENT NOT NULL, username VARCHAR(50), first_name VARCHAR(50), last_name VARCHAR(50), bio TEXT, avatar TEXT, password CHAR(128), email VARCHAR(100), salt CHAR(128), PRIMARY KEY(user_id));"); 
	mysql_query("CREATE TABLE posts(post_id INTEGER AUTO_INCREMENT NOT NULL, title VARCHAR(100), author VARCHAR(100), first_name VARCHAR(50), last_name VARCHAR(50), text TEXT, date DATE, PRIMARY KEY(post_id));");
	mysql_query("CREATE TABLE settings(blog_name VARCHAR(50), logo TEXT, favicon TEXT, footer TEXT, about_activated TINYINT, PRIMARY KEY(blog_name));");
	mysql_query("CREATE TABLE comments(comment_id INTEGER AUTO_INCREMENT NOT NULL, author VARCHAR(100), email VARCHAR(120), text TEXT, post_id INTEGER, date DATE, PRIMARY KEY(comment_id));");
	mysql_close();
	
	/* write values in tables */
	
	$date = date("Y-m-d");
	$footer = "This is an example footer text. You can change on the settings page.";
	$title = "Hello World";
	$text = 'This is just an example post to show you, how awesome sim[post] will look like when you have published your first post!<br><br>To add a new 
	post, click on the "new+"-button on the top-left corner. <br> To add a new user or change some settings on your page, go to the settings-page (top-right-corner).<br>
	If you want to change your password, set a profile-picture or change your username, click on your name right above in the admin-bar.<br><br>And now: Have fun
	with <b>sim[post]</b>!';
	
	$author = "Matteo Gisler";
	$email = "Dont look into the source-code, dammit!";
	$comment = "Hi, I am a comment. If you are logged in, you may delete this one. Isn't this a really simple and clean CMS?";
	$comment = addslashes($comment);
	
	mysql_connect($host, $dbuser, $dbpassword) or die(mysql_error()); 
	mysql_select_db($dbname) or die(mysql_error());
	mysql_query("INSERT INTO settings SET blog_name = '$blogname', favicon = 'img/logo.png', footer = '$footer'");
	mysql_query("INSERT INTO posts SET title = '$title', text = '$text', first_name = 'John', last_name = 'Doe', author = '1', date = '$date';");
	mysql_query("INSERT INTO comments SET author = '$author', text = '$comment', email = '$email', post_id = '1', date = '$date';");
	mysql_close();
	
	/* register user */
	
	mysql_connect($host, $dbuser, $dbpassword) or die(mysql_error()); 
	mysql_select_db($dbname) or die(mysql_error());
	
	$hash = hash('sha256', $password1);
 
	function createSalt()
	{
		$text = md5(uniqid(rand(), true));
		return substr($text, 0, 3);
	}
	 
	$salt = createSalt();

	$password = hash('sha256', $salt . $hash);
	 
	$username = mysql_real_escape_string($username);
	 
	$query = "INSERT INTO users ( username, first_name, last_name, password, email, salt, avatar )
			VALUES ( '$username', '$firstname', '$lastname', '$password', '$email', '$salt', '$avatar' );";
	mysql_query($query);
	 
	mysql_close();
	
	/* redirect to login page */
	
	header('Location: ../login/');
	exit();
	
?>