<?php

//Connectie klasses
include_once("bootstrap.php");

$conn = Db::getInstance();

// Username ophalen
$stm = $conn-> prepare ("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
$stm->execute();
$id=$stm->fetch(PDO::FETCH_COLUMN);

$statement = $conn->prepare("SELECT userName FROM users WHERE users.id=:id");
$statement->bindValue(":id", $id); 
$statement->execute();
$username=$statement->fetch(PDO::FETCH_COLUMN);

?>

<nav class="navbar">
   
    <a href="profiel.php"><img src="images/hero_login.jpg" alt="profileImage"></a>
    
    <a href="profiel.php"><?php echo $username; ?></a>

    <a href="index.php" class="logo">Plantspiratie</a>
    
    <form action="search.php?go" method="get">
      <input type="text" name="search" class="search" placeholder="zoek">
      <input type="submit" name="submit" value="search">

    </form>
    
    <a href="logout.php" class="navbar__logout">logout</a>
</nav>