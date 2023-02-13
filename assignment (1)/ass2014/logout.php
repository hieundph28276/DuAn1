<?php
    session_start();
    if($_SESSION['username']){
       unset($_SESSION['username']);
    }
    header('Location:login.php');
    echo "da dang xuat";
    
?>