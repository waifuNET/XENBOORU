<?php
$result_count_all = mysqli_query($connect, "SELECT COUNT(*) FROM `allimage`");
$count_all = $result_count_all->fetch_row();

?>
<div>
  <ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <a style="color: #007bff; cursor:pointer;" href="index.php?&page=0">all</a>
      <span class="badge badge-primary badge-pill"><?php echo $count_all[0]; ?></span>
    </li>
    <?php
    $query = mysqli_query($connect, "SELECT * FROM `total_tags` WHERE `count` > 0 ORDER BY `total_tags`.`count` DESC LIMIT 0, 40");

    while($content = mysqli_fetch_array($query)) {
      $value = $content['tag'];
      $count = $content['count'];

      include './static/tags-skeleton.php';

    }
    ?>
  </ul>
</div>