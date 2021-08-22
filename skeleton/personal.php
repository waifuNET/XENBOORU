<?php 
if($user_auth){
  ?>
  <div id="settings-btn" style="text-align: right; padding-right: 1%;">
   <button type="button" onclick="hideElem('profile'); hideElem('settings-btn'); showElem('profile-settings');" class="btn btn-light">settings</button>
 </div>
 <div id="profile-settings" style="display: none;">
  <div class="profile-change-panel">

    <div id="ajax_result">
    </div>
    
    <h2 id="upload-h1">Upload new avatar</h2>
    <label for="fileSelect">Filename:</label>
    <input type="file" required name="photo" id="fileSelect">
    <input type="submit" name="submit" value="Upload" onclick="uploadNewAvatar();">
    <p><strong>Note:</strong> Only .jpg, .jpeg, .png formats allowed to a max size of 10 MB.</p>

    <script>

      function uploadNewAvatar(){
        if (window.FormData === undefined) {
          alert('В вашем браузере FormData не поддерживается');
          return;
        }

        showMessage("Info", "Uploading...");

        var formData = new FormData();
        formData.append('photo', $("#fileSelect")[0].files[0]);

        $( document ).ready(function() {
          $.ajax({
            processData: false,
            contentType: false,
            cache: false,
            type: "POST",
            data: formData,
            url: './php/uploadavatar.php',
            success: function(data) {
              $('#ajax_result').html(data);
            },
            failure: function(data){
              $('#ajax_result').html(data);
            },
            error: function( jqXHR, textStatus, errorThrown ){
              console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
          });
        });
      };
    </script>
    <div style="text-align: right; padding-right: 1%;">
      <button type="button" onclick="hideElem('profile-settings'); showElem('settings-btn'); showElem('profile');" class="btn btn-light">close</button>
    </div>
  </div>

</div>
<div id="profile">
  <div class="personal-div">
   <img src="<?php echo $user_avatar; ?>" alt="Avatar" class="avatar-person"><br>
   <label style="padding-top: 1%; font-size:40px;"><strong><?php echo Ecronirovanie($user_login); ?></strong></label>
 </div>

 <div class="block-right">
  <div id="right" style="padding-top: 5%; padding-right: 2%; padding-left: 5%;">
    <?php
    if(mysqli_real_escape_string($connect, $_GET['page']) != ""){
      $pageid = mysqli_real_escape_string($connect, $_GET['page']);
    }else{
      $pageid = 0;
    }
    $max_img = 50;
    $before = $pageid * $max_img;

    $tag = mysqli_real_escape_string($connect, $_GET['tag']);
    $stmt = $connect->prepare("SELECT COUNT(*) FROM `allimage` WHERE `after` LIKE ?");
    $stmt->bind_Param('s', $user_login);
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
