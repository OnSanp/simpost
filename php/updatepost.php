 <?php
	$title = $_POST['title'];
	$text = $_POST['text'];
	$id = $_POST['id'];
	
	include '../functions.php';
	
	$connection = connect();
	selectdb($connection);
 
	$query = "UPDATE posts SET title = '$title', text = '$text' WHERE post_id = '$id';";
		
	mysql_query($query);
 
	mysql_close();
	
	header('Location: ../editpost.php?id='.$id.'#successful');
	exit();
?>