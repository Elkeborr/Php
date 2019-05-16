
<?php
require_once 'bootstrap.php';

$allPosts = Post::getAll();

?>
<!DOCTYPE html>
<html lang="en" class="profiel">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>All</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="collection">
<?php foreach ($allPosts as $p): ?>
  <div class="collection__item">
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image  <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
        <div class="profile--small ">
         <a href="user.profiel.php?id=<?php echo $p['user_id']; ?>" > <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> </a>
         
        </div>
        <p><?php echo $p['image_text']; ?></p>
        <p id="date"><?php echo  $p['date']; ?></p>
          
      </div>
      <div class='likeContainer'>
            <a href="#" data-id="<?php echo $post->id ?>" class='like' >Like</a>
            <span class='likes'><?php echo $post->getLikes(); ?>0</span>
        </div>
  </div>
<?php endforeach; ?> 
</div>
<script>
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

    
</body>
</html>