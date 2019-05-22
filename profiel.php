
<?php

require_once 'bootstrap.php';
//$profileImg = User::profileImg($_GET['id']);
$bio = User::bio();
$posts = Post::getOwnPosts();
User::updateBio();

//Post::deleteEdit();

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
<?php include_once 'includes/head.inc.php'; ?>
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
<h3>About me</h3>

<p><?php echo $bio; ?> </p>
    
    <form method="post" action="">  
      <textarea name="bio" rows="5" cols="40" placeholder="Write something nice! (or not)" required><?php echo $bio; ?></textarea>
      <br><br>
        <input type="submit" name="submit" value="Submit">  
    </form>
  </div>  
  <!------------------------PASSWOORD EN EMAIL WIJZIGEN--------------------------->

  <div class="wijzigen">
  <h3> Settings </h3>


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
        
      
      </div>
      <!--<button>Delete</button>
      <button>Edit</button>-->

      <form enctype="multipart/form-data" action="" method="POST"> 
        <input type="submit" value="delete" name="delete" /><br>
        <input type="submit" value="edit" name="edit"/>  
      </form> 
  </div>
<?php endforeach; ?> 

</div>

    
</body>
</html>





  
 
 
