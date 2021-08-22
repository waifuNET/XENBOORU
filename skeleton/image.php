<?php
$view = mysqli_real_escape_string($connect, $_GET['view']);

$stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `id` LIKE ?");
$stmt->bind_Param('s', $view);
$stmt->execute();
$result = $stmt->get_result();

$row = mysqli_fetch_assoc($result);

$user_name = $row['after'];

$stmt = $connect->prepare("SELECT * FROM `users` WHERE `login` LIKE ?");
$stmt->bind_Param('s', $user_name);
$stmt->execute();
$result_id = $stmt->get_result();

$row_id = mysqli_fetch_assoc($result_id);
?>

<?php
if($user_status == "administrator" && $row != null && $user_name == $user_login){ 
 ?>
 <div style="width: 90%; padding-left: 10px;">
  <div>
    <a style="color: #007bff;overflow-wrap: anywhere; color: #000000;font-weight: bold;">Admin tools</a>
  </div>
  <script>
    function delete_post(){
     $( document ).ready(function() {
      $.ajax({
        type: "GET",
        data: {
          view: '<?php echo $view;?>',
        },
        url: './php/delete_post.php',
        success: function(data) {
          location.reload();
        }
      });
    });
   }
 </script>
 <button class="btn btn-light" style="background-color: #ff000047; margin-top: 10px; position: static;" onclick="delete_post();">delete</button>
 <?php
}
?>
</div>

<div class="image-viwear">
  <div class="view-left">
    <?php
    if($row != null){
      include "./skeleton/image-left.php";
    }
    ?>
  </div>
  <div id="view-image" class="view-right">
    <?php
    if($row_id > 0){
      $after_url = $row_id['id'];
    }
    else{
      $after_url = -1;
    }
    ?>
    <div class="image-image">
      <?php
      if($row != null){
        ?>
        <img class="image-size" src="<?php echo $row['image']; ?>"><br>
        <!--<img class="lazyImg image-size" data-original="<?php echo $row['image']; ?>" />-->

        <label style="font-size:40px;"></label>
        <a style="cursor: pointer; color: #007bff;" class="noselect" onclick="editSt();">edit</a>
        <script>
          var edit_status = false;
          function editSt(){
            if(!edit_status){
              showElem('edit-panel');
              edit_status = true;
            }
            else{
              hideElem('edit-panel');
              edit_status = false;
            }
          }
        </script>
        <div id="edit-panel" class="edit-panel" style="">
          <form id="edit-panel-form" name="edit-panel-form" action="./php/changeimage.php" method="post">
            <input value="<?php echo $_GET['view']; ?>" name="viewid" style="display: none;">

            <div id="edit-tags" class="input-group">
              <div class="input-group-prepend">
               <span class="input-group-text">tags:</span>
             </div>
             <textarea class="form-control" required name="tags" placeholder="1girl, loli, smile" style="height: 80px;" minlength="3" maxlength="535" aria-label="With textarea"><?php echo Ecronirovanie($row['tags']);?></textarea>
           </div>
           <div style="margin-top: 10px;"></div>

           <div id="edit-tags" class="input-group">
            <div class="input-group-prepend">
             <span class="input-group-text">Artist:</span>
           </div>
           <textarea class="form-control" name="artist" placeholder="artist_name artist_name_two" style="height: 40px;" maxlength="535" aria-label="With textarea"><?php echo Ecronirovanie($row['artist']);?></textarea>
         </div>
         <div style="margin-top: 10px;"></div>

         <div id="edit-tags" class="input-group">
          <div class="input-group-prepend">
           <span class="input-group-text">Character:</span>
         </div>
         <textarea class="form-control" name="character" placeholder="shimakaze_(kancolle)" style="height: 40px;" maxlength="535" aria-label="With textarea"><?php echo Ecronirovanie($row['name_character']);?></textarea>
       </div>
       <div style="margin-top: 10px;"></div>

       <div id="edit-tags" class="input-group">
        <div class="input-group-prepend">
         <span class="input-group-text">Copyright:</span>
       </div>
       <textarea class="form-control" name="copyright" placeholder="kantai_collection" style="height: 40px;" minlength="3" aria-label="With textarea"><?php echo Ecronirovanie($row['copyright']);?></textarea>
     </div>
     <div style="margin-top: 10px;"></div>

     <!--<button type="submit" class="btn btn-light" style="margin-top: 10px; position: static;">confirm</button>-->
     <button class="g-recaptcha btn btn-light" 
     data-sitekey="6Lc1eRkcAAAAALnAcT6rv6xBkLrkvDSPe6QgeDTK" 
     data-callback='editSubmit' 
     data-action='submit'>Submit</button>

     <div class="reCAPTCHADIV">
      <br>
      This site is protected by reCAPTCHA and the Google
      <a href="https://policies.google.com/privacy">Privacy Policy</a> and
      <a href="https://policies.google.com/terms">Terms of Service</a> apply.
    </div>
  </form>
</div>

<script>
 function editSubmit(token) {
   document.getElementById("edit-panel-form").submit();
 }
</script>

</div>



<div id="new-cooment" style="padding-left: 20%; padding-right: 20%; text-align: right;">
  <?php if($user_auth) {?>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">@</span>
      </div>
      <input readonly value="<?php echo $user_login; ?>" type="text" id="username" name="username" required class="form-control" minlength="4" maxlength="26" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
  <?php }else{ ?>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">@</span>
      </div>
      <input type="text" id="username" name="username" required class="form-control" minlength="4" maxlength="26" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
  <?php } ?>

  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">Text</span>
    </div>
    <textarea class="form-control" required id="usertext" name="usertext" minlength="4" maxlength="535" aria-label="With textarea"></textarea>
  </div>
  <button type="submit" class="btn btn-light" onclick="addcomment();" style="margin-top: 10px; position: static;">Send</button>

  <script>
    var comments_page = 0;
    function new_page(value){
      comments_page = parseInt(value);
      update(comments_page * 5);
    }

    var total_posts = 0;
    function update(otv){
     $( document ).ready(function() {
      $.ajax({
        type: "POST",
        data: {
          page: comments_page,
          ot: otv,
          viewid: '<?php echo $_GET['view']; ?>',
        },
        url: './php/ajax/aj_loadcomments.php',
        success: function(data) {
          $('#comments').html(data);
        }
      });
    });
   }
   update(0);

   function addcomment() {
    if(document.getElementById("username").value.length < 2 ||
     document.getElementById("usertext").value.length < 2 ){
      return;
  }

  $.ajax({
    type: "POST",
    data: {
      viewid: '<?php echo $_GET['view']; ?>',
      username: document.getElementById("username").value,
      usertext: document.getElementById("usertext").value,
    },
    url: './php/ajax/aj_addcomment.php',
    success: function(data) {
      update(0);
    }
  });
  document.getElementById("usertext").value = "";
}
</script>

</div>
<?php }
else{
  ?>
  <img class="image-size" src="../websrc/404.png"><br>
  <?php if($row != null){ ?>
   <hr>
 <?php }
 else{
  ?>
  <div style="padding-top: 10px;"></div>
  <strong> <p style="font-size: 200%;">404 not found</p> </strong>
  <?php 
}
?>
<?php
}
?>
<div style="padding-left: 20%; padding-right: 20%; height: auto;" id="comments">

</div>

<div id="more" style="text-align: center; margin-bottom: 60px; display: none;">
  <button name="ct" type="submit" class="btn btn-light" onclick="loadComments(5);" style="margin-top: 10px; position: static;">load more comments</button>
</div>

<div style="padding-top: 60px;"></div>
</div>
</div>