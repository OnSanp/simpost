 <?php
	$id = $_POST['id'];
	$site_id = $_POST['site_id'];
	
	include '../functions.php';
	
	$connection = connect();
	selectdb($connection);
 
	$query = "DELETE FROM comments WHERE comment_id = $id;";
		
	mysql_query($query);
 
	mysql_close();
	
	header('Location: ../post.php?id='.$site_id.'#successful');
	exit();
?>