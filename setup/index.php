<html>
<head>
	<title>setup</title>
	<?php include '../includes.php'; ?>
	<link href="../style.css" type="text/css" rel="stylesheet"/>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
	<style>
		input, textarea
		{
			border: none;
			background-color: #424242;
			color: white;
		}
		
		.classic_button
		{
			background-color: #424242;
		}
		
		#header
		{
			color: white;
		}
		
	</style>
</head>
<body style="background-color: #424242; color: white;">
	<div id="header"><div id="avatar"><img src="../img/logo.png" alt="simpost logo"></div>[setup]<br></div>
		<div id="content">
		<div class="discription">
			<p><h2>general settings</h2>
			<div id="input">
			<form action="../php/setup.php" method="post">
				<p>blog name <br><input type="text" name="blogname" value="<?php echo $blogname; ?>" style="text-align: center; width: 100%;" placeholder="blog name" autocomplete="off" required/></p>
			<p><h2>user settings</h2>
			<h3>add admin user</h3>
				<p>username <br><input type="text" name="username" style="text-align: center; width: 100%;" placeholder="username" autocomplete="off" required/></p>
				<p>password <br><input type="password" name="password1" style="text-align: center; width: 100%;" placeholder="password" autocomplete="off" required/></p>
				<p>confirm password <br><input type="password" name="password2" style="text-align: center; width: 100%;" placeholder="confirm password" autocomplete="off" required/></p>
				<p>e-mail <br><input type="text" name="email" style="text-align: center; width: 100%;" placeholder="your e-mail" autocomplete="off" required/></p>
				<input name="avatar" type="hidden" value="img/avatar.jpg" >
			<p><h2>database settings</h2>
			<h3>database informations</h3>
				<p>database name <br><input value="simpost" type="text" name="dbname" style="text-align: center; width: 100%;" placeholder="default: simpost" autocomplete="off" required/></p>
				<p>database user<br><input type="text" name="dbuser" style="text-align: center; width: 100%;" placeholder="database user" autocomplete="off" required/></p>
				<p>password <br><input type="password" name="dbpassword" style="text-align: center; width: 100%;" placeholder="dbuser password" autocomplete="off" required/></p>
				<p>host <br><input value="localhost" type="host" name="host" style="text-align: center; width: 100%;" placeholder="default: localhost" autocomplete="off" required/></p>
				<input type="hidden" value="img/avatar.jpg" name="avatar">
				<p><input class="classic_button" type="submit" value="setup" style="font-weight: lighter;"/></p>
			</form>
			</div>
			</p>
		</div>
	</div>
</body>
</html>