<?php 

    include './funkcije.php';
    session_start();
    session_destroy();
    redirect("./login.html");
?>