<?php
	session_start();
	$id = $_SESSION['sess_user_id'];
	if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
		header("location: /login");
		exit();
	} 

	include 'functions.php';
	
	$connection = connect();
	selectdb($connection);
		
	$id = $_GET['id'];
	
	$sql = "SELECT title FROM posts WHERE post_id = $id";
	$title=mysql_query($sql,$connection) or die(mysql_error());
	$title=mysql_result($title, 0);
	
	$sql = "SELECT text FROM posts WHERE post_id = $id";
	$text=mysql_query($sql,$connection) or die(mysql_error());
	$text=mysql_result($text, 0);
		
	close($connection);
?>

<html>
	<head>
		<title>edit post</title>
		<?php include 'includes.php'; ?>
	</head>
	<body>
		<div id="successful">Done!</div>
		<div id="failed">Failed! Please try again.</div>
		<div id="adminnav">
			<a href="/"><div class="nav_button" style="float: left; width: auto;">home</div></a>
			<a href="settings.php"><div class="nav_button" style="float: right; width: auto; ">settings</div></a>
			<a href="account.php?id=<?php echo $_SESSION['sess_user_id']; ?>"><div class="nav_button" style="float: none; width: 12em; margin: 0 auto;"><?php echo $_SESSION['sess_username']; ?></div></a>
		</div>
		<div id="header">edit [post]<br></div>
		<div id="content">
			<div id="input">
				<form action="php/updatepost.php" method="post">
					<p>title <br><input type="text" name="title" style="text-align: center; width: 100%;" value="<?php echo $title; ?>" placeholder="write your title here" autocomplete='off'/></p>
					<p>text <br><textarea name="text" rows="30" style="width: 100%;" placeholder="type your post here"><?php echo $text; ?></textarea></p>
					<input type="hidden" value="<?php echo $id; ?>" name="id">
					<p><input type="submit" value="save" style="font-weight: lighter;"/></p>
				</form>
			</div>
		</div>
	</body>
</html>