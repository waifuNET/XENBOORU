<?php
require("../db.php");
require("../session.php");

require("../php_functions.php");

$auth = 0;
$login = mysqli_real_escape_string($connect, $_POST['username']);
if(strlen(trim($login)) < 2){
	$login = "anonymous";
}
if($user_auth){
	$auth = 1;
	$login = $user_login;
}
$text = mysqli_real_escape_string($connect, $_POST['usertext']);
if(strlen(trim($text)) < 2){
	$text = "i like it <3";
}
$view = mysqli_real_escape_string($connect, $_POST['viewid']);

echo $login . "<br>";
echo $text . "<br>";
echo $view . "<br>";

$stmt = $connect->prepare("INSERT INTO `comments`(`id`, `login`, `text`, `viewid`, `auth`) VALUES (NULL, ?, ?, ?, ?)");
$stmt->bind_Param('ssss', $login, $text, $view, $auth);
$stmt->execute();
?>

<?php 
mysqli_close($connect);
?>
