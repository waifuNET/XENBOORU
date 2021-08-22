<div class="login-panel">
<?php
if($_GET['result'] == '1'){
	?>
	<h3 style="color: green;">Successfully</h3>
	<?php
}else if($_GET['result'] == '0'){
?>
<h3 style="color: red;">Authorisation error</h3>
<?php
}
?> 
<form action="./php/log-in.php" method="post">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">login</span>
  </div>
  <input type="text" name="username" required class="form-control" maxlength="16" aria-describedby="basic-addon1">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">password</span>
  </div>
  <input type="password" name="userpassword" required class="form-control" maxlength="16" aria-describedby="basic-addon1">
</div>
<button type="submit" class="btn btn-light" style="position: static; width: 100%;">login</button>
</div>
</form>