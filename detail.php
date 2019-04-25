<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);

$id = $_GET['id'];

$statement = $conn->prepare("SELECT * FROM images_with_fields where id = $id");
$statement->execute();
$collection = $statement->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
  <div class="collection">
            <?php foreach($collection as $c): ?>
              <img src="<?php echo $c['id']; ?>" class="collection__detail" style="background-image:url(<?php echo $c['image']; ?>)" alt="">
              <p class="collectionDetails__desc"><?php echo $c['image_text']; ?></p>
            <?php endforeach; ?>
  </div>

</body>
</html>