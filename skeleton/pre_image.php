<a href='./index.php?view=<?php echo $content['id'];?>'>
	<?php
		$path_parts = pathinfo($content['image']);
		$img = str_replace("full", "low", $content['image']);
	?>
	<img class="lazyImg pre_image" height="200" width="200" data-original="<?php echo $img;?>" />
</a>