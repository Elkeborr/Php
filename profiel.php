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


<form method="post" enctype="multipart/form-data">
<table>
<tr>
<td>name:</td>
<td><input type="text" name="name" value="<?php echo $name ?>"/></td>
</tr>
<tr>
<td>email</td>
<td><input type="text" name="email" value="<?php echo $email ?>"/></td>
</tr>

<tr>
<td>image</td>
<td><input type="file" name="image" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="submit" /></td>
</tr>
</table>



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





  
 
 
