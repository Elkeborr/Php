<?php
  //Connectie klasses
require_once 'bootstrap.php';

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();

  $timeago = Post::getTimeAgo(strtotime($_GET['posts.date']));
  $posts = Post::get();
  $post = count($posts);

  $filters = Post::getFilters();

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
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Plantspiratie</title>
</head>
<body>

<?php include_once 'includes/nav.inc.php'; ?>

<!-------UPLOADEN VAN AFBEELDING------->

<div class="upload">
<h3>Upload hier een foto</h3>
  <form enctype="multipart/form-data" action="upload.php" method="POST" class="form"> 
  <p>Choose your filter</p>
    <select name="filter" >
        <?php  foreach ($filters as $f): ?>
        <option  value="<?php echo $f['id']; ?>"><?php echo $f['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br> 
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
  <p id="date"><?php echo $timeago; ?></p>

      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image  <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
        <div class="profile--small ">
         <a href="user.profiel.php?id=<?php echo $p['user_id']; ?>" > <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> </a>
        </div>
        <p><?php echo $p['image_text']; ?></p>
        <div><a href="#" data-id="<?php echo $post->id ?>" class="like">Like</a> <span class='likes'><?php echo $post->getLikes(); ?></span></div>

        <p id="date"><?php echo  $p['images_date']; ?></p>
         
      </div>



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
    row = row + rowperpage;
    console.log (row);
    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'ajax/loadMore.php',
            type: 'post',
            data: {row:row},
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
                        $('#load--more').css("background","#273B09");
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
            

        // index.php script
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
        });
  

</script>