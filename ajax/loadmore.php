<?php

require_once("../bootstrap.php");


//$showLimit = 2;
/* selecting posts
$conn = Db::getInstance();
$query = $conn->prepare( 'SELECT * FROM images_with_fields LIMIT '.$showLimit);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);*/



if(!empty($_GET)) {

   try{
       $e  = Post::getAll();
        if($e==true){
                $result=[
                    "status" => "succes",
                    "message" => "Hier zijn de afbeeldingen"
                    ];
                
            }else {
                $result=[
                    "status" => "false",
                    "message" => "Oepsie poepsie"
                    ];
            }
           
        }
    catch(Throwable $t){
        $result=[
            "status" => "error",
            "message" => "er is iet fout gelopen"
            ];
    }

    
    echo json_encode($result);
           
    
        }






