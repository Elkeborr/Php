<?php 

  //Connectie klasses
include_once("bootstrap.php");

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();


/*$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
$statement = $conn->prepare("SELECT* FROM images_with_fields");
$statement->execute();
$collection = $statement->fetchAll();
*/
  $posts = Post::getAll();
  var_dump(session_id());
  if(!empty($posts)){
    $show = true;
  }else{
    $error = true;
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

<div class="collection">
  
    <?php foreach($posts as $p): ?>
        <a href="detail.php?id=<?php echo $p['id']; ?>" class="collection__item" style="background-image:url(<?php echo $p['image']; ?>)"></a>
        <p><?php echo $p['image_text']; ?></p>
    <?php endforeach; ?> 
  <?php endif; ?>
</div>
<a class="load--more" href="#">Load More</a>
</body>
</html>