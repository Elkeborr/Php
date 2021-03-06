<?php

require_once '../bootstrap.php';
//session_start();

$offset = $_POST['row'];
$limit = 20;

$conn = Db::getInstance();

// selecting posts

$result = Post::get($limit, $offset);
$html = '';

foreach ($result as $r) {
    $id = $r['id'];
    $userId = $r['user_id'];
    $image = $r['image'];
    $image_text = $r['image_text'];
    $profileImage = $r['profileImg'];
    $date = $r['images_date'];

    // Creating HTML structure
    $html .= '<div class="collection__item">';
    $html .= '<a href="detail.php?id='.$id.'"><img class="collection--image" src="'.$image.'" alt="Post"></a>';
    $html .= '<div class="item--container">';
    $html .= '<div class="profile--small ">';
    $html .= '<a href="userProfile.php?id="'.$userId.'"> <img class="profile--imageSmall" src="'.$profileImage.'"></a>';
    $html .= '</div>';
    $html .= '<p>'.$image_text.'</p>';
    $html .= '<p>'.$date.'</p>';
    $html .= '<button>Like</button>';
    $html .= '</div>';
    $html .= '</div>';
}

echo $html;
