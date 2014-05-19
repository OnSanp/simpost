<?php
	$title = $_POST["title"];
	$text = $_POST["text"];
	$author = $_POST["author"];
	
	include '../functions.php';
	
	$text = str_replace("\n","<br>",$text);
	$text = addslashes($text);
	$author = addslashes($author);
	$title = addslashes($title);
	$date = date("Y-m-d");

	$connection = connect();
	selectdb($connection);
 
	$sql = "SELECT first_name FROM users WHERE user_id = '$author'";
	$firstname=mysql_query($sql,$connection) or die(mysql_error());
	$firstname=mysql_result($firstname, 0);
 
	$sql = "SELECT last_name FROM users WHERE user_id = '$author'";
	$lastname=mysql_query($sql,$connection) or die(mysql_error());
	$lastname=mysql_result($lastname, 0);

	mysql_close();
	
	$connection = connect();
	selectdb($connection);
 
	$query = "INSERT INTO posts ( author, first_name, last_name, title, text, date )
        VALUES ( '$author', '$firstname', '$lastname', '$title', '$text', '$date' );";
		
	mysql_query($query);
 
	mysql_close();
	
	header('Location: ../#successful');
	exit();
?>