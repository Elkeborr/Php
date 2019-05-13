<?php

include_once 'bootstrap.php';
//session_start();

if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
    $result = $con->prepare("SELECT * FROM images_with_fields WHERE id=$postid");
    $row = $result->fetch();
    $n = $row['likes'];

    $con->prepare("INSERT INTO likes (userid, postid) VALUES (1, $postid)");
    $con->prepare("UPDATE images_with_fields SET likes=$n+1 WHERE id=$postid");

    echo $n+1;
    exit();
}
if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
    $result = $con->prepare("SELECT * FROM images_with_fields WHERE id=$postid");
    $row = $result->fetch();
    $n = $row['likes'];

    $con->prepare("DELETE FROM likes WHERE postid=$postid AND userid=1");
    $con->prepare("UPDATE images_with_fields SET likes=$n-1 WHERE id=$postid");
    
    echo $n-1;
    exit();
}

// Retrieve posts from the database
$posts = $con->prepare("SELECT * FROM images_with_fields");





?>