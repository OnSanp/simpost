<html>
<head>
	<title>login</title>
	<?php include '../includes.php'; ?>
	<link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
</head>
<body>
	<div id="adminnav">
		<a href="../"><div class="nav_button" style="float: left;">home</div></a>
	</div>
	<div id="header">[login]<br></div>
	<div id="content">
		<div id="input">
			<form action="../php/login.php" method="post">
				<p>username <br><input type="text" name="username" style="text-align: center; width: 100%;" placeholder="your username"/></p>
				<p>password <br><input type="password" name="password" style="text-align: center; width: 100%;" placeholder="your password"/></p>
				
				<p><input type="submit" value="login" style="font-weight: lighter;"/></p>
				
			</form>
		</div>
	</div>
</body>
</html>