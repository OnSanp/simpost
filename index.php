<?php
	session_start();
	include 'functions.php';
	
	$connection = connect();
	selectdb($connection);
	
	$sql = "SELECT blog_name FROM settings";
	$blogname=mysql_query($sql,$connection) or die(mysql_error());
	$blogname=mysql_result($blogname, 0);
	
	$sql = "SELECT footer FROM settings";
	$footer=mysql_query($sql,$connection) or die(mysql_error());
	$footer=mysql_result($footer, 0);
		
	close($connection);
?>

<html>
	<head>
		<title><?php echo $blogname; ?></title>
		<?php include 'includes.php'; ?>
	</head>
	<body>
		<?php
			if ($_SESSION['sess_user_id'] > 0) {
		?>
		<div id="successful">Done!</div>
		<div id="failed">Failed! Please try again.</div>
		<div id="adminnav">
			<a href="new.php"><div class="nav_button" style="float: left; width: auto;">+ new</div></a>
			<a href="settings.php"><div class="nav_button" style="float: right; width: auto; ">settings</div></a>
			<a href="account.php?id=<?php echo $_SESSION['sess_user_id']; ?>"><div class="nav_button" style="float: none; width: 12em; margin: 0 auto;"><?php echo $_SESSION['sess_username']; ?></div></a>
		</div>
		<?php
			}
		?>
		<div id="header"><?php echo $blogname?><br></div>
		<div id="content">
			<div class="post">
				<hr><br>
				<?php include 'php/showposts.php'; ?>
			</div>
		<?php include 'includes/footer.php'; ?>
		<br>
		</div>
	</body>
</html>