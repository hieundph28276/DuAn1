<?php
    require 'connect.php';
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM `asm_2`.`them`";
    $query = $connect -> prepare($sql);
    $query -> execute();
    $list_inster = array();
    while($inster = $query -> fetch(PDO::FETCH_ASSOC)){
        array_push($list_inster, $inster);
    }

    $sql = "SELECT * FROM `asm_2`.`products`";
    $query = $connect -> prepare($sql);
    $query -> execute();
    $list_products = array();
    
    while($products = $query -> fetch(PDO::FETCH_ASSOC)){
        array_push($list_products, $products);
    }
    
    
    // echo "<pre>";
    // print_r($list_products);
    // echo "<pre>";
    foreach($list_products as $products){
        if($products['id_products'] = $id){
            $update_products = $products;
        }
    }

    if(isset($_POST['update'])){
        $up_name = $_POST['name'];
        $up_price = $_POST['price'];
        $up_description = $_POST['description'];
        $up_image = $_POST['img'];
        // $up_users = $_POST['category'];
        $sql = "UPDATE `asm_2`.`products` SET `products_name` = '{$up_name}', `price` = '{$up_price}', `image` = '{$up_image}', `description` = '$up_description' WHERE `asm_2`.`products`.`id_products` = {$id}";

        $connect -> exec($sql);

        if($connect){
            header('Location:show_sp.php');
        }
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <Style>
    .container {
        border: 0px solid black;
        width: 340px;
        padding: 20px 20px;
        margin: 20px 20px;
        /* background: #EEEEEE; */
    }

    #submit {
        margin-left: 60px
    }

    input {
        border: 1px solid #00CCFF;
        padding: 5px 5px;
    }

    p {
        color: red;
    }
    h3{
        font-size: 45px;
        margin-left: 33px;
    }
    </Style>
</head>

<body>
    <h3>Update sản phẩm</h3>
    <div class="container">
        <form action="" method="POST">
            Product Name <br>
            <input type="text" name="name" id="" value="<?php echo $update_products['products_name'] ?>"> <br>
            Description <br>
            <input type="text" name="description" id="" value="<?php echo $update_products['description'] ?>"> <br>
            Price <br>
            <input type="number" name="price" id="" value="<?php echo $update_products['price'] ?>"> <br>
            Tên chủ tài khoản quản trị <br>
            <select name="category" id="" style="width: 340px; height: 30px;">
                <option value="laptop">-----Chọn----- </option>
                <?php
                    foreach($list_inster as $inster){
                        ?>
                        <option value="<?php echo $inster['cat_id']?>"><?php echo $inster['cat_name']?>></option>
                        <?php
                    }
                ?>
            </select> <br>
                    Room Image: <br>
                    <input type="file" name="img" id="" value="<?php echo $update_products['image'] ?>"><br> <br>
                    <input type="submit" name="update" id="" value="save" style=" background: #00CCFF;">
        </form>
        <hr>
    </div>
</body>

</html>