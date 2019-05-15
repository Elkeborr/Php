<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();

// connectie met de databank
require_once 'bootstrap.php';
$conn = Db::getInstance();

if (isset($_FILES['profileImg'])) {
    if ($_FILES['profileImg']['error'] > 0) {
        //for error messages: see http://php.net/manual/en/features.fileupload.errors.php
        switch ($_FILES['profileImg']['error']) {
        case 1:
        $msg = 'You can only upload 2MB';
        break;
        default:
        $msg = 'Sorry, uw upload kon niet worden verwerkt.';
            echo "<button onclick=\"location.href='index.php'\">Try again</button>";
        }
    } else {
        //check MIME TYPE - http://php.net/manual/en/function.finfo-open.php
        $allowedtypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
        $filename = $_FILES['profileImg']['tmp_name'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($filename);

        if (in_array($fileinfo, $allowedtypes)) {
            //move uploaded file
            $newfilename = 'images/profile_images/'.$_FILES['profileImg']['name'];
            //id
            $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
            $stm->execute();
            $id = $stm->fetch(PDO::FETCH_COLUMN);

            if (move_uploaded_file($_FILES['profileImg']['tmp_name'], $newfilename)) {
                $insert = $conn->query("UPDATE users
                SET profileImg = '".$newfilename."'
                WHERE users.id='".$id."';");

                header('location:profiel.php');
            } else {
                $msg = 'Sorry, de upload is mislukt.';
            }
        } else {
            $msg = 'Sorry, enkel afbeeldingen zijn toegestaan.';
        }
    }
}
