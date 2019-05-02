<?php
include_once 'bootstrap.php';

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$posts = Post::detailPagina();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Plantspiratie</title>
</head>
<body>

<?php include_once 'nav.inc.php'; ?>

<div class="collection">
    <?php foreach ($posts as $c): ?>
    	<img src="<?php echo $c['id']; ?>" class="collection__detail" style="background-image:url(<?php echo $c['image']; ?>)" alt="">
    	<p class="collectionDetails__desc"><?php echo $c['image_text']; ?></p>
	<?php endforeach; ?>
</div>

<?php
    //Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript

    include_once 'bootstrap.php';

    //controleer of er een update wordt verzonden
    if (!empty($_POST)) {
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
?>

<div>
	<div class="errors"></div>
	
	<form method="post" action="" class="formComment">
		<div class="statusupdates">
		<textarea name="comment" id="comment" placeholder="Comment..." cols="30" rows="5"></textarea>
		<input id="btnSubmit" type="submit" value="Add comment" class="formComment__btn" />
		
		<ul id="listupdates">
			<?php
                foreach ($comments as $c) {
                    echo '<li>'.$c->getText().'</li>';
                }

            ?>
		</ul>
		
		</div>
	</form>
	
</div>	



	


</body>
</html>

<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous">
	</script>

<script>
	$("#btnSubmit").on("click",function(e){

		var text = $("#comment").val();

		$.ajax({
  			method: "POST",
  			url: "ajax/postcomment.php",
  			data: { text: text, post_id:<?php $_GET['id']; ?>},
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