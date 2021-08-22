<?php
require("../db.php");
require("../session.php");

require("../php_functions.php");

?>

<?php
function deleteDirectory($dir) {
	if (!file_exists($dir)) {
		return true;
	}

	if (!is_dir($dir)) {
		return unlink($dir);
	}

	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') {
			continue;
		}

		if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
			return false;
		}

	}

	return rmdir($dir);
}

if($user_status == "administrator"){ //TRUNCATE TABLE allimage
	mysqli_query($connect, "TRUNCATE TABLE `allimage`");
	mysqli_query($connect, "TRUNCATE TABLE `comments`");
	mysqli_query($connect, "TRUNCATE TABLE `total_tags`");

	deleteDirectory("../src/");

	echo "Remove success!";
}
else{
	echo "You not a administrator!";
}
mysqli_close($connect);

?>