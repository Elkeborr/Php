
<?php include_once 'bootstrap.php';

$profileImg = new User();

?>


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
<?php include_once("nav.inc.php"); ?>
  <!------------------------PROFIELFOTO--------------------------->

<div class="container">
  <h3>Profielfoto</h3>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

//$profileImg = new profileImg();

//$statement = $conn->prepare("SELECT * FROM profile_images where id = $id");
//$statement->execute();
//$collection = $statement->fetchAll();

//$image = ProfileImg::getAll();
 
//if(!empty($posts)){
  //$show = true;
//}else{
 // $error = true;
//}

?>

<div class="collection">
 
    <?php foreach($profileImg as $p): ?>
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

<form method="post" action="">  
<textarea name="tekst" rows="5" cols="40" placeholder="Schrijf hier iets over jezelf!"></textarea>
<br><br>
<input type="submit" name="submit" value="Submit">  
</form>

<?php 

$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
$statement = $conn->prepare("SELECT * FROM users where bio");
$statement->execute();
$collection = $statement->fetchAll();

if(isset($_POST['submit'])){

  $tekst=$_POST['tekst'];

  if(empty($tekst)){
    echo "<font color='red'>Tekstveld is leeg!</font><br/>";

  }
  else{
    $sql = "INSERT INTO users(bio) VALUES(:bio)";

    $query = $conn->prepare($sql);

    $query->bindparam(':bio', $tekst);
    $query->execute();

    echo $tekst;
  }
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





  
 
 
