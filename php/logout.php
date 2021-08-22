<?php
require("./php/session.php");

	$_SESSION["login"] = "null";
	$_SESSION["password"] = "null";

	$user_auth = false;

	$login = "null";
	$password = "null";
?>

<script>
	window.location.href = '../index.php';
</script>