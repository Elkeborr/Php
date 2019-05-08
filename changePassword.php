<?php
// DIT MOET IN USER
 if (!empty($_POST)) {
     // email en password opvragen
     $oldpassword = $_POST['oldpassword'];
     $newpassword = $_POST['newpassword'];

     //hash opvragen, op basis van email
     $conn = new PDO('mysql:host=localhost;dbname=project_php;', 'root', 'root', null);

     // check of rehash van password gelijk is aan hash uit db
     $statement = $conn->prepare("SELECT * FROM users WHERE password='".$newpassword."'");
     $result = $statement->execute();

     $user = $statement->fetch(PDO::FETCH_ASSOC);

     if (password_verify($newpassword, $user['password'])) {
         $error = true;
     } else {
         session_start();
         $_SESSION['password'] = $newpassword;
         header('Location:profiel.php');
     }
 }

        ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Password_change</title>
</head>
<body>
<form method="POST" action="changePassword.php">
   Old password: <input type="password" name="oldpassword"><br/>
   New password: <input type="password" name="newpassword"><br/>
   Repeat new password: <input type="password" name="repeatNewpassword"><br/>
   <input type="submit" value="wijzig" name="submit">
</form>
</body>
</html>





