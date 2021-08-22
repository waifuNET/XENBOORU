<?php
require("./db.php");
require("./session.php");
require("./functions.php");

require("./php_functions.php");

$viewid = Ecronirovanie($_GET['view']);

$stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `id` LIKE ?");
$stmt->bind_Param('s', $viewid);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$user_name = $row['after'];

if($user_status == "administrator" || $user_name == $user_login){

	$stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `id` LIKE ?");
	$stmt->bind_Param('s', $viewid);
	$stmt->execute();
	$result = $stmt->get_result();

	$row = mysqli_fetch_assoc($result);

	$file_full = $row['image'];
	$file_low = str_replace("full", "low", $row['image']);

	if (file_exists($file_full)) {
		unlink($file_full);
	}
	if (file_exists($file_low)) {
		unlink($file_low);
	}

	changeTagCount($connect, $viewid, "");

	$stmt = $connect->prepare("DELETE FROM `allimage` WHERE `id` LIKE ?");
	$stmt->bind_Param('s', $viewid);
	$stmt->execute();

	$stmt = $connect->prepare("DELETE FROM `comments` WHERE `viewid` LIKE ?");
	$stmt->bind_Param('s', $viewid);
	$stmt->execute();
}

mysqli_close($connect);

header("Location:../index.php?view=".$viewid);
?>
