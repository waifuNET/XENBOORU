<?php
	$tag = htmlspecialchars($_GET['tag']);
	header("Location:../index.php?tag=$tag&page=0");
?>