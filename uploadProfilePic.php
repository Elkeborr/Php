<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// connectie met de databank
require_once("bootstrap.php");
$conn = Db::getInstance();

// in elke file waar we sessie willen gebruiken moeten we die dan ook starten
session_start();

if (isset ($_FILES["image"])){

    if ($_FILES["image"]["error"] > 0)
    {
 //for error messages: see http://php.net/manual/en/features.fileupload.errors.php
        switch($_FILES["image"]["error"])
        {
        case 1:
        $msg = "U mag maximaal 2MB opladen.";
        break;
        default:
        $msg = "Sorry, uw upload kon niet worden verwerkt.";
            echo("<button onclick=\"location.href='profiel.php'\">Try again</button>");
        }
    }
    else
    {
        //check MIME TYPE - http://php.net/manual/en/function.finfo-open.php
        $allowedtypes = array("image/jpg", "image/jpeg", "image/png", "image/gif");
        $filename = $_FILES["image"]["tmp_name"];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($filename);

        if(in_array($fileinfo, $allowedtypes))
        {

            //move uploaded file
            $newfilename = "images" . $_FILES["image"]["name"]; 
            //id
            $stm = $conn-> prepare ("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
            $stm->execute();
            $id=$stm->fetch(PDO::FETCH_COLUMN);
 
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename))
            {

                $insert = $conn->query("INSERT into users (image) 
                                        VALUES ('".$newfilename."', '".$id."')");

                header('location:profiel.php');
            }
            else
            {
                $msg = "Sorry, de upload is mislukt.";
            }
        }
        else
        {
        $msg = "Sorry, enkel afbeeldingen zijn toegestaan.";
        }

}

 // if no error occured, continue ....
 if(!isset($msg))
 {
  $stm = $conn->prepare("UPDATE users SET image=:uimage, WHERE email = '".$_SESSION['email']."'");
  $stm->bindParam(':uimage',$image);
   
  if($stm->execute()){
   ?>
               <script> alert('Successfully Updated ...');
                        window.location.href='profiel.php';
                </script>
<?php
  }
  else{
   $msg = "Sorry Data Could Not Updated !";
  }
 }    
 echo $msg . "<br />";
}
 
?>
