<?php 
if(mysqli_real_escape_string($connect, $_GET['user']) != ""){
    if($user_auth){
        if(mysqli_real_escape_string($connect, $_GET['user']) == $user_id){
            echo "<script>window.location.href = './index.php?dpage=personal';</script>";
        }
    }
    $user = mysqli_real_escape_string($connect, $_GET['user']);
    $result_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` LIKE '$user'");
    $row_user = mysqli_fetch_assoc($result_user);
    $user_login = $row_user['login'];
    ?>
    <div id="profile">
        <div class="personal-div">
         <img src="<?php echo $row_user['avatar']; ?>" alt="Avatar" class="avatar-person"><br>
         <label style="padding-top: 1%; font-size:40px;"><strong><?php echo Ecronirovanie($row_user['login']); ?></strong></label>
     </div>

     <div class="block-right">
        <div id="right" style="padding-top: 5%; padding-right: 2%; padding-left: 5%;">
            <?php
            if(mysqli_real_escape_string($connect, $_GET['page']) != ""){
                $pageid = mysqli_real_escape_string($connect, $_GET['page']);
            }else{
              $pageid = 0;
          }
          $max_img = 60;
          $before = $pageid * $max_img;

          $tag = mysqli_real_escape_string($connect, $_GET['tag']);
          $stmt = $connect->prepare("SELECT COUNT(*) FROM `allimage` WHERE `id` LIKE ?");
          $stmt->bind_Param('s', $user);
          $stmt->execute();
          $result_count = $stmt->get_result();

          $stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `after` LIKE ? AND `tags` LIKE ? ORDER BY `id` DESC LIMIT ?, ?");
          $ptag = '%' . $tag . '%';
          $stmt->bind_Param('ssii', $user_login, $ptag, $before, $max_img);
          $stmt->execute();
          $result = $stmt->get_result();

          $result_count = $result_count->fetch_row();
          $count = $result_count[0];
          while($content = mysqli_fetch_array($result)){
              require("./skeleton/pre_image.php");
          }
          ?>
      </div>
  </div>
  <?php
  require("./skeleton/footer.php");
  ?>

  <?php
}
else{
    echo "<script>window.location.href = './index.php';</script>";
}
?>
</div>
