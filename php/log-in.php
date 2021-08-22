<?php
require("./db.php");
require("../cfg.php");
require("./session.php");

require("./php_functions.php");


$login = mysqli_real_escape_string($connect, trim($_POST['username']));
$password = crypt(md5(mysqli_real_escape_string($connect, trim($_POST['userpassword']))), $_PASSWORD_SALT);

$stmt = $connect->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?");
$stmt->bind_Param('ss', $login, $password);
$stmt->execute();
$result = $stmt->get_result();

// $ptag = '%' . $tag . '%';

$row = mysqli_fetch_assoc($result);
$result_code = 0;
if($row > 0){
   $result_code = 1;
   $_SESSION["login"] = $login;
   $_SESSION["password"] = $password;

   $user_auth = true;
   $login = $_SESSION["login"];
   $password = $_SESSION["password"];
}
?>

<script>
    window.location.href = '../index.php?dpage=login&result=<?php echo $result_code; ?>';
</script>