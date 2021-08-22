<div class="login-panel">
<?php
if($_GET['result'] == '1'){
	?>
	<h3 style="color: green;">Successfully</h3>
	<?php
}else if($_GET['result'] == '0'){
?>
<h3 style="color: red;">Registration error</h3>
<?php
}else if($_GET['result'] == '2'){
?>
<h3 style="color: red;">email or login busy</h3>
<?php } ?>
<form action="./php/register.php" method="post">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">login</span>
  </div>
  <input type="text" name="username" required class="form-control" minlength="4" maxlength="16" aria-describedby="basic-addon1">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">password</span>
  </div>
  <input type="text" name="userpassword" required class="form-control" minlength="4" maxlength="16" aria-describedby="basic-addon1">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">email</span>
  </div>
  <input type="text" name="useremail" required class="form-control" minlength="4" maxlength="255" aria-describedby="basic-addon1">
</div>
<button type="submit" class="btn btn-light" style="position: static; width: 100%;">registration</button>
</div>
</form>