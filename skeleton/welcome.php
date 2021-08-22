<dir style="display: flex; height: 85%;">
    <div class="welcome">
        <div class="center">
            <?php
            $result_count= mysqli_query($connect, "SELECT COUNT(*) FROM `allimage`");
            $count = $result_count->fetch_row();
            $count_str = strrev(strval($count[0]));
            $top = 0;
            for($i = strlen(strval($count[0])) - 1; $i >= 0; $i--){
                $top += 80;
                if($count_str[$i] == 0){
                    echo '<img src="./websrc/tyans/tyan_0.gif" class="welcome-image">';
                }
                if($count_str[$i] == 1){
                    echo '<img src="./websrc/tyans/tyan_1.gif" class="welcome-image">';
                }
                if($count_str[$i] == 2){
                    echo '<img src="./websrc/tyans/tyan_2.gif" class="welcome-image">';
                }
                if($count_str[$i] == 3){
                    echo '<img src="./websrc/tyans/tyan_3.gif" class="welcome-image">';
                }
                if($count_str[$i] == 4){
                    echo '<img src="./websrc/tyans/tyan_4.gif" class="welcome-image">';
                }
                if($count_str[$i] == 5){
                    echo '<img src="./websrc/tyans/tyan_5.gif" class="welcome-image">';
                }
                if($count_str[$i] == 6){
                    echo '<img src="./websrc/tyans/tyan_6.gif" class="welcome-image">';
                }
                if($count_str[$i] == 7){
                    echo '<img src="./websrc/tyans/tyan_7.gif" class="welcome-image">';
                }
                if($count_str[$i] == 8){
                    echo '<img src="./websrc/tyans/tyan_8.gif" class="welcome-image">';
                }
                if($count_str[$i] == 9){
                    echo '<img src="./websrc/tyans/tyan_9.gif" class="welcome-image">';
                }

            }
            ?>
        </div>
        <br>

        <div class="center">
            <button type="button" onclick="insertParam('page', '0');" style="margin: auto; width: <?php echo $top;?>px;" class="btn btn-light">See all</button>
        </div>

    </div>
</dir>