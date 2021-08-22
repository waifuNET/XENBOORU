<div class="footer" id="footer">
	<?php
	if($pageid > 1)
	{
	?>
		<a class="btn btn-primary" style="color: white;" onclick="insertParam('page', '0');" role="button"><<</a>
	<?php
	}
	if($pageid > 0)
	{
		?>
		<a class="btn btn-primary" style="color: white;" onclick="insertParam('page', '<?php echo $pageid - 1; ?>');" role="button"><</a>
		<?php
	}
	for ($i = 0; $i <= $count / $max_img; $i++) 
	{
		if($i >= $pageid - 4)
{
	if($i <= $pageid + 4)
	{
		if($i != $pageid)
	{
		?>
			<a class="btn btn-primary" style="color: white;" onclick="insertParam('page', '<?php echo $i; ?>');" role="button"><?php echo $i; ?></a>
		<?php
		}
		else
		{
		?>
			<a class="btn btn-secondary btn-lg disabled" style="color: white;" role="button"><?php echo $i; ?></a>
		<?php
		}
	}
}
	}
	if($pageid < $count / $max_img - 1)
	{
		?>
		<a class="btn btn-primary" style="color: white;" onclick="insertParam('page', '<?php echo $pageid + 1; ?>');" role="button">></a>
		<?php
	}

	if($pageid < $count / $max_img - 2)
	{
		?>
		<a class="btn btn-primary" style="color: white;" onclick="insertParam('page', '<?php echo floor($count / $max_img); ?>');" role="button">>></a>
		<?php
	}
	?>
</div>