<?php
$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
  $statement = $conn->prepare("SELECT* FROM users");
  $statement->execute();
  $collection = $statement->fetchAll();

  ?>

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


  <!------------------------PROFIELFOTO--------------------------->

  <h3>Profielfoto</h3>



<form method="post" enctype="multipart/form-data" action="uploadProfilePic.php">
<table>

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

  <!------------------------PASSWORD--------------------------->
  <h3> Gegevens wijzigen </h3>



<br>

<form method="POST" action="profiel.php" enctype="multipart/form-data">
<table>
<tr>
<td>Old password:</td>
<td><input type="text" name="oldpassword"/></td>
</tr>
<tr>
<td>New password</td>
<td><input type="text" name="newpassword"/></td>
</tr>
<tr>
<td>Change password</td>
<td><input type="submit" name="submit"/></td>
</tr>
</table>
</form>



<?php

if ($_POST['submit'])
{

$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];

echo"$newpassword/$oldpassword";
}

$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
  $statement = $conn->prepare("SELECT password FROM users") or die("didn't work");
  $statement->execute();
  $collection = $statement->fetchAll();





/*echo"<form action ='profiel.php' method='POST'>
Old password: <input type='text' name='oldpassword'><br>
New password: <input type='password' name='newpassword'><br>
Repeat new password: <input type='password' name='repeatnewpassword'><br>
<input type='submit' name='submit' value='Change password'>

</form>

";*/

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





  
 
 
