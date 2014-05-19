<?php
	session_start();
	include 'functions.php';
	
	$id = $_GET['id'];
	
	if ($id > 0){
	$connection = connect();
	selectdb($connection);
	
	$sql = "SELECT username FROM users WHERE user_id = $id";
	$username=mysql_query($sql,$connection) or die(mysql_error());
	$username=mysql_result($username, 0);
	
	$sql = "SELECT first_name FROM users WHERE user_id = $id";
	$firstname=mysql_query($sql,$connection) or die(mysql_error());
	$firstname=mysql_result($firstname, 0);
	
	$sql = "SELECT last_name FROM users WHERE user_id = $id";
	$lastname=mysql_query($sql,$connection) or die(mysql_error());
	$lastname=mysql_result($lastname, 0);
	
	$sql = "SELECT avatar FROM users WHERE user_id = $id";
	$avatar=mysql_query($sql,$connection) or die(mysql_error());
	$avatar=mysql_result($avatar, 0);
	
	$sql = "SELECT bio FROM users WHERE user_id = $id";
	$bio=mysql_query($sql,$connection) or die(mysql_error());
	$bio=mysql_result($bio, 0);
	
	$sql = "SELECT email FROM users WHERE user_id = $id";
	$email=mysql_query($sql,$connection) or die(mysql_error());
	$email=mysql_result($email, 0);
	
	$sql = "SELECT avatar FROM users WHERE user_id = $id";
	$avatar=mysql_query($sql,$connection) or die(mysql_error());
	$avatar=mysql_result($avatar, 0);
		
	close($connection);
	}else{
		header('Location: /');
		exit();
	}
	
	$errorcode = '404';
	$errortext = 'The requested user was not found!';
	
?>
<html>
	<head>
		<title>[account]</title>
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
				<a href="/"><div class="nav_button" style="float: none; width: 12em; margin: 0 auto;">home</div></a>
			</div>
		<?php
		}
		?>
		<?php if ($username == "") {
			include 'includes/error.php';
		}else{
		?>
		<div id="header">[account]<br></div>
		<div id="content">
	
		<?php
		if ($_SESSION['sess_user_id'] == $id) {
		?>
			<div class="discription">
				<a href="php/logout.php"><div class="classic_button">log out</div></a>
				<br>
			</div>
		<?php
		}
		?>
		
		<div id="avatar"><img src="<?php echo $avatar ?>" alt="Avatar"><p><b><?php echo $firstname; echo " "; echo $lastname;?></b></p></div>
		
		<div class="discription">
			<?php echo $bio; ?>
		</div>
		<?php
			if ($_SESSION['sess_user_id'] == $id) {
		?>
		<div class="discription">
			<br><h2>account settings</h2>
			<div id="input">
				<form action="php/updateaccount.php" method="post">
					<p>username <br><input type="text" name="username" style="text-align: center; width: 100%;" value="<?php echo $username; ?>" autocomplete="off"/></p>
					<p>first name <br><input type="text" name="firstname" style="text-align: center; width: 100%;" value="<?php echo $firstname; ?>" autocomplete="off"/></p>
					<p>last name <br><input type="text" name="lastname" style="text-align: center; width: 100%;" value="<?php echo $lastname; ?>" autocomplete="off"/></p>
					<p>e-mail <br><input type="text" name="email" style="text-align: center; width: 100%;" value="<?php echo $email; ?>" autocomplete="off"/></p>
					<p>bio <br><textarea name="bio" rows="6" style="width: 100%;"><?php echo $bio; ?></textarea></p>
					<p>avatar (link) <br><input type="text" name="avatar" style="text-align: center; width: 100%;" value="<?php echo $avatar; ?>" autocomplete="off"/></p>
					<input name="id" type="hidden" value="<?php echo $id; ?>">
					<p><input type="submit" value="save" style="font-weight: lighter;"/></p>
				</form>
			</div>
			<br><h2>change password</h2>
			<div id="input">
				<form action="php/updatepassword.php" method="post">
					<p>new password <br><input type="password" name="password1" style="text-align: center; width: 100%;"  autocomplete="off"/></p>
					<p>confirm password <br><input type="password" name="password2" style="text-align: center; width: 100%;"  autocomplete="off"/></p>
					<input name="id" type="hidden" value="<?php echo $id; ?>">
					<p><input type="submit" value="change" style="font-weight: lighter;"/></p>
				</form>
			</div>
			<div id="input">
				<form action="php/deleteaccount.php" method="post">
					<input name="id" type="hidden" value="<?php echo $id; ?>">
					<p><input type="submit" value="delete account" style="font-weight: lighter;"/></p>
				</form>
			</div>
		</div>
		<?php
		}
		?>
		<?php
		}
		?>
		</div>
	</body>
</html>