<?php
require("./db.php");
require("../cfg.php");
require("./session.php");

require("./php_functions.php");

$login    = mysqli_real_escape_string($connect, trim($_POST['username']));
$password = crypt(md5(mysqli_real_escape_string($connect, trim($_POST['userpassword']))), $_PASSWORD_SALT);
$email    = mysqli_real_escape_string($connect, trim($_POST['useremail']));

$result_code = 0;

$stmt = $connect->prepare("SELECT * FROM `users` WHERE `login` = ? OR `email` = ?");
$stmt->bind_Param('ss', $login, $email);
$stmt->execute();
$result = $stmt->get_result();
$avatar = './users/avatars/default.jpg';

$row = mysqli_fetch_assoc($result);
if($row <= 0){
    if(strlen(trim($login)) >= 4){
        $date = date("Y-m-d H:i:s");
        $stmt = $connect->prepare("INSERT INTO `users`(`id`, `login`, `password`, `email` , `avatar`, `date`) VALUES (NULL, ?, ?, ?, ?, ?)");
        $stmt->bind_Param('sssss', $login, $password, $email, $avatar, $date);
        $stmt->execute();

        $result_code = 1;
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;

        $user_auth = true;
        $login = $_SESSION["login"];
        $password = $_SESSION["password"];
    }
}
else{
 $result_code = 2; 
}
?>

<script>
	window.location.href = '../index.php?dpage=registration&result=<?php echo $result_code; ?>';
</script>