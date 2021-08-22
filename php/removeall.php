<!DOCTYPE html>
<html>
<head>
	<title>admin remover</title>

	<script src="../js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
	<script src="../js/popper.min-1.16.0.js" type="text/javascript"></script>
	<script src="../js/bootstrap.min-4.5.0.js" type="text/javascript"></script>

	<script src="../js/jquery.min-1.8.3.js" type="text/javascript"></script>
	<script src="../js/jquery.lazyload.min.js" type="text/javascript"></script>
</head>
<body>

</body>
</html>

<?php
function generateRandomString($length = 12) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
$code = generateRandomString(4);
echo "Will this action completely clear all content on the site? Are you sure? <br>";
echo $code . " ";
?>
<input type="text" id="code" name="">
<button onclick="checkCode('<?php echo $code;?>');">delete</button>
<br>
<div id="result"></div>
<script>
	function checkCode(code){
		if(document.getElementById("code").value == code){
			del();
		}
	}

	function del(otv){
		$( document ).ready(function() {
			$.ajax({
				type: "POST",
				data: {

				},
				url: './ajax/aj_delete.php',
				success: function(data) {
					$('#result').html(data);
				}
			});
		});
	}
</script>