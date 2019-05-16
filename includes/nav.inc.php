<?php

//Connectie klasses
require_once 'bootstrap.php';

$username = User::username();
$profileImg = User::profileImg();

?>

<nav class="navbar">
   
<div class="profile--small">
    <a href="profiel.php"><img  class="profile--imageSmall" src="<?php echo $profileImg; ?>" alt="profileImage"></a>
</div>
    <a href="profiel.php" class="userName"><?php echo $username; ?></a>

    <a href="index.php" class="logo">Plantspiration</a>
    
    <form action="search.php" method="get">
      <input type="text" name="search" class="search" placeholder="search">
      <input type="submit" name="submit_search" value="search" class="search_submit">
    </form>
    <a href="all.php " class="navbar__link"> All posts</a>
    <a href="logout.php" class="navbar__link">logout</a>
</nav>