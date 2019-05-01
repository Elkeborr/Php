
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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<textarea name="Tekst" rows="5" cols="40"><?php echo $tekst;?></textarea>
<br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

  <!------------------------PASSWORD--------------------------->
  <h3> Gegevens wijzigen </h3>



<br>

<form method="POST" action="profiel.php">
   Old password: <input type="password" name="oldpassword"><br/>
   New password: <input type="password" name="newpassword"><br/>
   <input type="submit" value="submit" name="submit">
</form>



<?php
  
  if(!empty($_POST)){
		// email en password opvragen
		$oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];

		//hash opvragen, op basis van email
		$conn = new PDO("mysql:host=localhost;dbname=project_php;", "root", "root", null);
		

		// check of rehash van password gelijk is aan hash uit db
		$statement = $conn->prepare("SELECT * FROM users WHERE password='".$newpassword."'");
		$result = $statement->execute();

		$user = $statement -> fetch(PDO::FETCH_ASSOC);

		if( password_verify($newpassword, $user['password'])){
			$error = true;


		}else{
      session_start();
			$_SESSION['password'] = $newpassword;
			header('Location:profiel.php');

		}}


?>

  <!------------------------PASSWORD--------------------------->

  <br>
  <br>
  
  <form method="POST" action="profiel.php" enctype="multipart/form-data">
<table>
<tr>
<td>Old email:</td>
<td><input type="text" name="oldemail"/></td>
</tr>
<tr>
<td>New email</td>
<td><input type="text" name="newemail"/></td>
</tr>
<tr>
<td>Change email</td>
<td><input type="submit" name="submit"/></td>
</tr>
</table>
</form>

<?php

if ($_POST['submit'])
{

$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];

}

?>



    
</body>
</html>





  
 
 
