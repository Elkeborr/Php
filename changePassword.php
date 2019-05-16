<?php
require_once 'bootstrap.php';
User::changePassword();
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
<?php include_once 'includes/nav.inc.php'; ?>

<body>
<form method="POST" action="changePassword.php">
   Old password: <input type="password" name="oldpassword"><br/>
   New password: <input type="password" name="newpassword"><br/>
   <input type="submit" value="wijzig" name="submit">
</form>
</body>
</html>





