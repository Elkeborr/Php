<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// connectie met de databank
require_once 'bootstrap.php';

$conn = Db::getInstance();

// in elke file waar we sessie willen gebruiken moeten we die dan ook starten
//session_start();

if (isset($_FILES['image'])) {
    if ($_FILES['image']['error'] > 0) {
        //for error messages: see http://php.net/manual/en/features.fileupload.errors.php
        switch ($_FILES['image']['error']) {
        case 1:
        $msg = 'U mag maximaal 2MB opladen.';
        break;
        default:
        $msg = 'Sorry, uw upload kon niet worden verwerkt.';
            echo "<button onclick=\"location.href='index.php'\">Try again</button>";
        }
    } else {
        //check MIME TYPE - http://php.net/manual/en/function.finfo-open.php
        $allowedtypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
        $filename = $_FILES['image']['tmp_name'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($filename);

        if (in_array($fileinfo, $allowedtypes)) {
            $description = $_POST['description'];

            //move uploaded file
            $newfilename = 'images/post_images/'.$_FILES['image']['name'];
            //id
            $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
            $stm->execute();
            $id = $stm->fetch(PDO::FETCH_COLUMN);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)) {
                //kleuren dedecteren
                $insert = $conn->query("INSERT into posts (image, image_text, user_id, likes,filter) 
                                        VALUES ('".$newfilename."', '".$description."', '".$id."',0,)");

                $postId = $conn->prepare("SELECT id FROM posts WHERE image ='".$newfilename."'");
                $postId->execute();
                $post_id = $postId->fetch(PDO::FETCH_COLUMN);

                var_dump($post_id);
                $img = $newfilename;
                $palette = Post::detectColors($img, 5, 1);
                var_dump($palette);

                foreach ($palette as $color) {
                    $update = $conn->query("INSERT into colors (post_id, color)
                 VALUES ('".$post_id."', '".$color."')");
                }

                header('location:index.php');
            } else {
                $msg = 'Sorry, de upload is mislukt.';
            }
        } else {
            $msg = 'Sorry, enkel afbeeldingen zijn toegestaan.';
        }
    }
    //echo $msg.'<br />';
}
