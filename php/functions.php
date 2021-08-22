<?php
function changeTagCount($connect, $viewid, $tags){
	$stmt = $connect->prepare("SELECT `tags` FROM `allimage` WHERE `id` LIKE ?");
	$stmt->bind_Param('i', $viewid);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = mysqli_fetch_assoc($result);

	$tags_old = explode(" ", trim($row['tags']));
	$tags_new = explode(" ", trim($tags));

	foreach ($tags_new as $new) { // add new tag
		if (!in_array($new, $tags_old)) {
			if($new != ""){
				$stmt = $connect->prepare("SELECT COUNT(*) FROM `total_tags` WHERE `tag` LIKE ?");
				$stmt->bind_Param('s', $new);
				$stmt->execute();
				$result_count = $stmt->get_result();
				$count_all = $result_count->fetch_row()[0];
				if($count_all == 0){
					$stmt = $connect->prepare("INSERT INTO `total_tags`(`id`, `tag`, `count`) VALUES (NULL, ?, '1')");
					$stmt->bind_Param('s', $new);
					$stmt->execute();
				}
				else{
					$stmt = $connect->prepare("SELECT `count` FROM `total_tags` WHERE `tag` LIKE ?");
					$stmt->bind_Param('s', $new);
					$stmt->execute();
					$result_count = $stmt->get_result();
					$count_all = mysqli_fetch_assoc($result_count);

					$stmt = $connect->prepare("UPDATE `total_tags` SET `count`= ? WHERE `tag` LIKE ?");
					$new_count = intval($count_all['count']) + 1;
					$stmt->bind_Param('is', $new_count, $new);
					$stmt->execute();
				}
			}
		}
	}

	foreach ($tags_old as $old) { // 
		if (!in_array($old, $tags_new)) {
			if($old != ""){
				$stmt = $connect->prepare("SELECT COUNT(*) FROM `total_tags` WHERE `tag` LIKE ?");
				$stmt->bind_Param('s', $old);
				$stmt->execute();
				$result_count = $stmt->get_result();
				$count_all = $result_count->fetch_row()[0];
				if($count_all == 0){
					$stmt = $connect->prepare("INSERT INTO `total_tags`(`id`, `tag`, `count`) VALUES (NULL, ?, '0')");
					$stmt->bind_Param('s', $old);
					$stmt->execute();
				}
				else{
					$stmt = $connect->prepare("SELECT `count` FROM `total_tags` WHERE `tag` LIKE ?");
					$stmt->bind_Param('s', $old);
					$stmt->execute();
					$result_count = $stmt->get_result();
					$count_all = mysqli_fetch_assoc($result_count);

					$stmt = $connect->prepare("UPDATE `total_tags` SET `count`= ? WHERE `tag` LIKE ?");
					$new_count = intval($count_all['count']) - 1;
					$stmt->bind_Param('is', $new_count, $old);
					$stmt->execute();
				}
			}
		}
	}
}
?>