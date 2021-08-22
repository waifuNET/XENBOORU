    <?php if($first == 1){?>
    	<div style="margin-top: 10px;"></div>
    <?php } ?>
    <?php 
    ?>
    <?php if($first == 1){
    	?>
    	<a style="color: #007bff;overflow-wrap: anywhere; color: #000000;font-weight: bold;">Artist</a>
    	<?php
    }
    ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    	<a style="color: #a00; cursor:pointer;overflow-wrap: anywhere; font-size: small;" href="index.php?&tag=<?php echo Ecronirovanie($value); ?>&page=0">
            <?php echo Ecronirovanie($value); ?>
            </a>
    	<span class="badge badge-primary badge-pill"><?php echo $count; ?></span>
    </li>