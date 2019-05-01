
<?php include_once("nav.inc.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profiel</title>

  <link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/profiel.css">
</head>
<body>

<?php
   $conn = new PDO("mysql:host=localhost;dbname=project_php;", "root", "root", null);

   $stmt=$conn->prepare('SELECT * FROM users');
   $stmt->execute();
   if($stmt->rowCount()>0){
     while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
       extract($row);
  

     }
   }

   

   ?>



  <!------------------------PROFIELFOTO--------------------------->

<div class="container">
  <h3>Profielfoto</h3>


  <div class="profilePic">

  <form enctype="multipart/form-data" action="uploadProfilePic.php" method="POST"> 
    <input type="file" name="image" capture="camera" required/><br>
    <input type="submit" value="upload" name="upload"/>  
  </form>      
</div>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);

$statement = $conn->prepare("SELECT * FROM profile_images where id = $id");
$statement->execute();
$collection = $statement->fetchAll();

$image = ProfileImg::getAll();
 
if(!empty($posts)){
  $show = true;
}else{
  $error = true;
}

?>

<div class="collection">
 
    <?php foreach($image as $p): ?>
    <div class="collection__item">
        <img class="collection--image"src="<?php echo $p['image']; ?>" alt="ProfileImg"></a>
        <img class="profile__image" scr="images/hero_login.jpg">
  </div>
    <?php endforeach; ?> 
</div>

  

  <!------------------------PROFIELTEKST--------------------------->
<h3>Biografie</h3>

<?php
$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);

$statement = $conn->prepare("SELECT * FROM profile_images where image_text");
$statement->execute();
$collection = $statement->fetchAll();

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<textarea name="Tekst" rows="5" cols="40"><?php echo $tekst;?></textarea>
<br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php


$tekst="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["tekst"])) {
    $tekst = "";
  } else {
    $tekst = test_input($_POST["tekst"]);
  }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  ?>



  <!------------------------PASSWOORD EN EMAIL WIJZIGEN--------------------------->
  <h3> Gegevens wijzigen </h3>

<ul>
<li><a href="changePassword.php">Verander wachtwoord</a></li>
<li><a href="changeEmail.php">Verander email</a></li>
</ul>




    
</body>
</html>





  
 
 
