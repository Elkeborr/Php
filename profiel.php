<?php
$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
  $statement = $conn->prepare("SELECT* FROM images_with_fields");
  $statement->execute();
  $collection = $statement->fetchAll();

  ?>

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


  <!------------------------PROFIELFOTO--------------------------->

  <h3>Profielfoto</h3>

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




    
</body>
</html>





  
 
 
