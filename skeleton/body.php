<div id="body">
  <div class="block-left">
    <?php
    require("./static/tags.php");
    ?>
  </div>

  <div class="block-right">
    <div class="upload-block" id="upload-block">

      <div id="ajax_result">
      </div>

      <h2 id="upload-h1">Upload File</h2>
      <label for="fileSelect">Filename:</label>
      <input type="file" required name="photo" id="fileSelect">

      <div id="upload-tags" class="input-group upload-tags">
        <div class="input-group-prepend">
          <span class="input-group-text">tags:</span>
        </div>
        <textarea class="form-control" required name="tags" placeholder="1girl loli smile" style="height: 80px;" maxlength="535" aria-label="With textarea"></textarea>
      </div>

      <div id="upload-tags" class="input-group upload-tags">
        <div class="input-group-prepend">
          <span class="input-group-text">Artist:</span>
        </div>
        <textarea class="form-control" name="artist" placeholder="artist_name artist_name_two" style="height: 40px;" maxlength="535" aria-label="With textarea"></textarea>
      </div>

      <div id="upload-tags" class="input-group upload-tags">
        <div class="input-group-prepend">
          <span class="input-group-text">Character:</span>
        </div>
        <textarea class="form-control" name="character" placeholder="shimakaze_(kancolle)" style="height: 40px;" maxlength="535" aria-label="With textarea"></textarea>
      </div>

      <div id="upload-tags" class="input-group upload-tags">
        <div class="input-group-prepend">
          <span class="input-group-text">Copyright:</span>
        </div>
        <textarea class="form-control" name="copyright" placeholder="kantai_collection" style="height: 40px;" maxlength="535" aria-label="With textarea"></textarea>
      </div>
      <div style="margin-top: 10px;"></div>
      <!--<input type="submit" name="submit" value="Upload" onclick="uploadNewImage();">-->
      <button class="g-recaptcha btn btn-dark" 
      data-sitekey="6Lc1eRkcAAAAALnAcT6rv6xBkLrkvDSPe6QgeDTK" 
      data-callback='uploadNewImage' 
      data-action='submit'>Upload</button>
      <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 10 MB.</p>

      <div class="reCAPTCHADIV">
        This site is protected by reCAPTCHA and the Google
        <a href="https://policies.google.com/privacy">Privacy Policy</a> and
        <a href="https://policies.google.com/terms">Terms of Service</a> apply.
      </div>

      <script>

        function uploadNewImage(token){
          if (window.FormData === undefined) {
            alert('В вашем браузере FormData не поддерживается');
            return;
          }

          showMessage("Info", "Uploading...");

          var formData = new FormData();
          formData.append('photo', $("#fileSelect")[0].files[0]);

          formData.append('tags',      document.getElementsByName("tags")[0].value);
          formData.append('artist',    document.getElementsByName("artist")[0].value);
          formData.append('character', document.getElementsByName("character")[0].value);
          formData.append('copyright', document.getElementsByName("copyright")[0].value);

          $( document ).ready(function() {
            $.ajax({
              processData: false,
              contentType: false,
              cache: false,
              type: "POST",
              data: formData,
              //url: './php/uploadfile.php',
              url: '<?php echo($_SERVER_UPLOAD_FILES);?>',
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

    </div>
    <div id="right" style="padding-right: 1%;">
      <?php
      $pageid = Ecronirovanie($_GET['page']);
      if (!is_numeric($pageid)){
        $pageid = 0;
      }
      $max_img = 50;
      $before = $pageid * $max_img;

      $tag = Ecronirovanie($_GET['tag']);

      $tags = explode(' ', trim($tag));
      $stack = array();
      if($tag != ""){
        foreach ($tags as &$value) {
          $stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `tags` LIKE ?");
          $tag_sql = '%' . $value . '%';
          $stmt->bind_Param('s', $tag_sql);
          $stmt->execute();
          $result_count = $stmt->get_result();
          while($content = mysqli_fetch_array($result_count)){
            $add = true;
            $lc_tags = explode(' ', Ecronirovanie(trim($content['tags'])));
            foreach ($tags as $find) {
              if (!in_array($find, $lc_tags)) {
                $add = false;
                break;
              }
            }
            if($add == true)
              array_push($stack, $content['id']);
          }
        }
      }
      else{
        $stmt = $connect->prepare("SELECT * FROM `allimage` ORDER BY `allimage`.`id` DESC LIMIT ?, ?");
        $stmt->bind_Param('ii', $before, $max_img);
        $stmt->execute();
        $result_count = $stmt->get_result();

        while($content = mysqli_fetch_array($result_count)){
          require("./skeleton/pre_image.php");
        }
      }

      if(count($stack) > 0){
        $stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `id` IN (" . implode(',', array_map('intval', $stack)) . ") ORDER BY `id` DESC LIMIT ?, ?");
        $stmt->bind_Param('ii', $before, $max_img);
        $stmt->execute();
        $result = $stmt->get_result();

        $count = count($stack);
        while($content = mysqli_fetch_array($result)){
          require("./skeleton/pre_image.php");
        }
      }
      else if($tag != "" && count($stack) <= 0){
        $count = 0;
      }
      else{ //this "else" fixed search by tag
      $result = mysqli_query($connect, "SELECT COUNT(*) FROM `allimage`");
      $count = mysqli_fetch_row($result)[0];
    }
    ?>
    
    <div style="text-align: center;">
      <script async type="application/javascript" src="https://a.realsrv.com/ad-provider.js"></script> 
      <ins class="adsbyexoclick" data-zoneid="4397562"></ins> 
      <script>(AdProvider = window.AdProvider || []).push({"serve": {}});</script>
  </div>

</div>
</div>
</div>