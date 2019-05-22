<?php
require_once 'bootstrap.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$posts = Post::detailPagina($_GET['id']);
$colors = Post::getColors($_GET['id']);

$filters = Post::getFilters();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Detail</title>
</head>
<body>


<?php include_once 'includes/nav.inc.php'; ?>
<?php $dbconn = Db::getInstance(); ?>


<div class="collection__detail">
	<?php foreach ($posts as $c): ?>

	<a href="detail.php?id=<?php echo $c['id']; ?>" ><img src="<?php echo $c['image']; ?>" alt="Post" class="collection--image  <?php echo $c['name']; ?>"></a>
	<p><?php echo $c['image_text']; ?></p>
	<p id="date"><?php echo Post::getTimeAgo(strtotime(date($c['date']))); ?></p>

	<div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $c['profileImg']; ?>"> 

        </div>
		

	  <div class="clearfix">
	  
		<?php foreach ($colors as $color) {
    echo '
			  <div class="color"> 
			  
			  <a href="search.php?search='.$color.'"><div class="bol" style="background:#'.$color.';"></div>
			  <p>#'.$color.'</p></a></div>';
} ?>


	<?php endforeach; ?>



	  </div>
</div>


<?php
    //Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript

    include_once 'bootstrap.php';

    //controleer of er een update wordt verzonden
    if (!empty($_POST)) {
        try {
            $comment = new Comment();
            $comment->setText(htmlspecialchars(($_POST['comment'])));
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
		$id = $_GET['id'];

		$.ajax({
  			method: "POST",
  			url: "ajax/postcomment.php",
  			data: { text: text, post_id: $id},
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
