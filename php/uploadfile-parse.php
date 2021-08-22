<?php
require("./db.php");
require("./session.php");

require("./php_functions.php");
try{
    $tags = htmlspecialchars(htmlspecialchars_decode(trim($_POST['tags'])));
    $artist = htmlspecialchars(htmlspecialchars_decode($_POST['artist']));
    $character = htmlspecialchars(htmlspecialchars_decode($_POST['character']));
    $copyright = htmlspecialchars(htmlspecialchars_decode($_POST['copyright']));
    $original = htmlspecialchars(htmlspecialchars_decode($_POST['original']));
    $url = htmlspecialchars(htmlspecialchars_decode($_POST['parse_file_url']));
    $date = date("Y-m-d H:i:s");

    $db_path = "null";
    $login_inst = "anonymous";

    if($_POST['upd'] != ""){
        $login_inst = $_POST['upd'];
    }

    $stmt = $connect->prepare("INSERT INTO `allimage`(`id`, `image`, `tags`, `after`, `artist`, `name_character`, `copyright`, `original`, `parse_image_url`, `date`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_Param('sssssssss', $db_path, $tags, $login_inst, $artist, $character, $copyright, $original, $url, $date);
    $stmt->execute();

    mysqli_close($connect);
    echo "Success";
}catch(Exception $e){
    echo "Error: $e"; 
}