<?php
	include '../functions.php';

	$connection = connect();
	selectdb($connection);

	$query = "SELECT * FROM posts ORDER BY post_id DESC";
	$result = mysql_query($query);

	while($row = mysql_fetch_assoc($result)){
		printf ('<div class="heading"><a href="post.php?id=%s">%s</a></div><div class="author"><a href="account.php?id=%s">%s %s</a> - %s</div><p>%s</p><hr><br>' , $row["post_id"], $row["title"], $row["author"], $row["first_name"], $row["last_name"], $row["date"], $row["text"]);
	}

	close($connection);
?>