
<?php
require_once 'bootstrap.php';

$allPosts = Post::getAll();


if (empty($allPosts)) {
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en" class="profiel">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>All</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>
<?php if (isset($error)): ?>
    <div class="form__error">
			<p> Nobody posted anything</p>
		</div>
	<?php endif; ?>
<div class="collection">

<?php foreach ($allPosts as $p): ?>

  <div class="collection__item">
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image  <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
      <a href="userProfile.php?id=<?php echo $p['user_id']; ?>" >
        <div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>">  
        </div>
        </a>
        
        <p><?php echo $p['image_text']; ?></p>
        <p id="date"><?php echo Post::getTimeAgo(strtotime(date($p['date']))); ?></p>
          
      </div>
     
        <div><a href="all.php" data-id="<?php echo $p['id']; ?>" id='likebtn' class="like">Like</a> <span class='likes'><?php echo $post->getLikes($p['id']); ?></span> people like this </div>
        
  
  </div>
<?php endforeach; ?> 
</div>
<script>
         // index.php script
                $("a.like").on("click", function(e) {
            var postId = $(this).data("id");
            var link = $(this);

        $.ajax({
            method: "POST",
            url: "ajax/like.php",
            data: { postId: postId, }, 
            dataType: 'json'
        })
        .done(function( res ) {
            if (res.status == "liked") {
                var likes = link.next().html();
                likes++;
                link.next().html(likes);	
        } else if (res.status == "unliked") {
            var likes = link.next().html();
            likes--;
            link.next().html(likes);	
        }
    });

    e.preventDefault();
    
});


    </script>

    
</body>
</html>