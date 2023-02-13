<?php
    require 'connect.php';
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM `asm_2`.`products` WHERE `asm_2`.`products`.`id_products` = {$id}";
    $connect -> exec($sql);
    if($connect){
        header('Location:show_sp.php');
    }
?>