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

$posts = $conn->prepare("SELECT images_with_fields.id,images_with_fields.image,images_with_fields.image_text,images_with_fields.user_id,
images_with_fields.date AS images_date,users.profileImg 
FROM images_with_fields,followers,users 
WHERE followers.user_id1=:id
AND followers.user_id2=images_with_fields.user_id 
AND followers.user_id2 = users.id 
UNION SELECT images_with_fields.id,images_with_fields.image,images_with_fields.image_text,images_with_fields.user_id,images_with_fields.date,users.profileImg 
FROM images_with_fields,users 
WHERE images_with_fields.user_id =:id AND users.id=:id ORDER BY `images_date` DESC LIMIT $row,$rowperpage");
$posts->bindValue(':id', $id);
$posts->execute();

$result = $posts->fetchAll(PDO::FETCH_ASSOC);
$html = '';

foreach ($result as $r) {
    $id = $r['id'];
    $image = $r['image'];
    $image_text = $r['image_text'];
    $profileImage = $r['profileImg'];
    $date = $r['date'];

    // Creating HTML structure
    $html .= '<div class="collection__item">';
    $html .= '<a href="detail.php?id='.$id.'"><img class="collection--image" src="'.$image.'" alt="Post"></a>';
    $html .= '<div class="item--container">';
    $html .= '<div class="profile--small ">';
    $html .= ' <img class="profile--imageSmall" src="'.$profileImage.'">';
    $html .= '</div>';
    $html .= '<p>'.$image_text.'</p>';
    $html .= '<p>'.$date.'</p>';
    $html .= '<button>Like</button>';
    $html .= '</div>';
    $html .= '</div>';
}

echo $html;
