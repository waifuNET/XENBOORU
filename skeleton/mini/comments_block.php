  <?php
  $stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `id` LIKE ?");
  $stmt->bind_Param('s', $id);
  $stmt->execute();
  $query = $stmt->get_result();

  $post = mysqli_fetch_array($query);
  ?>

  <div class="comment">
    <div class="img-left">
      <a href='./index.php?view=<?php echo $post['id'];?>'>
        <?php
        $path_parts = pathinfo($post['image']);
        $img = str_replace("full", "low", $post['image']);
        ?>
        <img class="comments-img" src="<?php echo $img;?>"/>
      </a>
    </div>
    <div class="img-right">
      <?php
      $stmt = $connect->prepare("SELECT * FROM `comments` WHERE `viewid` LIKE ? ORDER BY `comments`.`id` DESC LIMIT 0, 4");
      $stmt->bind_Param('s', $id);
      $stmt->execute();
      $comments = $stmt->get_result();

      while($content = mysqli_fetch_array($comments)){
       include "./skeleton/comments.php";
     }
     ?>
   </div>
 </div>
 <div style="padding-top: 50px;"></div>