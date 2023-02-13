<?php
    $hostname = 'localhost';
    $db_name = 'asm_2';
    $username = 'root';
    $password = '';

    try{
        $connect = new PDO("mysql:host = $hostname; db_name = $db_name",$username, $password);
        $connect -> setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);
        echo "Kết nối thành công";
    }catch(PDOException $e){
        echo $e -> getMessage();
    }
    
?>

