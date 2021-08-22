<?php
require("./db.php");
require("../cfg.php");
require("./session.php");

require("./php_functions.php");

// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");

        $full_path = getPath("../users/avatars/");

        $filename = $_FILES["photo"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = $user_login . "-" . generateRandomString() . "." . $ext;
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)){ 
            ?>
            <script> showMessage("Error", "Please select a valid file format."); </script>
            <?php
            die();
        }

        // Verify file size - 10MB maximum
        $maxsize = $_UPLOAD_IMAGE_SIZE * 1024 * 1024;
        if($filesize > $maxsize){
          ?>
          <script> showMessage("Error", "File size is larger than the allowed limit."); </script>
          <?php
          die();
      }
        // Verify MYME type of the file
      if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
        if(file_exists($full_path . $filename)){
            ?>
            <script> showMessage("Error", <?php echo "Please try uploading the file again." ?>); </script>
            <?php
            die();
        } else{
            move_uploaded_file($_FILES["photo"]["tmp_name"], $full_path . $filename);
            $avatar = $full_path . $filename;

            if(!is_image($avatar)){
                ?>
                <script> showMessage("Error", "The image is broken ;c"); </script>
                <?php
                die();
            }

            $stmt = $connect->prepare("SELECT * FROM `users` WHERE `login` LIKE ?");
            $stmt->bind_Param('s', $user_login);
            $stmt->execute();
            $result = $stmt->get_result();

            $row = mysqli_fetch_assoc($result);
            if(trim(basename($row['avatar']).PHP_EOL) != ("default.jpg")){
                if (file_exists($row['avatar'])) {
                    unlink($row['avatar']);
                }
            }

            $stmt = $connect->prepare("UPDATE `users` SET `avatar`=? WHERE `login` LIKE ?");
            $stmt->bind_Param('ss', $avatar, $user_login);
            $stmt->execute();
            $result = $stmt->get_result();

            //header("Location:../index.php?dpage=personal");
            //echo "Your file was uploaded successfully.";
            ?>
            <script> showMessage("Error", "Your file was uploaded successfully."); </script>
            <?php
        } 
    } else{
        ?>
        <script> showMessage("Error", "Error: There was a problem uploading your file. Please try again."); </script>
        <?php
    }
} else{
    ?>
    <script> showMessage("Error", $_FILES["photo"]["error"]); </script>
    <?php
}
}
