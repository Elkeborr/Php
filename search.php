<?php
//session_start();

  //Connectie klasses
include_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt

  $searchResult = Post::search(strtolower($_GET['search']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Zoek</title>
</head>
<body>

<?php include_once 'includes/nav.inc.php'; ?>

<div class="container--search">
<h3><?php echo  $_GET['search']; ?></h3>

<!-------AFBEELDINGEN SHOWEN------->

<?php $dbconn = Db::getInstance(); ?>

<div class="collection--search">
<?php if ($searchResult > 0): foreach ($searchResult as $value):?>

  <div class="collection__item">
      <a href="detail.php?id=<?php echo $value['id']; ?>" > <img class="collection--image  <?php echo $value['name']; ?>" src="<?php echo $value['image']; ?>" alt="Post"></a>

      <div class='item--container'>
        <div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $value['profileImg']; ?>"> 
        </div>
        <p><?php echo $value['image_text']; ?></p>
        <p id="date"><?php echo $value['date']; ?></p>
        <button>Like</button>   
      </div>
  </div>
<?php endforeach; ?> 
</div>
<?php endif; ?>





</div>
</div>

</div>

</body>
</html>

