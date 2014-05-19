<?php
	include '../functions.php';

	$connection = connect();
	selectdb($connection);

	$query = "SELECT * FROM comments WHERE post_id = $id ORDER BY post_id DESC";
	$result = mysql_query($query);

	while($row = mysql_fetch_assoc($result)){
		printf ('<div class="comment"><p><h3>%s - %s</h3>%s</p><div class="deletecomment"><form action="php/deletecomment.php" method="POST"><input type="hidden" value="%s" name="site_id"><input type="hidden" value="%s" name="id"><input type="submit" value="X"></form></div></div><br>' , $row["author"], $row["date"], $row["text"],$id ,$row["comment_id"]);
	}

	close($connection);
?>