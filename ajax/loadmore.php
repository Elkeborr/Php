<?php

require_once '../bootstrap.php';
session_start();
$row = $_POST['row'];

$rowperpage = 3;

$conn = Db::getInstance();

// selecting posts
$stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
$stm->execute();
$id = $stm->fetch(PDO::FETCH_COLUMN);

$posts = $conn->prepare("SELECT images_with_fields.id,images_with_fields.image,images_with_fields.image_text,images_with_fields.user_id
FROM images_with_fields,followers WHERE followers.user_id1=:id AND followers.user_id2=images_with_fields.user_id 
UNION SELECT images_with_fields.id,images_with_fields.image,images_with_fields.image_text,images_with_fields.user_id FROM images_with_fields,followers 
WHERE  images_with_fields.user_id =:id  LIMIT $row,$rowperpage");
$posts->bindValue(':id', $id);
$posts->execute();

$result = $posts->fetchAll(PDO::FETCH_ASSOC);

$html = '';

foreach ($result as $r) {
    $id = $r['id'];
    $image = $r['image'];
    $image_text = $r['image_text'];
    //$date = $r['date'];

    // Creating HTML structure
    $html .= '<div class="collection__item">';
    $html .= '<a href="detail.php?id='.$id.'"><img class="collection--image" src="'.$image.'" alt="Post"></a>';
    $html .= '<div class="item--container">';
    $html .= '<div class="profile--small ">';
    $html .= ' <img class="profile--imageSmall" src="">';
    $html .= '</div>';
    $html .= '<p>'.$image_text.'</p>';
    // $html .= '<p>'.$date.'</p>';
    $html .= '<button>Like</button>';
    $html .= '</div>';
    $html .= '</div>';
}

echo $html;
