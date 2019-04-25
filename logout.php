<?php
    session_start();
    session_destroy();
    setcookie('flix', null, time()-3600);
    header('location: login.php');
?>