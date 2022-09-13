<?php
require 'db.php';
$data = $_POST;
if($_GET['id'] == ''){
  header('Location: /user?id='.$_SESSION['user']->id);
}
if($_GET['id'] == $_SESSION['user']->id){
  $position = 'access';
}
else{
  $position = 'view';
}
$user = R::findOne('users', 'id = ?', array($_GET['id']));

if(isset($data['send_post'])){
  $post = $data['post'];
  $post_name = $data['post_name'];
  $img1 = $data['img1'];
  $img2 = $data['img2'];
  $img3 = $data['img3'];
  $team = $data['team'];
  $mentor = $data['mentor'];
  if ($post) {
    $db_post = R::dispense('posts');
    $db_post->id_user = $_SESSION['user']->id;
    $db_post->post = $post;
    $db_post->img1 = $img1;
    $db_post->img2 = $img2;
    $db_post->img3 = $img3;
    $db_post->team = $team;
    $db_post->mentor = $mentor;
    $db_post->post_title = $post_name;
    $db_post->ip = $_SERVER['REMOTE_ADDR'];
    $db_post->d_date_post = date('d');
    $db_post->m_date_post = date('m');
    $db_post->y_date_post = date('Y');
    $db_post->h_time_post = date('H');
    $db_post->m_time_post = date('i');
    R::store($db_post);
  }
}
$all_post = R::findAll('posts');
$user_posts = array();

foreach ($all_post as $row) {
  if ($row['id_user'] == $_GET['id']) {
    $user_posts[] = $row;
  }
}
/* $db = mysqli_connect('localhost', 'root', '', 'ykp')
    or die('Error connecting to MySQL server.');

if (isset($data['delete_post'])){
  $del_post = $data['post_name'];
  $query = 'DELETE FROM posts WHERE 'post_title = $del_post'';
  mysqli_query($db, $query) or die('Error');
  mysqli_close($db);
}*/

?>


<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <link rel="icon" href="./Avatars/K.jpg" type="image/x-icon">
  <title><?php echo $user->name; ?></title>
  </head>
  <body>
  <link rel="stylesheet" type='text/css' href="./CSS/user.css">
<?php if($position == 'view'):  ?>
  <?php require 'nav.php'; ?>
<?php else: ?>
    <div class='nav' align='right'>
   <a href="./Index.php"><h2 class="logo-text">Project Kvantik</h2></a>
    <div class="list_button">
      <a href="/user"><button>Profile</button></a>
      <a href="/logout"><button>Log out</button></a>
    </div>
  </div>
<?php endif; ?>
  <div class="content_block" align="center">
    <div class="block_profile">
      <div class="user_info" align="left">
        <img src="./<?php echo $user->avatar;?>" class="avatar">
        <p class="user_name"><?php echo $user->name;?></p>
        <div class="status">
        <p><?php echo $user->status;?></p>
        <br>
        <br>
        </div>
      <div class="blog_list">
        <?php if($position == 'view'):  ?>
          <div class="margin"></div>
        <?php else:  ?>
      <div class="post">
        <div class="post_input">
          <form style="text-align: left" action="/user?id=<?php echo $_GET['id'];?>" method='POST'>
            <input type="text" name="post_name" placeholder="Post title..." class="post_name">
            <input type="text" name="img1" placeholder="Img 1" class="post_name">
            <input type="text" name="img2" placeholder="Img 2" class="post_name">
            <input type="text" name="img3" placeholder="Img 3" class="post_name">
            <input type="text" name="team" placeholder="Team" class="post_name">
            <input type="text" name="mentor" placeholder="Mentor" class="post_name">
            <input type="text" name="post" placeholder="Your text..." class="post_enter">
            <button type='submit' name="send_post">Send</button>
          </form>
        </div>
      </div>

      <!-- <div class="delete_post">
          <p>Delete post...</p>
          <form style="text-align: left" action="/user?id=<?php echo $_GET['id'];?>" method='POST'>
            <input type="text" name="post_name" placeholder="Post title..." class="post_name_del">
            <button type="submit" name="delete_post" class="post_input">Delete post</button>
          </form>
      </div>  -->
      <?php endif;  ?>
        <div class="array_notes">

        <?php for ($i = 0; $i < count($user_posts); $i++): ?>
            <div class="public_post">
              <br>
            <?php if ($user_posts[count($user_posts) - $i - 1]['img1']): ?>
              <img src="./<?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['img1']); ?>">
            <?php endif; ?>
            <?php if ($user_posts[count($user_posts) - $i - 1]['img2']): ?>
              <img src="./<?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['img2']); ?>">
            <?php endif; ?>
            <?php if ($user_posts[count($user_posts) - $i - 1]['img3']): ?>
              <img src="./<?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['img3']); ?>">
            <?php endif; ?>
            <h2 class="post_text"><?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['post_title']); ?></h2>
            <h3 class="post_text">Команда: <?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['team']); ?></h3>
            <h3 class="post_text">Наставник(и): <?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['mentor']); ?></h3>
            <p class="post_text"><?php echo htmlspecialchars($user_posts[count($user_posts) - $i - 1]['post']); ?></p>
          </div>
          <br>
        <?php endfor; ?>
        </div>
      </div>

      </div>
    </div>
  </div>
  </body>
</html>