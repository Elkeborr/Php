<?php

require_once("../bootstrap.php");
  
if(!empty($_POST)) {

    $name= $_POST['name']; 

    try{
        $e  = User::UsernameAvailable($name);
        if ($e == false){
            $result=[
                "status" => "auwtch",
                "message" => "This one is taken"
                    ];
        }else {
            $result=[
                "status" => "success",
                "message" => "Not taken yet" 
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
    


