<?php 
session_start();
if(isset($_GET['login_errors']) && $_GET['login_errors'] === "invalid_username" ){
  echo "<h3 class='text-danger'>Your Username is Invalid, Please check and try again.</h3><hr>";
}

if(isset($_GET['login_errors']) && $_GET['login_errors'] === "incorrect_password" ){
  echo "<h3 class='text-danger'>Your password is Incorrect, Please check and try again.</h3><hr>";
}

//var_export($_SESSION);

?>

<form action="<?php echo wp_login_url();?>" method="POST" class='col-md-8'>
<h3> Provide Your Username and Password To Login </h3>

<div class="form-group">
  <label for="username">Username</label>
  <input type="text" name="log" id="username" class="form-control" placeholder="" >
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="pwd" id="password" class="form-control" placeholder="" >
</div>

<div class="form-group">
  <input type="submit" name="submited" id="submit_login" class="form-control" value="Login" >
</div>

