<?php
	session_start();
	 
	if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
		header("location: /login");
		exit();
	} 
	
	include 'functions.php';

	$connection = connect();
	selectdb($connection);

	$query = "SELECT user_id, username FROM users ORDER BY user_id ASC";
	$result = mysql_query($query);
?>

<html>
	<head>
		<title>manage[users]</title>
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
		<div id="header">manage [users]</div>
		<div class="discription">
			<?php
				while($row = mysql_fetch_assoc($result)){
					printf ('<p><div class="classic_button"><a href="account.php?id=%s">%s | %s </a><br><form action="php/deleteaccount.php" method="POST"><input name="site" type="hidden" value="manage"><input name="id" type="hidden" value="%s"><input type="submit" value="delete" style="font-size: 1.2em;"></form></div></p>', $row["user_id"] ,$row["user_id"], $row["username"], $row["user_id"]);
				}
				close($connection);
			?>
		</div>
	</body>
</html>