<?php 
require 'db.php';
$user = R::findOne('users', 'id = ?', array($_SESSION['user']->id));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <link rel="icon" href="./Avatars/K.jpg" type="image/x-icon">
  <title>PK</title>
  <link rel="stylesheet" type='text/css' href="./CSS/main.css">
  <style>
.nav_button{
    border: none;
    cursor: pointer;
    height: 42px;
    padding-left: 10px;
    padding-right: 10px;
    background-color: #465666;
    color: #ffffff;
    transition: 0.3s;
    margin-right: 30px;
    border-radius: 0px;
    margin-top: 0px;
}
.nav_button: hover{
    background-color: #28313a;
}
  </style>
  </head>
  <body>
  <div class='nav' align='right'>
  <a href="./Index.php"><h2 class="logo-text">Project Kvantik</h2></a>
  <?php if($user) :  ?>
  <a href="./user"><button class="nav_button">Kvantum</button></a>
  <a href="./logout.php"><button class="nav_button">Log Out</button></a>
  <?php else :  ?>
  <?php endif;  ?>
</div>
<h1 style='text-align:center;'>Банк проектов Кванториума</h1>
<h2 style='text-align:center;'>- совокупность проектов Кванториума, которые были успешно защищены.</h2>
<h2 style='text-align:center;'>На данном сайте вы можете увидеть краткую информацию о проектах Кванториума, их внешний вид и авторов этих работ.
<h1 style='text-align:center;'> Выберите квантум: </h1>
<div class="line">
<a href="/user?id=1" style="text-decoration: none;">
    <div class="block ; transition">     
    <img src="./Avatars/IT.png" class="avatar">
    <h2 class="text_in_block">IT-Квантум</h2>
    </div>
</a>
<br>
<a href="/user?id=2" style="text-decoration: none;">
<div class="block ; transition"> 
    <img src="./Avatars/VR.png" class="avatar ; transition">
    <h2 class="text_in_block">VR-Квантум</h2>
</div>
</a>
</div>

<div class="line">
    <a href="/user?id=3" style="text-decoration: none;">
    <div class="block ; transition">     
    <img src="./Avatars/Geo.png" class="avatar">
    <h2 class="text_in_block">Геоквантум</h2>
    </div>
</a>
<br>
<a href="/user?id=4" style="text-decoration: none;">
<div class="block ; transition"> 
    <img src="./Avatars/Hightech.png" class="avatar ; transition">
    <h2 class="text_in_block">Хайтек</h2>
</div>
</a>
</div>

<div class="line">
    <a href="/user?id=5" style="text-decoration: none;">
    <div class="block ; transition">     
    <img src="./Avatars/PD.png" class="avatar">
    <h2 class="text_in_block">Промдизайнквантум</h2>
    </div>
</a>
<br>
<a href="/user?id=6" style="text-decoration: none;">
<div class="block ; transition">      
    <img src="./Avatars/PR.png" class="avatar ; transition">
    <h2 class="text_in_block">Промробоквантум</h2>
</div>
</a>
</div>
  </body>
</html>
