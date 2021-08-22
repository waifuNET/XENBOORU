<?php
require("./db.php");
require("./session.php");

require("./php_functions.php");

$auth = 0;
$login = mysqli_real_escape_string($connect, $_POST['username']);
if(strlen(trim($login)) < 4){
	$login = "anonymous";
}
if($user_auth){
	$auth = 1;
	$login = $user_login;
}
$text = mysqli_real_escape_string($connect, $_POST['usertext']);
if(strlen(trim($text)) < 4){
	$text = "i like it";
}
$view = $_POST['viewid'];

echo $login . "<br>";
echo $text . "<br>";
echo $view . "<br>";

$stmt = $connect->prepare("INSERT INTO `comments`(`id`, `login`, `text`, `viewid`, `auth`) VALUES (NULL, ?, ?, ?, ?)");
$stmt->bind_Param('ssss', $login, $text, $view, $auth);
$stmt->execute();
$result = $stmt->get_result();

?>

<?php 
mysqli_close($connect);
?>

<script>
	window.location.href = '../index.php?view=<?php echo $view; ?>';
</script>