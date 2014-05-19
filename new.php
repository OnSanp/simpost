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
	
	$sql = "SELECT first_name FROM users WHERE user_id = $id";
	$firstname=mysql_query($sql,$connection) or die(mysql_error());
	$firstname=mysql_result($firstname, 0);
	
	$sql = "SELECT last_name FROM users WHERE user_id = $id";
	$lastname=mysql_query($sql,$connection) or die(mysql_error());
	$lastname=mysql_result($lastname, 0);
		
	close($connection);
	
	$author = $id;
?>

<html>
	<head>
		<title>new post</title>
		<?php include 'includes.php'; ?>
	</head>
	<body>
		<div id="successful">Done!</div>
		<div id="failed">Failed! Please try again.</div>
		<div id="adminnav">
			<a href="/"><div class="nav_button" style="float: left; width: auto;">home</div></a>
			<a href="settings.php"><div class="nav_button" style="float: right; width: auto; ">settings</div></a>
			<a href="account.php?id=<?php echo $_SESSION['sess_user_id']; ?>"><div class="nav_button" style="float: none; width: 12em; margin: 0 auto;"<?php echo $_SESSION['sess_username']; ?></div></a>
		</div>
		<div id="header">new [post]<br></div>
		<div id="content">
			<div id="input">
				<form action="php/newpost.php" method="post">
					<p>title <br><input type="text" name="title" style="text-align: center; width: 100%;" placeholder="write your title here" autocomplete='off'/></p>
					<p>text <br><textarea name="text" rows="30" style="width: 100%;" placeholder="type your post here"></textarea></p>
					<input type="hidden" name="author" value="<?php echo $author; ?>">
					<p><input type="submit" value="post" style="font-weight: lighter;"/></p>
				</form>
			</div>
		</div>
	</body>
</html>