<?php
require("../../php/db.php");
require("../../php/session.php");

require("./php_functions.php");
?>

<?php
$tag = mysqli_real_escape_string($connect, $_POST['tags']);

$stmt = $connect->prepare("SELECT * FROM `total_tags` WHERE `tag` LIKE ? AND `count` > 0 ORDER BY `total_tags`.`count` DESC LIMIT 0, 10");
$ptag = '%' . $tag . '%';
$stmt->bind_Param('s', $ptag);
$stmt->execute();
$query = $stmt->get_result();
?>
<ul class="list-group">
	<?
	while($content = mysqli_fetch_array($query)) {
		$value = $content['tag'];
		$count = $content['count'];

		include './tag-static.php';

	}
	?>
</ul>
<?php

mysqli_close($connect);
?>