
<?php include_once("nav.inc.php"); ?>


<!DOCTYPE html>
<html lang="en" class="profiel">
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
  </div>
    <?php endforeach; ?> 
</div>


<div class="profileImage">

<form enctype="multipart/form-data" action="uploadProfilePic.php" method="POST"> 
  <input type="file" name="image" capture="camera" required/><br>
  <input type="submit" value="upload" name="upload"/>  
</form>      
</div>

  

  <!------------------------PROFIELTEKST--------------------------->
<h3>Biografie</h3>

<?php
$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
$statement = $conn->prepare("SELECT * FROM profile_images where image_text");
$statement->execute();
$collection = $statement->fetchAll();

?>
<?php
$tekst=@$_POST['tekst'];
?>
<form method="post" action="">  
<textarea name="tekst" rows="5" cols="40" placeholder="Schrijf hier iets over jezelf!"><?php echo $tekst;?></textarea>
<br><br>
  <input type="submit" name="submit" value="Submit">  

</form>









  <!------------------------PASSWOORD EN EMAIL WIJZIGEN--------------------------->
  <h3> Gegevens wijzigen </h3>

<ul>
<li><a href="changePassword.php">Verander wachtwoord</a></li>
<li><a href="changeEmail.php">Verander email</a></li>
</ul>




    
</body>
</html>





  
 
 
