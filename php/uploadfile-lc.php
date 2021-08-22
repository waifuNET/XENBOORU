<?php
require("./db.php");
require("./session.php");

require("./php_functions.php");

try {
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $full_path = getPath("../src/full/");
        $low_path = getPath("../src/low/");

        $filename = $_FILES["photo"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename_genname = generateRandomString();
        $filename = $filename_genname . "." . $ext;
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format." . $filename);

        // Verify file size - 10MB maximum
        $maxsize = 20 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists($full_path . $filename)){
                echo $filename . " is already exists.";
            } else{
                $login_inst = "anonymous";
                if($user_auth){
                    $login_inst = $user_login;
                }

                if($_POST['upd'] != ""){
                    $login_inst = $_POST['upd'];
                }

                $tags = trim($_POST['tags']);
                move_uploaded_file($_FILES["photo"]["tmp_name"], $full_path . $filename);
                //convert//
                if ($ext == "gif"){
                    $converted_filename = "../src/" . $filename_genname . "_converted-to-jpg.jpg";
                    if ($ext == "gif") $new_pic = imagecreatefromgif($full_path . $filename);

                    if(!$new_pic){
                        die("Error: don't jole with me ;)");
                    }

                    // Create a new true color image with the same size
                    $w = imagesx($new_pic);
                    $h = imagesy($new_pic);
                    $white = imagecreatetruecolor($w, $h);

                    // Fill the new image with white background
                    $bg = imagecolorallocate($white, 255, 255, 255);
                    imagefill($white, 0, 0, $bg);

                    // Copy original transparent image onto the new image
                    imagecopy($white, $new_pic, 0, 0, 0, 0, $w, $h);

                    $new_pic = $white;

                    imagejpeg($new_pic, $converted_filename);
                    compress_image($converted_filename, $low_path . $filename, 80);
                    imagedestroy($new_pic);
                    unlink($converted_filename);
                }
                else
                {
                    compress_image($full_path . $filename, $low_path . $filename, 80);
                }
                //convert//
                $artist = htmlspecialchars(htmlspecialchars_decode($_POST['artist']));
                $character = htmlspecialchars(htmlspecialchars_decode($_POST['character']));
                $copyright = htmlspecialchars(htmlspecialchars_decode($_POST['copyright']));
                $original = htmlspecialchars(htmlspecialchars_decode($_POST['original']));
                $date = date("Y-m-d H:i:s");

                $db_path = $full_path . $filename;
                $stmt = $connect->prepare("INSERT INTO `allimage`(`id`, `image`, `tags`, `after`, `artist`, `name_character`, `copyright`, `original`, `date`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_Param('ssssssss', $db_path, $tags, $login_inst, $artist, $character, $copyright, $original, $date);
                $stmt->execute();

                $tags = explode(" ", $tags);

                foreach ($tags as $value) {
                    $value = trim(strtolower($value));
                    if($value != "" && strlen($value) > 1){

                        $stmt = $connect->prepare("SELECT `count` FROM `total_tags` WHERE `tag` LIKE ?");
                        $stmt->bind_Param('s', $value);
                        $stmt->execute();
                        $result_count = $stmt->get_result();
                        $count_all = intval($result_count->fetch_row()[0]);
                    if($count_all == 0){ //SELECT COUNT(*) FROM `total_tags` WHERE `tag` LIKE '1girl'
                    
                    $stmt = $connect->prepare("SELECT COUNT(*) FROM `total_tags` WHERE `tag` LIKE ?");
                    $stmt->bind_Param('s', $value);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if(intval($result->fetch_row()[0]) == 0){
                        $stmt = $connect->prepare("INSERT INTO `total_tags`(`id`, `tag`, `count`) VALUES (NULL, ?, '1')");
                        $stmt->bind_Param('s', $value);
                        $stmt->execute();
                    }
                    else{
                        $stmt = $connect->prepare("UPDATE `total_tags` SET `count`= ? WHERE `tag` LIKE ?");
                        $new_count = 1;
                        $stmt->bind_Param('is', $new_count, $value);
                        $stmt->execute();
                    }
                }
                else{
                    $stmt = $connect->prepare("UPDATE `total_tags` SET `count`= ? WHERE `tag` LIKE ?");
                    $new_count = $count_all + 1;
                    $stmt->bind_Param('is', $new_count, $value);
                    $stmt->execute();
                }
            }
        }

        mysqli_close($connect);
        echo "Success";
    }
} else{
    echo "Error: There was a problem uploading your file."; 
}
} else{
    echo "Error: " . $_FILES["photo"]["error"];
}
} catch (Exception $e) {
    echo "Error: DON'T"; 
}
?>