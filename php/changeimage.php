<?php
require("./db.php");
require("./functions.php");

require("./php_functions.php");

$tags = mysqli_real_escape_string($connect, trim(strtolower($_POST['tags'])));
$viewid = mysqli_real_escape_string($connect, $_POST['viewid']);

$artist = mysqli_real_escape_string($connect, $_POST['artist']);
$character = mysqli_real_escape_string($connect, $_POST['character']);
$copyright = mysqli_real_escape_string($connect, $_POST['copyright']);

changeTagCount($connect, $viewid, $tags);

$stmt = $connect->prepare("UPDATE `allimage` SET `tags`=?, `artist`=?, `name_character`=?, `copyright`=? WHERE `id` LIKE ?");
$stmt->bind_Param('ssssi', $tags, $artist, $character, $copyright, $viewid);
$stmt->execute();
$result = $stmt->get_result();

?>

<?php 
mysqli_close($connect);
?>

<script>
	window.location.href = '../index.php?view=<?php echo $viewid; ?>';
</script>
