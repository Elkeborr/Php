<?php

  //Connectie klasses
include_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();

/*$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
$statement = $conn->prepare("SELECT* FROM images_with_fields");
$statement->execute();
$collection = $statement->fetchAll();
*/
  $posts = Post::getAll();
 var_dump($posts);
  if (!empty($posts)) {
      $show = true;
  } else {
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

<?php include_once 'nav.inc.php'; ?>

<!-------UPLOADEN VAN AFBEELDING------->

<div class="upload">
<h3>Upload hier een foto</h3>
  <form enctype="multipart/form-data" action="upload.php" method="POST" class="form"> 
    <input type="file" name="image" capture="camera" required/><br>
    <br><textarea name="description" cols="40" rows="4" placeholder="Description" required></textarea><br>
    <input type="submit" value="upload" name="upload" class="input"/>  
  </form>      
</div>

<!-------AFBEELDINGEN SHOWEN------->

<?php if (isset($error)): ?>
    <div class="form__error">
			<p> No followers yet, what a bummer! Search for them and share nature! </p>
		</div>
	<?php endif; ?>

  <?php if (isset($show)): ?>

<div class="collection">
 
    <?php foreach ($posts as $p): ?>
    <div class="collection__item">
        <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image"src="<?php echo $p['image']; ?>" alt="Post"></a>
        <!--<img class="profile__image" scr="images/hero_login.jpg">---> <p><?php echo $p['image_text']; ?></p>
  </div>
    <?php endforeach; ?> 
  <?php endif; ?>

</div>
<button id="load--more">Load More</button>

            


</body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>

$("#load--more").click(function (e){
	
	$.ajax({
	    method: "GET",
		  url: "ajax/loadmore.php",
		  data: {text: text},
		  dataType: 'json'
		})
  		.done((function (res)  {
		if(res.status == "mistake"){
        $("#email_error").html(res.message);
        }
    }));
    e.preventDefault();
        });
            


</script>