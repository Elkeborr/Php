<?php

//Connectie klasses
include_once 'bootstrap.php';

$username = User::username();
$profileImg = User::profileImg();

?>

<nav class="navbar">
   
<div class="profile--small">
    <a href="profiel.php"><img  class="profile--imageSmall" src="<?php echo $profileImg; ?>" alt="profileImage"></a>
</div>
    <a href="profiel.php" class="userName"><?php echo $username; ?></a>

    <a href="index.php" class="logo">Plantspiratie</a>
    
    <form action="search.php" method="post">
      <input type="text" name="search" class="search" placeholder="zoek">
      <input type="submit" name="submit_search" value="search" class="search_submit">

    </form>
    
    <a href="logout.php" class="navbar__logout">logout</a>
</nav>