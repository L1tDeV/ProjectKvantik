<?php
require 'db.php';
$data = $_POST;
$showError = False;

if(isset($data["signup"])){
  $error = array();
  $showError = True;

  if(trim($data["name"]) == ""){
    $error[] = "Enter name";
  }
  if(trim($data["login"]) == ""){
    $error[] = "Enter login";
  }
  if(trim($data["password"]) == ""){
    $error[] = "Enter password";
  }
  if(trim($data["password_2"]) == ""){
    $error[] = "Confirm password";
  }
  if(R::count("users", "login = ?", array($data["login"])) > 0){
    $error[] = "Данный пользователь уже зарегистрирован";
  }
  if(trim($data["password"]) != trim($data["password_2"])){
    $error[] = "Wrong password";
}

  if(empty($error)){
    $user = R::dispense("users");
    $user->name = $data['name'];
    $user->login = $data['login'];
    $user->avatar = $data['avatar'];
    $user->status = $data['status'];
    $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
    R::store($user);
  }
}

?>
  <!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <link rel="icon" href="./Avatars/K.jpg" type="image/x-icon">
  <title>YKP</title>
  <link rel="stylesheet" type='text/css' href="./CSS/main.css">
  </head>
  <body>

  <div class='nav' align='right'>
  <a href="./Index.php"><h2 class="logo-text">YKP</h2></a>
  </div>
  <br>
<div class="box" align="center">
<form action="/addaccount.php" method="POST" class='signup_form'>
   <input type="text" name="name" placeholder="Name"><br>
   <input type="text" name="login" placeholder="Login"><br> 
   <input type="text" name="avatar" placeholder="Avatars/..."><br> 
   <input type="text" name="status" placeholder="Status"><br>
   <input type="password" name="password" placeholder="Password"><br> 
   <input type="password" name="password_2" placeholder="Confirm password"><br> 
   <button type="submit" name="signup" class='signup_button'>Sign Up</button>
</form>
<p><?php if($showError){ echo showError($error); }  ?></p>
</div>
  </body>
</html>