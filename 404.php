<?php
	$errorcode = "404";
	$errortext = "The requested site could not be found!";
?>
<html>
	<head>
		<title><?php echo $errorcode; ?></title>
		<?php include 'includes.php'; ?>
	</head>
	<body>
		<?php include 'includes/error.php'; ?>
		<p><div class="discription">
			<b><a href="/">go back</a></b>
		</div></p>
	</body>
</html>
 