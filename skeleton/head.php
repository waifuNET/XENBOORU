    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./index.css">
    
    <meta name="description" content="<?php echo $_WEBSITE_NAME ;?> - free anime and hentai gallery!" />
    <meta name="keywords" content="<?php echo $_WEBSITE_NAME ;?>, rule 34, chan list, imageboard nude, imageboard list, аниме картинки, картинки, 3d, 2д девочки, tyans, 3d, куда вылажить свои работы, для авторов, поделиться изображением, anime, doujinshi, hentai, porn, sex, japanese hentai, anime hentai, imageboard" />

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min-4.5.0.css">

    <script src="./js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
    <script src="./js/popper.min-1.16.0.js" type="text/javascript"></script>
    <script src="./js/bootstrap.min-4.5.0.js" type="text/javascript"></script>

    <script src="./js/jquery.min-1.8.3.js" type="text/javascript"></script>
    <script src="./js/jquery.lazyload.min.js" type="text/javascript"></script>

    <script src="https://www.google.com/recaptcha/api.js?render=6Lc1eRkcAAAAALnAcT6rv6xBkLrkvDSPe6QgeDTK"></script>

    <?php
    if(!$local){
      ?>
      <!-- Yandex.Metrika counter -->
      <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
         m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(74580592, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
      });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/74580592" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <?php
  }
  ?>

  <div id="showMessage" style="z-index: 100; display: none; width: 100%; height: 100%; position: absolute; top: 0px;">
    <dir style="width: 100%; height: 100%; background-color: black; position: absolute; top: 0px; opacity: 0.5; margin: 0px;"></dir>
    <div class="container">
      <div class="showMessage-postion">
        <div class="callout">
          <div id="showMessage-header" class="callout-header">%ERROR%</div>
          <span class="closebtn" onclick="hideElem('showMessage');">×</span>
          <div id="showMessage-text" class="callout-container">
            <p>%ERROR_MESSAGE%</p>
          </div>
        </div>
      </div>
    </div>
  </div>

