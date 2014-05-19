  <?php
	$author = $_POST["author"];
	$email = $_POST["email"];
	$comment = $_POST["comment"];
	$post_id = $_POST["post_id"];
	
	$comment = str_replace("\n","<br>",$comment);
	$comment = str_replace("<","",$comment);
	$comment = str_replace(">","",$comment);
	$comment = addslashes($comment);
	$comment = addslashes($author);
	$comment = addslashes($email);
	
	$author = str_replace("<","",$author);
	$author = str_replace(">","",$author);
	
	$date = date("Y-m-d");
	
	include '../functions.php';
	
	$connection = connect();
	selectdb($connection);
 
	$query = "INSERT INTO comments ( author, email, text, date, post_id )
        VALUES ( '$author', '$email', '$comment', '$date', '$post_id' );";
		
	mysql_query($query);
 
	mysql_close();
	
	header('Location: ../post.php?id='.$post_id.'#successful');
	exit();
 ?>