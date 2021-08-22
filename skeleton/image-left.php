
<?php
$tags_sort = array();

$stmt = $connect->prepare("SELECT `tags` FROM `allimage` WHERE `id` LIKE ?");
$stmt->bind_Param('s', $view);
$stmt->execute();
$query = $stmt->get_result();

$result = mysqli_fetch_assoc($query);
$tags = explode(" ",$result['tags']);
foreach ($tags as $tag) {
  $stmt = $connect->prepare("SELECT `count` FROM `total_tags` WHERE `count` > 0 AND `tag` LIKE ? ORDER BY `total_tags`.`count` DESC LIMIT 0, 40");
  $stmt->bind_Param('s', $tag);
  $stmt->execute();
  $result_count = $stmt->get_result();

  $count = $result_count->fetch_row();
  $tags_sort[$tag] = $count[0];
}

arsort($tags_sort);

?>
<div>
  <ul class="list-group">
    <?php 
    if($row['artist'] != ""){
      $artists = explode(" ", $row['artist']);

      $first = 1;
      foreach ($artists as $artist) {
        if(strlen($artist) > 1){
          $value = mysqli_real_escape_string($connect, $artist);
          $stmt = $connect->prepare("SELECT COUNT(*) FROM `allimage` WHERE `artist` LIKE ?");
          $partist = '%' . $artist . '%';
          $stmt->bind_Param('s', $partist);
          $stmt->execute();
          $result_count = $stmt->get_result();

          $count = $result_count->fetch_row()[0];

          include './skeleton/mini/artist.php';
          $first = 0;
        }
      }

    }
    ?>

    <?php 
    if($row['name_character'] != ""){
      $artists = explode(" ", $row['name_character']);
      
      $first = 1;
      foreach ($artists as $artist) {
        $value = $artist;
        if(strlen($value) > 1){
          $value = mysqli_real_escape_string($connect, $value);
          $stmt = $connect->prepare("SELECT COUNT(*) FROM `allimage` WHERE `tags` LIKE ?");
          $artist = '%' . $artist . '%';
          $stmt->bind_Param('s', $artist);
          $stmt->execute();
          $result_count = $stmt->get_result();

          $count = $result_count->fetch_row()[0];

          include './skeleton/mini/character.php';
          $first = 0;
        }
      }

    }
    ?>

    <?php 
    if($row['copyright'] != ""){
      $artists = explode(" ", $row['copyright']);
      
      $first = 1;
      foreach ($artists as $artist) {
        $value = $artist;
        if(strlen($value) > 1){
          $value = mysqli_real_escape_string($connect, $value);
          $stmt = $connect->prepare("SELECT COUNT(*) FROM `allimage` WHERE `copyright` LIKE ?");
          $artist = '%' . $artist . '%';
          $stmt->bind_Param('s', $artist);
          $stmt->execute();
          $result_count = $stmt->get_result();

          $count = $result_count->fetch_row()[0];

          include './skeleton/mini/copyright.php';
          $first = 0;
        }
      }

    }
    ?>

    <div style="margin-top: 10px;"></div>
    <?php
    foreach ($tags_sort as $value => $count) {
      if(strlen($value) > 1){
        include './static/tags-skeleton.php';
      }
    }
    ?>

    <div style="margin-top: 10px;"></div>
    <a style="color: #007bff;overflow-wrap: anywhere; color: #000000;font-weight: bold;">Statistics</a>

    <?php
    list($width, $height, $type, $attr) = getimagesize($row['image']);
    ?>
    <a class="image-left-stat-small">Id: <?php echo $row['id']; ?></a>

    <a class="image-left-stat-small">Posted: <?php echo $row['date']; ?></a>

    <?php if($row_id['id'] != ""){ ?>
      <p style="margin: 0px;" class="image-left-stat-small">Uploader:
        <a class="image-left-stat-small" href="./index.php?user=<?php echo $row_id['id']; ?>"><?php echo Ecronirovanie($row['after']); ?></a>
      </p>
    <?php }?>

    <a class="image-left-stat-small">Size: <?php echo $width . "x" . $height; ?></a>

  </ul>
  <div style="margin-top: 10px;"></div>
</div>