 <?php
	$id = $_POST['id'];
	$site = $_POST['site'];
	
	include '../functions.php';
	
	$connection = connect();
	selectdb($connection);
 
	$query = "DELETE FROM posts WHERE post_id = '$id';";
		
	mysql_query($query);
	mysql_close();
	
	if($site == "manage"){
		header('Location: ../manageposts.php#successful');
		exit();
	}else{
		header('Location: ../#successful');
		exit();
	}
?>