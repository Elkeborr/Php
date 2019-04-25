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
  <title></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
  <div class="collection">
            <?php foreach($collection as $c): ?>
              <img src="<?php echo $c['id']; ?>" class="collection__detail" style="background-image:url(<?php echo $c['image']; ?>)" alt="">
              <p class="collectionDetails__desc"><?php echo $c['image_text']; ?></p>
            <?php endforeach; ?>
  </div>

  <?php 
	//Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript

	include_once("bootstrap.php");
	
	//controleer of er een update wordt verzonden
	if(!empty($_POST))
	{
		try {
			$comment = new Comment();
			$comment->setText($_POST['comment']);
			$comment->Save();
			
		} catch (\Throwable $th) {
			//throw $th;
		}
	}
	
	//altijd alle laatste activiteiten ophalen
	$comments = Comment::getAll();
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IMDBook</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript">

	</script>

<div>
	<div class="errors"></div>
	
	<form method="post" action="" class="formComment">
		<div class="statusupdates">
		<textarea name="comment" id="comment" placeholder="Comment..." cols="30" rows="5"></textarea>
		<input id="btnSubmit" type="submit" value="Add comment" class="formComment__btn" />
		
		<ul id="listupdates">
		<?php 
			foreach($comments as $c) {
					echo "<li>". $c->getText() ."</li>";
			}

		?>
		</ul>
		
		</div>
	</form>
	
</div>	
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>
	$("#btnSubmit").on("click",function(e){

		var text = $("#comment").val();

		$.ajax({
  			method: "POST",
  			url: "ajax/postcomment.php",
  			data: { text: text},
			dataType: 'json'
		})
  		.done(function( res ) {
			if( res.status == 'success'){
				var li = "<li>" + text + "</li>";
				$("#listupdates").append(li);
				$("#comment").val("").focus();
				$("#listupdates li").last().slideDown();

			}
  		});

		e.preventDefault();


	});
</script>

</body>
</html>