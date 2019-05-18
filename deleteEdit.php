<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();

// connectie met de databank
require_once 'bootstrap.php';
$conn = Db::getInstance();

if(isset($_SESSION['userid'])){
    $id=$_GET['id'];
    $userid=$_GET['userid'];
    $stm = $conn->prepare("DELETE FROM posts WHERE id = $id and userid = '".$SESSION["userid"]."';");
    
if($stm->execute();)
{
$msg = 'Uw post is verwijderd.';
header('location:profiel.php');
}
else { 
$msg = 'Something went wrong.'
}
}
?>