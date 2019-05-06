
<?php

//include_once 'bootstrap.php';
include_once 'nav.inc.php';

//$dbconn = Db::getInstance();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">

    <title>SEARCH</title>
</head>
<body>
    
</body>
</html>



<?php
if(isset($_POST['submit_search'])){
    $search= $_POST['search'];
    echo $search;
    $stmt = $dbconn->prepare("SELECT * FROM images_with_fields WHERE image_text LIKE '%search%'");
    $stmt->execute();

    if(!$stmt->rowCount() == 0){
        while ($row = $stmt->fetch()){
            echo $row['image'];
            echo $row['image_text'];
        }
    }
}

   

?>