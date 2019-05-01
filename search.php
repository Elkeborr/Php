<?php

if(isset($_POST['submit'])){
    $search= $_POST['search'];
    echo $search;
    $stmt = $dbconn->prepare("SELECT * FROM images_with_fields WHERE image LIKE '%search%'");
    $stmt->execute();

    if(!$stmt->rowCount() == 0){
        while ($row = $stmt->fetch()){
            echo $row['image'];
            echo $row['image_text'];
        }
    }
}

   

?>