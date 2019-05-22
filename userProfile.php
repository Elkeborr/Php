<?php
require_once 'bootstrap.php';

$user = User::detailPagina($_GET['id']);
$posts = Post::getPosts($_GET['id']);

//Wie hem volgt
$followers = Follow::detailPaginaFollowers($_GET['id']);
$allFollowers = count($followers);

//Wie hij volgt
$follow = Follow::detailPaginaFollow($_GET['id']);
$allFollows = count($follow);

// Unfollow or follow
$check = Follow::checkFollow($_GET['id']);
if ($check == true) {
    $button = 'unfollow';
} else {
    $button = 'follow';
}

?>
<!DOCTYPE html>
<html lang="en" class="profiel">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Users</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

  <!------------------------PROFIELFOTO--------------------------->
  <?php foreach ($user as $u): ?>
  <div class="profile--container">

<div class="info">
  <div class="profile">
        <img class="profile--image" src="<?php echo $u['profileImg']; ?>" alt="ProfileImg"></a>
</div>  
<p><?php echo $u['firstName'],' ' ,$u['lastName']; ?></p>
<p><span class="followers"><?php echo $allFollowers; ?></span> Followers</p>
<p> <span><?php echo $allFollows; ?></span>  Following</p>
<button class=""id="follow" data-id="<?php echo $u['id']; ?>"><?php echo $button; ?></button>
</div>
  <!------------------------PROFIELTEKST--------------------------->
  <div class="biografie">
<h3>About me</h3>
<p><?php echo $u['bio']; ?> </p></div>  
<?php endforeach; ?>
  </div>
 <!------------------------Posts--------------------------->
 <div class="post--container">
<?php foreach ($posts as $p): ?>
  <div class="collection__item">
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <p><?php echo $p['image_text']; ?></p>
      <p id="date"><?php echo Post::getTimeAgo(strtotime(date($p['date']))); ?></p>
      <div class='item--container'>
        <div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> 
        </div>
     
      
      </div>
  </div>
<?php endforeach; ?> 
 </div>
 <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>

let button = $("#follow").html();


if (button == "follow"){
  $("#follow").addClass("follow");
}else {
  $("#follow").addClass("unfollow");
}

$("#follow").on("click",function(e){

let user_id2= $(this).data('id');

let allFollowers =  $(this).parent().find(".followers");
let followers = allFollowers.html();

$.ajax({
  method: "POST",
  url: "ajax/follow.php",
  data: { user_id2: user_id2 },
  dataType:"json"
})
  .done(function( res ) {
    let button = $('#follow').html();
   if(res.status == "success"){
      followers ++;
      $("#follow").addClass("unfollow");
      allFollowers.html(followers);
      $("#follow").html("unfollow");
     }
  else {
     console.log("error");
   }
   });



// houd het naar boven springen tegen 
e.preventDefault();
	});
</script>





</body>
</html>