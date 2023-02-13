<?php

require 'connect.php';
$sql = "SELECT * FROM `asm_2`.`users`";
$query = $connect -> prepare($sql);
$query -> execute();
$list_users = array();
while($users =$query -> fetch(PDO::FETCH_ASSOC)){
    array_push($list_users, $users);
}
// print_r($list_users);
if(isset($_POST['btn-submit'])){
    $name = $_POST['usersname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "INSERT INTO `asm_2`.`users`(`id_users`, `username`, `email`, `password`) VALUES (NULL, '{$name}', '{$email}', '{$pass}')";
    $connect ->exec($sql);
    if($connect){
        // echo "Thêm thành công";
        header('Location:addproduct.php');

    }    
}
	function show_array($array){
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
	if(isset($_POST['btn-submit'])){
		show_array($_POST);
	}
    if(isset($_POST['btn-submit'])){
		if(empty($_POST['usersname'])){
			$error['usersname'] = "Không được để trống usersname";
        }else{
            $pattem = "/^[A-Z,a-z0-9_]{6,32}$/";
            if(!preg_match($pattem,$_POST['usersname'])){
                $error['usersname'] = "Tên đăng nhập không đúng định dạng";
            }else{
                $usersname=$_POST['usersname'];
            }
            
        }

        if(empty($_POST['password'])){
            $error['password'] = "Không được để trống password";
        }else{
            $pass1 = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
            if(!preg_match($pass1,$_POST['password'])){
                $error['password'] = "Mật khẩu không đúng định dạng";
            }else{
                $pass = $_POST['password'];
            }
        }
        
        if(empty($error)){
            echo "Tên Đăng nhập là: {$usersname} <br> Mật khẩu: {$pass}";
        }else{
            show_array($error);
        
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Loading icon -->
    <script src="https://kit.fontawesome.com/2f7cea7c40.js" crossorigin="anonymous"></script>
    <!-- Loading Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet" />
    <!-- Loading Css -->
    <link rel="stylesheet" href="assets/css/reset.css" />
    <link rel="stylesheet" href="assets/css/util.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <title>User</title>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title">
                    <span class="login100-form-title-1"> Sign In </span>
                </div>

                <form class="login100-form validate-form" method="POST">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="usersname"
                            value="<?php if(!empty($usersname)) echo $usersname ?>" placeholder="Enter usersname" />

                        <span class="focus-input100"></span>

                    </div>
                    <p style="color: red;"><?php if(!empty($error['usersname'])) echo $error['usersname']?></p>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password"
                            value="<?php if(!empty($pass)) echo $pass ?>" placeholder="Enter password"/>
                        <span class="focus-input100"></span>
                    </div>
                    <p style="color: red;"><?php if(!empty($error['pass'])) echo $error['pass']?></p>


                    <div style="margin-top:10px;"class="container-login100-form-btn">
                        <input type="submit"name="btn-submit"class="login100-form-btn"value="Login"id="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>