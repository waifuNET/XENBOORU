<?php
$php_location = dirname($_SERVER['DOCUMENT_ROOT']) . "/" . $_SERVER['SERVER_NAME'] . "/php/";
//echo $php_location . "db.php";

require($php_location . "db.php");


$query = mysqli_query($connect, 'SELECT COUNT(*) FROM `allimage`');
$row = mysqli_fetch_row($query);
$total_posts = $row[0] + 1;

$query = mysqli_query($connect, 'SELECT `value` FROM `parameters` WHERE `variable` = "server_id"');
$row = mysqli_fetch_row($query);
$counter = intval($row[0]);

$query = mysqli_query($connect, 'SELECT `value` FROM `parameters` WHERE `variable` = "servers_check_last_count"');
$row = mysqli_fetch_row($query);
$servers_check_last_count = intval($row[0]);

$force_check = false;
	
if($counter < 0 || $counter > count($_SERVERS)){
	$counter = 0;
	$force_check = true;
}

if((($total_posts % 100 == 0) && $servers_check_last_count != $total_posts) || $force_check){
	for($i = 0; $i < count($_SERVERS); $i++){
		$space = intval(file_get_contents($_SERVERS[$counter] . "diskinfo.php?disk=free"));
		if($space <= 0){
			$counter++;	
			continue;
		}

		$counter = $i;
		mysqli_query($connect, "UPDATE `parameters` SET `value`='$counter' WHERE `variable` = 'server_id'");
		mysqli_query($connect, "UPDATE `parameters` SET `value`='$total_posts' WHERE `variable` = 'servers_check_last_count'");
		break;
	}
}

$_SERVER = $_SERVERS[$counter];
$_SERVER_UPLOAD_FILES = $_SERVER . "php/uploadfile.php";

?>