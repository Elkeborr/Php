
<?php

require_once 'bootstrap.php';
//$profileImg = User::profileImg($_GET['id']);
$bio = User::bio();
$posts = Post::getOwnPosts();
User::updateBio();


$filters = Post::getFilters();

if (!empty($posts)) {
    $show = true;
} else {
    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en" class="profiel">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/filters.css">
	<link rel="stylesheet" href="css/profiel.css">
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

  <!------------------------PROFIELFOTO--------------------------->
<div class="profile--container">

<div class="info">
  <div class="profile">
        <img class="profile--image" src="<?php echo $profileImg; ?>" alt="ProfileImg"></a>
  </div>
  <div class="profileImage">
    <form enctype="multipart/form-data" action="uploadProfilePic.php" method="POST"> 
      <input type="file" name="profileImg" capture="camera" required/><br>
      <input type="submit" value="upload" name="upload"/>  
    </form>      
  </div>  
</div>
  <!------------------------PROFIELTEKST--------------------------->
  <div class="biografie">
<h3>Biography</h3>

<p><?php echo $bio; ?> </p>
    
    <form method="post" action="">  
      <textarea name="bio" rows="5" cols="40" placeholder="Write something about yourself..." required><?php echo $bio; ?></textarea>
      <br><br>
        <input type="submit" name="submit" value="Submit">  
    </form>
  </div>  
  <!------------------------PASSWOORD EN EMAIL WIJZIGEN--------------------------->

  <div class="wijzigen">
  <h3> Change info </h3>


<a href="changePassword.php">Change password</a>
<br>
<a href="changeEmail.php">Change email</a>

  </div>


<!-----------------------POSTS----------------------->
</div>
<div class="post--container">

  <?php foreach ($posts as $p): ?>
  <div class="collection__item">
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
        <div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> 
        </div>
        <p><?php echo $p['image_text']; ?></p>
        <p id="date"><?php echo Post::getTimeAgo(strtotime(date($p['date']))); ?></p>
        <button>Delete</button>
      
      </div>
  </div>
<?php endforeach; ?> 

</div>

    
</body>
</html>





  
 
 
