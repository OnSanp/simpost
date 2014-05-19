<?php
	session_start();
	if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
		header("location: /login");
		exit();
	} 

	include 'functions.php';
	
	$connection = connect();
	selectdb($connection);
	
	$sql = "SELECT blog_name FROM settings";
	$blogname=mysql_query($sql,$connection) or die(mysql_error());
	$blogname=mysql_result($blogname, 0);
	
	$sql = "SELECT favicon FROM settings";
	$favicon=mysql_query($sql,$connection) or die(mysql_error());
	$favicon=mysql_result($favicon, 0);
	
	$sql = "SELECT logo FROM settings";
	$logo=mysql_query($sql,$connection) or die(mysql_error());
	$logo=mysql_result($logo, 0);
	
	$sql = "SELECT footer FROM settings";
	$footer=mysql_query($sql,$connection) or die(mysql_error());
	$footer=mysql_result($footer, 0);
	
	close($connection);
?>

<html>
	<head>
		<title>settings</title>
		<?php include 'includes.php'; ?>
	</head>
	<body>
		<div id="successful">Done!</div>
		<div id="failed">Failed! Please try again.</div>
		<div id="adminnav">
			<a href="new.php"><div class="nav_button" style="float: left; width: auto;">+ new</div></a>
			<a href="/"><div class="nav_button" style="float: right; width: auto; ">home</div></a>
			<a href="account.php?id=<?php echo $_SESSION['sess_user_id']; ?>"><div class="nav_button" style="float: none; width: 12em; margin: 0 auto;"><?php echo $_SESSION['sess_username']; ?></div></a>
		</div>
		<div id="header">[settings]<br></div>
		<div id="content">
			<div class="discription">
				<p><div class="classic_button"><a href="manageposts.php">manage posts</a></div>
				<br><div class="classic_button"><a href="manageusers.php">manage users</a></div>
				<br></p>
				<p><h2>general settings</h2>
				<!--<br><input type="checkbox"> enable "about me" page-->
				<div id="input">
					<form action="php/updatesettings.php" method="post">
						<p>blog name <br><input type="text" name="blogname" value="<?php echo $blogname; ?>" style="text-align: center; width: 100%;" placeholder="blog name" autocomplete="off"/></p>
						<p>favicon (link) <br><input type="text" name="favicon" value="<?php echo $favicon; ?>" style="text-align: center; width: 100%;" placeholder="favicon" autocomplete="off"/></p>
						<p>logo (link) <br><input type="text" name="logo" value="<?php echo $logo; ?>" style="text-align: center; width: 100%;" placeholder="blog logo" autocomplete="off"/></p>
						<p>footer text <br><textarea type="text" name="footer" style="text-align: center; width: 100%;" placeholder="your footer text" autocomplete="off"><?php echo $footer; ?></textarea></p>
						<p><input type="submit" value="save" style="font-weight: lighter;"/></p>
					</form>
				</div>
				<p><br><h2>user settings</h2>
				<h3>add user</h3>
				<div id="input">
					<form class="signup-form" action="php/register.php" method="post">
						<p>username <br><input type="text" name="username" style="text-align: center; width: 100%;" placeholder="username" autocomplete="off" required/></p>
						<p>password <br><input type="password" name="password1" style="text-align: center; width: 100%;" placeholder="password" autocomplete="off" required/></p>
						<p>confirm password <br><input type="password" name="password2" style="text-align: center; width: 100%;" placeholder="confirm password" autocomplete="off" required/></p>
						<p>first name <br><input type="text" name="firstname" style="text-align: center; width: 100%;" placeholder="first name" autocomplete="off" required/></p>
						<p>last name <br><input type="text" name="lastname" style="text-align: center; width: 100%;" placeholder="last name" autocomplete="off" required/></p>
						<p>e-mail <br><input type="text" name="email" style="text-align: center; width: 100%;" placeholder="your e-mail" autocomplete="off" required/></p>
						<input name="avatar" type="hidden" value="img/avatar.jpg" >
						<p><input type="submit" value="add" style="font-weight: lighter;"/></p>
					</form>
				</div>
				</p>
			</div>
		</div>
	</body>
</html>