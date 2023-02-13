<?php

require 'connect.php';
    $sql = "SELECT * FROM `asm_2`.`them`";
    $query = $connect -> prepare($sql);
    $query -> execute();
    $list_inster = array();
    while($inster = $query -> fetch(PDO::FETCH_ASSOC)){
        array_push($list_inster, $inster);
    }
    // echo "<pre>";
    // print_r($list_inster);
    // echo "<pre>";
// validate 
$error = [];
// Ghi nhận DL hợp lệ; insert vào database
if(isset($_POST['btn-submit'])){
	$name = $_POST['name'];
	$price = $_POST['price'];
    $image = $_FILES['img']['name'];
    $description = $_POST['description'];
    $id_inster = $_POST['category'];
    $upload_dir = 'img/';

    $upload_file = $upload_dir.$_FILES['img']['name'];
    // $image_tmp = $_FILES['img']['tmp_name'];
    echo $upload_file;
    $arr_allow = array('png','jpg','jpeg','gif');
    $error = [];



    if(empty($_POST['name'])){
        $error['name'] = "Không được để trống tên sản phẩm";
    }else{
            $name = $_POST['name'];
        } 

        if(empty($_POST['description'])){
            $error['description'] = "Không được để trống mô tả sản phẩm";
        }else if(strlen($_POST['description']) > 200){
            // strlen: trả về số lượng kí tự hoặc độ dài của chuỗi
            $error['description'] = "Không nhập quá 200 kí tự";
        }else{
            $description = $_POST['description'];
        }
        
        if(empty($_POST['price'])){
            $error['price'] = "Giá tiền không được để trống ";
        }else if($_POST['price'] < 0){
            $error['price'] = "Giá tiền không thể dưới 0 đồng";
        }else{
            $price = $_POST['price'];
        }

        //  if(isset($_POST["category"])) { echo $_POST["category"]; } 

            if(!empty($_POST['category'])) {
                $category = $_POST['category'];
                // echo "Chủ tài khoản quản trị mà bạn đã chọn là: {$category} <br>";
            } else {
                $error['category'] = "Vui lòng chọn 1 chủ tài khoản quản trị <br>";
            }

            $type = pathinfo($upload_file, PATHINFO_EXTENSION);
            if(! in_array(strtolower($type),$arr_allow)){
                $error['type'] = "Bạn cần nhập file ảnh";
            }else if ($_FILES["img"]["size"] > 500000) {
                echo "File của bạn quá lớn.";
            }

            // move_uploaded_file($image_tmp,'images/'.$upload_file);
            if(empty($error)){
                if(move_uploaded_file($_FILES['img']['tmp_name'],$upload_file)){
                    echo "Upload file thành công";
                }else{
                    echo "Upload file không thành công";
                    
                }
            }
         

        if(!$error){
            // echo "Product Name: {$name} <br> Description: {$description} <br> Price: {$price} <br> ";
            $sql = "INSERT INTO `asm_2`.`products` (`id_products`, `products_name`, `price`, `image`, `description`, `cat_id`) VALUES (NULL, '{$name}', '{$price}', '{$image}', '{$description}','{$id_inster}')";

            $connect->exec($sql);
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
        width: 343px;
    }
    #save{
        background: #00CCFF;
        width: 100px;
    }
    p {
        color: red;
    }
    h3{
        font-size: 35px;
        margin-left: 33px;
    }
    </Style>
</head>

<body>
    <h3>Thêm sản phẩm</h3>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            Product Name 
            <p style = "color: red;"><?php if(!empty($error['name'])) echo $error['name']?></p>
            <input type="text" name="name" id="" value="<?php if(!empty($name)) echo $name ?>"> <br><br>
            Description 
            <p style = "color: red;"><?php if(!empty($error['description'])) echo $error['description']?></p>
            <input type="text" name="description" id="" value="<?php if(!empty($description)) echo $description?>"> <br><br>
            Price 
            <p style = "color: red;"><?php if(!empty($error['price'])) echo $error['price']?></p>
            <input type="number" name="price" id="" value="<?php if(!empty($price)) echo $price?>"> <br><br>
            Tên chủ tài khoản quản trị <br><br>
            <select name="category" id="" style="width: 340px; height: 30px;">
                <option value="laptop">-----Chọn----- </option>
                <?php
                    foreach($list_inster as $inster){
                        ?>
                        <option value="<?php echo $inster['cat_id']?>"><?php echo $inster['cat_name']?></option>
                        <?php
                    }
                ?>
            </select> <br><br>
                    Room Image: <br><br>
                    <input type="file" name="img" id="" value="" ><br> <br>

                    
                    <input type="submit" name="btn-submit" id="save" value="save" style=" background: #00CCFF;">
        </form>
        <hr>
    </div>
</body>

</html>