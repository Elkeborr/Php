<?php
//session_start();

  //Connectie klasses
include_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();
 // $profileImg = Post::profilePic();

  $searchResult = Post::search(strtolower(($_GET['search'])));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/filters.css">
    <link rel="stylesheet" href="css/reset.css">

    <title>Search</title>
</head>
<body>

<?php include_once 'nav.inc.php'; ?>

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

