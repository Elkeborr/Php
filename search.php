<?php
//session_start();

  //Connectie klasses
include_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();

 // $profileImg = Post::profilePic();
  $searchResult = Post::search($_GET['search']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">

    <title>SEARCH</title>
</head>
<body>


<?php include_once 'nav.inc.php'; 
//echo "<img src='" . $value['image'] . "'>";
?>


<!-------AFBEELDINGEN SHOWEN------->

<?php $dbconn = Db::getInstance();?>

<div class="collection">
<?php if($searchResult>0): foreach($searchResult as $value):?>

    <div class="collection__item">
    <a href="detail.php?id=<?php echo $value['id']; ?>" > <img class="collection--image" src="<?php echo $value['image']; ?>" alt="Post"></a>
    <div class='item--container'>
        <p><?php echo $value['image_text']; ?></p>
      </div>
  </div>
<?php endforeach; ?> 
</div>
<?php endif; ?>


</div>
</div>

</body>
</html>

