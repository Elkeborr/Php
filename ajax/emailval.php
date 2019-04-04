<?php

require_once("../bootstrap.php");
  
if(!empty($_POST)) {
// deze text meot zetflde zijn als de text van de ajax 'data'
    $text= $_POST['text']; 
    try{

       // $e  = User::EmailAvailable($text);

        if(filter_var($_POST['text'], FILTER_VALIDATE_EMAIL)){

            $result=[
                    "status" => "success",
                    "message" => "Email is an email"
                    ];
        }else {
            $result=[
                "status" => "Mistake",
                "message" => "E-mail is not an email" 
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
    


