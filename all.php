
<?php
require_once 'bootstrap.php';

$allPosts = Post::getAll();

?>
<!DOCTYPE html>
<html lang="en" class="profiel">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>All</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="collection">
<?php foreach ($allPosts as $p): ?>
  <div class="collection__item">
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image  <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
        <div class="profile--small ">
         <a href="user.profiel.php?id=<?php echo $p['user_id']; ?>" > <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> </a>
        </div>
        <p><?php echo $p['image_text']; ?></p>
        <p id="date"><?php echo  $p['date']; ?></p>
        <button>Like</button>   
      </div>
  </div>
<?php endforeach; ?> 
</div>

    
</body>
</html>