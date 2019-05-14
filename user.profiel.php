<?php
require_once 'bootstrap.php';

$user = User::detailPagina($_GET['id']);
$posts = Post::getPosts($_GET['id']);

$followers = User::detailPaginaFollowers($_GET['id']);
$allFollowers = count($followers);

$follow = User::detailPaginaFollow($_GET['id']);
$allFollows = count($follow);
?>


<!DOCTYPE html>
<html lang="en" class="profiel">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Gebruikers Profiel</title>
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
<p class="followers"><?php echo $allFollows; ?></p>
<p> volgend</p>
<button id="follow" data-id="<?php echo $u['id']; ?>">Volg</button>
</div>
  <!------------------------PROFIELTEKST--------------------------->
  <div class="biografie">
<h3>Biografie</h3>
<p><?php echo $u['bio']; ?> </p></div>  
<?php endforeach; ?>
  </div>
 <!------------------------Posts--------------------------->
 <div class="post--container">
<?php foreach ($posts as $p): ?>
  <div class="collection__item">
      <a href="detail.php?id=<?php echo $p['id']; ?>" > <img class="collection--image <?php echo $p['name']; ?>" src="<?php echo $p['image']; ?>" alt="Post"></a>
      <div class='item--container'>
        <div class="profile--small ">
          <img class="profile--imageSmall" src="<?php echo  $p['profileImg']; ?>"> 
        </div>
        <p><?php echo $p['image_text']; ?></p>
        <p id="date"><?php echo  $p['date']; ?></p>
     
      
      </div>
  </div>
<?php endforeach; ?> 
 </div>
 <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>

$("button#follow").on("click",function(e){
// op welke post?
let user_id2= $(this).data('id');
console.log(user_id2);
let allFollowers =  $(this).parent().find(".followers");
console.log(allFollowers);
let followers = allFollowers.html();
console.log(followers);


$.ajax({
  method: "POST",
  url: "ajax/follow.php",
  // vakje postId: en daar de id van
  data: { user_id2: user_id2 },
  // data type defineren; server gaat json terg geven
  dataType:"json"
})
  .done(function( res ) {
   if(res.status == "success"){
		followers ++;
    allFollowers.html(followers);
    $("button#follow").html("unfollow");
   }
  });



// houd het naar boven springen tegen 
e.preventDefault();
	});
</script>





</body>
</html>