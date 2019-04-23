<?php 
  $conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
  $statement = $conn->prepare("SELECT* FROM images_with_fields");
  $statement->execute();
  $collection = $statement->fetchAll();

/*Op deze manier gaat de website starten 
met login enkel als er een sessie gestart is 
dan zal de index tevoorschijn komen
*/
session_start();
if(isset($_SESSION ['email'])){

}else {
  header ("Location: login.php");
}

include_once("data.inc.php"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Homepage</title>
</head>
<body>

<h1>PLANTSPIRATIE</h1>

<a href="profiel.php">Profiel</a>
<a href="login.php">login</a>
<a href="register.php">Registreer</a>

<form enctype="multipart/form-data" action="upload.php" method="POST" class="form"> 
    <input type="file" name="image" capture="camera" required><br>
    <br><textarea name="description" cols="40" rows="4" placeholder="Description" required></textarea><br>
    <input type="submit" value="upload" name="upload" class="input">  
</form>      
  
<div class="collection">
    <?php foreach($collection as $c): ?>
        <a href="detail.php?id=<?php echo $c['id']; ?>" class="collection__item" style="background-image:url(<?php echo $c['image']; ?>)"></a>
    <?php endforeach; ?>
</div>
    
</body>
</html>