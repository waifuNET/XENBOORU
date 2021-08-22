    <li class="list-group-item tags-panel-flout">
    	<div class="tags-panel">
            <?php
            $value = Ecronirovanie($value);
            ?>
    		<a class="tag-fn noselect" onclick="addTag('<?php echo $value; ?>');">+</a>
    		<a class="tag-fn noselect" onclick="removeTag('<?php echo $value; ?>');">-</a>
    		<div class="justify-content-between align-items-center d-flex tag-panel-tag">
    			<a class="a-stl" style="font-size: small;" href="index.php?&tag=<?php echo $value; ?>&page=0"><?php echo $value; ?></a>
    			<span class="badge badge-primary badge-pill"><?php echo $count; ?></span>
    		</div>
    	</div>
    </li>