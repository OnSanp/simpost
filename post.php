<?php
	session_start();
	include 'functions.php';
	
	$id = $_GET['id'];
	$sess_user_id = $_SESSION['sess_user_id'];
	if ($id > 0){
	
		$connection = connect();
		selectdb($connection);
		
		$sql = "SELECT title FROM posts WHERE post_id = $id";
		$title=mysql_query($sql,$connection) or die(mysql_error());
		$title=mysql_result($title, 0);
		
		$sql = "SELECT text FROM posts WHERE post_id = $id";
		$text=mysql_query($sql,$connection) or die(mysql_error());
		$text=mysql_result($text, 0);
		
		$sql = "SELECT author FROM posts WHERE post_id = $id";
		$author=mysql_query($sql,$connection) or die(mysql_error());
		$author=mysql_result($author, 0);
		
		$sql = "SELECT date FROM posts WHERE post_id = $id";
		$date=mysql_query($sql,$connection) or die(mysql_error());
		$date=mysql_result($date, 0);
		
		$sql = "SELECT footer FROM settings";
		$footer=mysql_query($sql,$connection) or die(mysql_error());
		$footer=mysql_result($footer, 0);
		
		$sql = "SELECT first_name FROM posts WHERE post_id = '$id'";
		$firstname=mysql_query($sql,$connection) or die(mysql_error());
		$firstname=mysql_result($firstname, 0);
		
		$sql = "SELECT last_name FROM posts WHERE post_id = '$id'";
		$lastname=mysql_query($sql,$connection) or die(mysql_error());
		$lastname=mysql_result($lastname, 0);
		
		$sql = "SELECT COUNT(comment_id) FROM comments WHERE post_id = '$id'";
		$commentcnt=mysql_query($sql,$connection) or die(mysql_error());
		$commentcnt=mysql_result($commentcnt, 0);
		
		$name = $firstname." ".$lastname;
			
		close($connection);
		
		$errorcode = '404';
		$errortext = 'The requested post was not found!';
	}else{
		header('Location: /');
		exit();
	}
?>

<html>
	<head>
		<title><?php echo $title; ?></title>
		<?php include 'includes.php'; ?>
		<?php 
			if($sess_user_id > 0) {
			}else{
		?>
			<style type="text/css">.deletecomment{
				display:none;}
			</style>
		<?php
			} 
		?>
	
</head>
	<body>
		<?php 
		if ($title == "") {
			include 'includes/error.php';
		}else{
		?>
		<?php
			if ($_SESSION['sess_user_id'] > 0) {
		?>
		<div id="successful">Done!</div>
		<div id="failed">Failed! Please try again.</div>
		<div id="adminnav">
			<a href="/"><div class="nav_button" style="float: left; width: auto;">home</div></a>
			<a href="settings.php"><div class="nav_button" style="float: right; width: auto; ">settings</div></a>
			<a href="account.php?id=<?php echo $_SESSION['sess_user_id']; ?>"><div class="nav_button" style="float: none; width: 15em; margin: 0 auto;"><?php echo $_SESSION['sess_username']; ?></div></a>
		</div>
		<?php
		}
		?>
		<div id="postheader"><?php echo $title; ?><br></div>
		<div id="content">
			<div class="post">
				<hr><br>
				<div class="author"><a href="account.php?id=<?php echo $author; ?>"><?php echo $name; ?></a> - <?php echo $date; ?></div>
				<p>
					<?php echo $text; ?>
				</p>
				<div class="classic_button">
					<?php if($sess_user_id > 0){ ?>
						<a style="font-weight: lighter;" href="editpost.php?id=<?php echo $id; ?>">edit</a>
					<?php } ?>
					<?php if($sess_user_id > 0){ ?>
						<form action="php/deletepost.php" method="post">
							<input name="id" type="hidden" value="<?php echo $id; ?>">
							<input class="classic_button" style="font-size: 1em; font-weight: lighter;" type="submit" value="delete">
						</form>
					<?php } ?>
				</div>
			</div>
			<div id="comments">
			<hr>
			<h1>comments [<?php echo $commentcnt; ?>]</h1>
			<?php include 'includes/comments.php'; ?>
			<br> <h1>post a comment</h1>
			<div id="input">
				<form action="php/postcomment.php" method="POST">
					<p>your name <br><input type="text" name="author" style="text-align: center; width: 100%;" placeholder="your name" autocomplete="off" required/>
					<p>email <br><input type="text" name="email" style="text-align: center; width: 100%;" placeholder="your email address" autocomplete="off" required/></p>
					<p>comment <br><textarea name="comment" rows="5" style="text-align: center; width: 100%;" placeholder="what you want to say" autocomplete="off" required></textarea></p>
					<input name="post_id" type="hidden" value="<?php echo $id; ?>">
					<input type="submit" value="post">
				</form>
			</div>
			<hr>
			</div>
		</div>
		<br>
		<?php include 'includes/footer.php'; ?>
		<br>
		<?php
			}
		?>
	</body>
</html>