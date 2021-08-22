<?php
require("./db.php");
require("./session.php");

require("./php_functions.php");

if($user_status == "administrator"){
	$query_c = mysqli_query($connect, "SELECT COUNT(*) FROM `total_tags`");
	$total_tags_count = mysqli_fetch_row($query_c)[0];

	$query = mysqli_query($connect, "SELECT `tag` FROM `total_tags`");

	$tag_count = 1;
	while($content = mysqli_fetch_array($query)) {
		$tag = $content['tag'];
		$ctag = '%' . $content['tag'] . '%';

		$stmt = $connect->prepare("SELECT COUNT(*) FROM `allimage` WHERE `tags` LIKE ?");
		$stmt->bind_Param('s', $ctag);
		$stmt->execute();
		$result = $stmt->get_result();

		$count = $result->fetch_row()[0]; 

		$stmt = $connect->prepare("UPDATE `total_tags` SET `count`= ? WHERE `tag` LIKE ?");
		$stmt->bind_Param('is', $count, $tag);
		$stmt->execute();

		//echo ($tag_count . "/" . $total_tags_count . " " . $tag . ": " . $count . "<br>");
		$tag_count++;
	}


	echo "Math success!";
}
else{
	echo "You not a administrator!";
}

mysqli_close($connect);
?>
