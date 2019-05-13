<?php
//session_start();

  //Connectie klasses
include_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();

  $posts = Post::getAll();
  $post = count($posts);

  var_dump($post);

  if (!empty($posts)) {
      $show = true;
  } else {
      $error = true;
  }
  $profileImg = Post::profilePic();



  


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
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
        <div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> 
        </div>
        <p><?php echo $p['image_text']; ?></p>
        <p id="date"><?php echo  $p['images_date']; ?></p>
        <!--<button>Like</button><div><a href="#" data-id="<?//php echo $post->id ?>" class="like">Like</a> <span class='likes'><?//php echo $post->getLikes(); ?>*/</span></div>-->
         
      </div>


<?php while ($row = $post->fetch()) { ?>

<div class="post">
    <?php echo $row['image_text']; ?>

    <div style="padding: 2px; margin-top: 5px;">
    <?php 
        // determine if user has already liked this post
        $results = $con->prepare("SELECT * FROM likes WHERE userid=1 AND postid=".$row['id']."");

        if ($results->rowCount() == 1 ): ?>            <!-- user already likes post -->
            <span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
            <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
        <?php else: ?>
            <!-- user has not yet liked post -->
            <span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
            <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
        <?php endif ?>

        <span class="likes_count"><?php echo $row['likes']; ?> likes</span>
    </div>
</div>

<?php } ?>
  </div>
<?php endforeach; ?> 
</div>
<?php endif; ?>


<button id="load--more">Load More</button>
<input type="hidden" id="row" value="0">
<input type="hidden" id="all" value="<?php echo $post; ?>">

</body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){

// Load more data
$('#load--more').click(function(){
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
    var rowperpage = 3;
    
  row=row + rowperpage;

    if(row <= allcount){
        $("#row").val(row);
        $.ajax({
            url: 'ajax/loadMore.php',
            type: 'POST',
            data: {row: row},
            beforeSend:function(){
                $("#load--more").text("Loading...");
            },
            success: function(response){

                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    $(".collection__item:last").after(response).show().fadeIn("slow");
                    
                    var rowno = row + rowperpage;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount){

                        // Change the text and background
                        $('#load--more').text("No more posts");
                        $('#load--more').css("background","#F2F2F2");
                        $('#load--more').off('click');
                    }else{
                        $("#load--more").text("Load more");
                    }
                }, 2000);

            }
        });
    }else{
        $('#load--more').text("Loading...");

        // Setting little delay while removing contents
        setTimeout(function() {

            // Reset the value of row
            $("#row").val(0);

            // Change the text and background
            $('#load--more').text("Load more");
           
        }, 2000);


    }

});

});
            
 /* index.php script
 $("a.like").on("click", function(e){
            // op welke post?
            var postId = $(this).data('id');
            var elLikes = $(this).parent().find(".likes");
            var likes = elLikes.html();
 
            $.ajax({
                method: "POST",
                url: "ajax/like.php",
                data: { postId: postId },
                dataType: "json"
            })
            .done(function( res ) {
                if(res.status == "success") {
                    likes++;
                    elLikes.html(likes);
                }
            });
 
            e.preventDefault();
        });*/
        $(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>