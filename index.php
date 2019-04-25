<?php 
  $conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
  $statement = $conn->prepare("SELECT* FROM images_with_fields");
  $statement->execute();
  $collection = $statement->fetchAll();

  if(!empty($collection)){
    $show = true;
  }else{
    $error = true;
  }

/*Op deze manier gaat de website starten 
met login enkel als er een sessie gestart is 
dan zal de index tevoorschijn komen
=> we  zetten dit nog evn uit omdat we anders moeilijker aan de p kunnen
*/
session_start();
if(isset($_SESSION ['email'])){

}else {
  header ("Location: login.php");
  include_once("data.inc.php"); 
}





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

<?php include_once("nav.inc.php"); ?>

<div class="upload">

  <form enctype="multipart/form-data" action="upload.php" method="POST" class="form"> 
    <input type="file" name="image" capture="camera" required><br>
    <br><textarea name="description" cols="40" rows="4" placeholder="Description" required></textarea><br>
    <input type="submit" value="upload" name="upload" class="input">  
  </form>      
</div>

<!-------AFBEELDINGEN SHOWEN------->
<?php if (isset($error)): ?>
    <div class="form__error">
			<p> No followers yet, what a bummer! Search for them and share nature with them! </p>
		</div>
	<?php endif; ?>

  <?php if (isset($show)): ?>


        <a href="detail.php?id=<?php echo $c['id']; ?>" class="collection__item" style="background-image:url(<?php echo $c['image']; ?>)"></a>
        <p><?php echo $c['image_text']; ?></p>
    <?php endforeach; ?> 
    <?php endif; ?>
</div>
<a class="load--more" href="#">Load More</a>
</body>
</html>