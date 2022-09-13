<?php
require 'db.php';
$data = $_POST;
$showError = False;

if(isset($data['signin'])){
  $error = array();
  $showError = True;

  if(trim($data["login"]) == ""){
    $error[] = "Enter login";
  }
  if(trim($data["password"]) == ""){
    $error[] = "Enter password";
  }

  $user = R::findOne('users', 'login = ?', array($data['login']));

  if($user){
    if(password_verify($data['password'], $user->password)){
      $_SESSION['user'] = $user;
    }else{
      $error[] = 'Error password';
    }
}else{
      $error[] = 'Error login';
    }
}
?>
<?php if(isset($_SESSION['user'])) : ?>
    <meta http-equiv='refresh' content="0; URL='/user'" />
<?php else : ?>
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
<form action="/admin.php" method="POST" class='signup_form'>
   <input type="text" name="login" placeholder="Login"><br> 
   <input type="password" name="password" placeholder="Password"><br> 
   <button type="submit" name="signin" class='signup_button'>Sign In</button>
</form>
<p><?php if($showError){ echo showError($error); }  ?></p>
</div>
  </body>
</html>
<?php endif; ?>