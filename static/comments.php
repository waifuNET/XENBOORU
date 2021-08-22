<div id="comments">
  <hr>
  <?php
  $max_img = 10;
  $pageid = Ecronirovanie($_GET['page']);
  $before = $pageid * $max_img;

  $stmt = $connect->prepare("SELECT * FROM `comments` WHERE `id` IN (SELECT MAX(`id`) FROM `comments` GROUP BY `viewid`) ORDER BY `id` DESC LIMIT ?, ?");
  $stmt->bind_Param('ii', $before, $max_img);
  $stmt->execute();
  $result = $stmt->get_result();

  $commentsCount = 0;
  while($content = mysqli_fetch_array($result)){
    $id = $content['viewid'];

    $commentsCount++;
    include "./skeleton/mini/comments_block.php";
  }
  $result = mysqli_query($connect, "SELECT COUNT(*) FROM `comments` WHERE `id` IN (SELECT MAX(`id`) FROM `comments` GROUP BY `viewid`) ORDER BY `id` DESC");
  $row = $result->fetch_row();
  $count = $row[0];
  ?>
  <hr>
</div>

<?php 

?>