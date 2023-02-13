<?php
    session_start();
    // $_SESSION['is_login'] = "Đã uotLogin";
    // header('Location: product.php');
    // session_start();
    if(isset($_SESSION['username'])){
        header('Location:show_sp.php');
}
    require 'connect.php';
    $sql = "SELECT * FROM `asm_2`.`login`";
    $query = $connect -> prepare($sql);
    $query -> execute();
    $list_login = array();
    while($login = $query -> fetch(PDO::FETCH_ASSOC)){
        array_push($list_login,$login);
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
		if(empty($_POST['username'])){
			$error['username'] = "Không được để trống username";
            $_SESSION['username']=$username;
            header('Location:show.php');
        }else{
            $pattem ="/^[A-Z,a-z0-9_]{6,32}$/";
            if(!preg_match($pattem,$_POST['username'])){
                $error['username']="Tên đăng nhập không đúng định dạng";
            }else{
                $name = $_POST['username'];
            }
            }
        if(empty($_POST['pass'])){
            $error['pass'] = "Không được để trống password";
        }else{
            $pass1 = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
            if(!preg_match($pass1,$_POST['pass'])){
                $error['pass'] = "Mật khẩu không đúng định dạng";
            }else{
                $pass = $_POST['pass'];
            }
        }
        
        if(empty($error)){
            $name = $_POST['username'];
            $pass = $_POST['pass'];
            $sql = "INSERT INTO `asm_2`.`login` (`id_login`, `name`, `pass`) VALUES (NULL, '{$name}', '{$pass}')";
            $connect -> exec($sql);
            if($connect){
                header('Location:addproduct.php');
            }
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
    <title>Login</title>
   
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
                        <input class="input100" type="text" name="username"
                            value="<?php if(!empty($name)) echo $name ?>" placeholder="Enter username" />
                        <span class="focus-input100" style="color: red;"><?php if(!empty($error['username'])) echo $error['username']?></span>

                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass"
                            value="<?php if(!empty($pass)) echo $pass ?>" placeholder="Enter password" />
                        <span class="focus-input100" style="color: red;"><?php if(!empty($error['pass'])) echo $error['pass']?></span>
                    </div>
                    <div class="flex-sb-m w-full p-b-30">
                    <br><br>
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" />
                            <label class="label-checkbox100" for="ckb1"> Remember me </label>
                        </div>

                        <div>
                            <a href="#" class="txt1"> Forgot Password? </a>
                        </div>
                    </div>


                    <div style="margin-top:10px;"class="container-login100-form-btn">
                        <input type="submit" name="btn-submit"class="login100-form-btn"value="Login"id="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>