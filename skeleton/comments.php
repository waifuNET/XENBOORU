	<div class="comment-block" id="comment-<?php echo $commentsCount; ?>">
		<div class="img-left">
			<?php 
			$avatar = "./users/avatars/default.jpg";
			if($content['auth'] == "1"){
				$login = $content['login'];
				$result_e = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` LIKE '$login'");
				$result_d = mysqli_fetch_assoc($result_e);
				if($result_d != "") {
					$avatar = $result_d['avatar'];
				}
			}
			?>
			<img src="<?php echo $avatar; ?>" alt="Avatar" class="avatar">
		</div>
		<div class="img-right">
			<?php $auth = "";
			if($content['auth'] == "1") {$auth = "✓";}
			?>
			<div style="padding-left: 10px;"><strong><?php echo Ecronirovanie($content['login']); ?></strong> <strong style="color: #007bff;"><?php echo $auth; ?></strong></div>
			<div style="padding-left: 10px;"><?php echo Ecronirovanie($content['text']); ?></div>
			<hr>
		</div>
	</div>