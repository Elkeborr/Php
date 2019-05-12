<?php
//session_start();

  //Connectie klasses
include_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();

  $profileImg = Post::profilePic();
  $searchResult = post::search($_GET['search']);
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

<?php include_once 'nav.inc.php'; ?>


<!-------AFBEELDINGEN SHOWEN------->

<?php $dbconn = Db::getInstance();

if($searchResult>0){
  foreach($searchResult as $value){
    echo $value['id'];
    echo $value['image'];
    echo $value['image_text'];
  }
}
else{
  echo 'No data found';
}


?>
    
</body>
</html>