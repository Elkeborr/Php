<?php

//Connectie klasses
include_once("bootstrap.php");




?>

<nav class="navbar">
   
    <a href="profiel.php"><img src="images/hero_login.jpg" alt="profileImage"></a>
  
    <a href="profiel.php"><?php echo $_SESSION['email']; ?></a>
    
    <a href="index.php" class="logo">Plantspiratie</a>
    
    <form action="search.php" method="get">
      <input type="text" name="search">
      <input type="submit" name="submit" value="search">

    </form>
    
    <a href="logout.php" class="navbar__logout">logout</a>
</nav>