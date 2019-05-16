
<?php
require_once 'bootstrap.php';
User::changeEmail();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Email_change</title>
</head>
<?php include_once 'includes/nav.inc.php'; ?>

<body>

<form method="POST" action="changeEmail.php">
   Password: <input type="password" name="password"><br/>
   New email: <input type="email" name="newemail"><br/>
   <input type="submit" value="wijzig" name="submit">
</form>


	
</body>
</html>


