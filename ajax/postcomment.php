<?php
    require_once("../bootstrap.php");

    if(!empty($_POST)){
        // comment text uitlezen
        $text = $_POST['text'];

        // comment opslaan in db
        try{
        $c = new comment();
        $c->setText($text);
        $c->save();

        $result = [
            "status"=>"success",
            "message"=>"Comment was saved"
        ];
        }catch(Throwable $t){
            $result = [

                "status"=>"error",
                "message"=>"Something went wrong"

            ];

        }

        echo json_encode($result);
        // connectie
        // query (insert)

        // antwoord geven aan uw JS frontend (json)


    }
?>