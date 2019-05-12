

<?php 

include_once 'bootstrap.php';
include_once 'search.php';
include_once 'nav.inc.php';


$search = "";

if(isset($_POST['search'])){
    try{
        $dbconn = Db::getInstance();
        $searchResult = post::search($_GET['search']);

    }
    catch (PDOException $exc){
        echo $exc->getMessage();
        exit();
    }

    $search = $_POST['search'];

    $pdoQuery = "SELECT * FROM images_with_fields WHERE search = :search";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":search=>$search"));

    if($pdoExec){
        if($pdoResult->rowCount()>0){
            foreach($pdoResult as $row){
                $search = $row['search'];
            }
        }
        else{
            echo 'No data found';
        }
    }
    else{
        echo 'Niks ingevuld';
    }
}