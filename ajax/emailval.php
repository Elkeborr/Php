<?php

require_once("../bootstrap.php");
  
if(!empty($_POST)) {
// deze text meot zetflde zijn als de text van de ajax 'data'
    $text= $_POST['text']; 
    try{

        $e  = User::EmailAvailable($text);
        //$e->setEmail($text);
        //$e-> EmailAvailable();

        if ($e == false){

            $result=[
                    "status" => "auwtch",
                    "message" => "Don't copy 💩"
                    ];
        }else {
            $result=[
                "status" => "success",
                "message" => "E-mail not found ✌🏻" 
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
    


