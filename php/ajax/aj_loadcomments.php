<?php
require("../db.php");
require("../session.php");

require("../php_functions.php");

$max_comments = 5;
$pageid = mysqli_real_escape_string($connect, $_POST['page']); 
$before = mysqli_real_escape_string($connect, $pageid * $max_comments);

$viewid = mysqli_real_escape_string($connect, $_POST['viewid']);
$stmt = $connect->prepare("SELECT * FROM `comments` WHERE `viewid` LIKE ? ORDER BY `id` DESC LIMIT ?, ?");
$stmt->bind_Param('sss', $viewid, $before, $max_comments);
$stmt->execute();
$result = $stmt->get_result();

$commentsCount = 0;
while($content = mysqli_fetch_array($result)){
  include("../../skeleton/comments.php");
  $commentsCount++;
  ?>
  <?php
}

$stmt = $connect->prepare("SELECT COUNT(*) FROM `comments` WHERE `viewid` LIKE ?");
$stmt->bind_Param('s', $viewid);
$stmt->execute();
$result = $stmt->get_result();

$count_all = $result->fetch_row();

$count = $count_all[0];
$max_img = $max_comments;

include "../../skeleton/comments_nav.php";

mysqli_close($connect);
?>

