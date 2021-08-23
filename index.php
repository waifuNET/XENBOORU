<?php
require("./cfg.php");

require("./php/db.php");
require("./php/session.php");

require("./php/php_functions.php");
require("./php/get_optimal_server.php");

?>
<!doctype html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
  <?php 
  require("./skeleton/head.php");
  ?>
  <?php
  $view = mysqli_real_escape_string($connect, $_GET['view']);
  if($view != "")
  {
    $stmt = $connect->prepare("SELECT * FROM `allimage` WHERE `id` LIKE ?");
    $stmt->bind_Param('s', $view);
    $stmt->execute();
    $result_og = $stmt->get_result();

    $row_og = mysqli_fetch_assoc($result_og);

    $title_tags = $row_og['tags'];
    if($title_tags != ""){
      echo "<title>$title_tags</title>";
    }
    else{
      echo "<title> $_WEBSITE_NAME | free anime and hentai gallery</title>";
    }
  }
  else{
    echo "<title> $_WEBSITE_NAME | free anime and hentai gallery</title>";
  }
  ?>

  <meta property="og:image" content="<?php echo trim((!empty($_SERVER['HTTPS']) ? 'http' : 'http') . '://' . $_SERVER['HTTP_HOST'] . str_replace('..', '', $row_og['image'])); ?>" />
</head>
<body style="height: 100vh;">
  <?php
  require("./skeleton/header.php");
  require("./php/empty.php");
  ?>
  <div style="padding-top: 15px;"></div>
  <?php
  if($_GET['page'] != "" && $_GET['dpage'] != "personal" && $_GET['dpage'] != "comments" || $_GET['view'] != "" || $_GET['upload'] != ""){
   if($_GET['view'] == "" || $_GET['upload'] != ""){
     require("./skeleton/body.php");
     require("./skeleton/footer.php");
   }
   else{
    require("./skeleton/image.php");
  }
}
else{
  if($_GET['dpage'] != ""){
    if($_GET['dpage'] == "comments"){
      require("./static/comments.php");
      require("./skeleton/footer.php");
    }
    else if($_GET['dpage'] == "about"){
      require("./static/about.php");
    }
    else if($_GET['dpage'] == "tags"){
      require("./static/tags.php");
    }
    else if($_GET['dpage'] == "personal"){
      require("./skeleton/personal.php");
    }
    else if($_GET['dpage'] == "login"){
      require("./static/login.php");
    }
    else if($_GET['dpage'] == "registration"){
      require("./static/registration.php");
    }
  }
  else if($_GET['user'] != ""){
    require("./skeleton/user.php");
  }
  else if($_GET['php'] == "logout"){
    require("./php/logout.php");
  }
  else
    require("./skeleton/welcome.php");
}
?>
<script>
  if(urlParams.get('upload') != null){
    hideElem('right');
    hideElem('footer');
    showElem('upload-block');
  }

  function hideElem(id){
    document.getElementById(id).style.display = 'none';
  }
  function showElem(id){
    document.getElementById(id).style.display = 'block';
  }

  function addStaticTag(tag){
    document.getElementById('search-value').value 
    = document.getElementById('search-value').value.replace(input_spliter[input_spliter.length - 1], tag + " ");
    document.getElementById('search-value').focus();
  }

  function addTag(tag){
    if(document.getElementById('search-value').value.indexOf(tag) < 0){
      document.getElementById('search-value').value += " " + tag;
      document.getElementById('search-value').value 
      = document.getElementById('search-value').value.trim();
    }
  }
  function removeTag(tag){
    document.getElementById('search-value').value 
    = document.getElementById('search-value').value.replace(tag, "").trim();

  }

  function showMessage(header, text){
    hideElem("showMessage");

    document.getElementById("showMessage-header").innerHTML = header;
    document.getElementById("showMessage-text").innerHTML = text;
    
    showElem('showMessage');
  }

</script>
</body>
</html>

<?php 
mysqli_close($connect);
?>