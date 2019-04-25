<?php

require_once("../bootstrap.php");

$row = $_POST['row'];

$rowperpage = 3;

// selecting posts
$query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;
$result = mysqli_query($con,$query);

$html = '';

while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $title = $row['title'];
    $content = $row['content'];
    $shortcontent = substr($content, 0, 160)."...";
    $link = $row['link'];
    // Creating HTML structure
    $html .= '<div id="post_'.$id.'" class="post">';
    $html .= '<h1>'.$title.'</h1>';
    $html .= '<p>'.$shortcontent.'</p>';
    $html .= '<a href="'.$link.'" target="_blank" class="more">More</a>';
    $html .= '</div>';

}

echo $html;






