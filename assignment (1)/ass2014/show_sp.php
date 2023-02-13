<?php
	// session_start();
	//  unset($_SESSION['username']);
	// if(!isset($_SESSION['is_login'])){
	// 	echo $_SESSION['is_login'];
	// 	header('Location:login.php');
	// }else{
	// 	echo $_SESSION['is_login'];
	// 	header('Location:login.php');
	// }
	// if(isset($_SESSION['username'])){
	// 	header('Location:login.php');
	// }


	require 'connect.php';
	$sql = "SELECT * FROM `asm_2`.`them`";
	$query = $connect -> prepare($sql);
	$query -> execute();
	$list_cat = array();
	while($cat = $query -> fetch(PDO::FETCH_ASSOC)){
		array_push($list_cat,$cat);
	}

	$sql = "SELECT * FROM `asm_2`.`products`";
	$query = $connect -> prepare($sql);
	$query -> execute();
	$list_pro = array();
	while($pro = $query -> fetch(PDO::FETCH_ASSOC)){
		array_push($list_pro, $pro);
	}
	// echo "<pre>";
	// print_r($list_cat);
	// echo "</pre>";
	
	// echo "<pre>";
	// print_r($list_pro);
	// echo "</pre>";

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
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
		<!-- Loading Css -->
		<link rel="stylesheet" href="assets/css/reset.css" />

		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/product.css" />
		<title>Product</title>
		
		<script>
			function deleteee(name){
				return confirm("Bạn có chắc chắn muốn xóa sản phẩm: " + name + " ?");
			}
		</script>
	</head>
	<body>
		<div class="container">
			<div>
				<a href="logout.php">
				<input type="submit"name="is_login"id=""class="card-btn"value="Đăng xuất">
				</a>
			</div>
			<div id="product" class="product">
				<h3 class="product-title">
					<span>all product</span>
				</h3>
				
				<div class="product-list">
				<?php
					foreach($list_pro as $pro){
						?>
							<div class="product-item">
								<div class="card">
									<div class="card-header">
										<img src="img/<?php echo $pro['image']?>" alt="" style = "width:250px; height:150px;" class="img-fluid card-img" />
									</div>
									<div class="card-body">
										<p class="card-title"><?php echo $pro['products_name']?> </p>
										<p class="card-price"><?php echo $pro['price']?></p>
										<p class="card-desc">Category: <span><?php echo $pro['description']?></span></p>
										<button class="card-btn">
											<i class="fa fa-shopping-cart"></i>
											View Detail
										</button>
										<a class="card-btn" href="update.php?id=<?php echo $pro['id_products']?>">Sửa</a>
										<a onclick=" return deleteee('<?php echo $pro['product_name']?>')" class="card-btn" href="delete.php?id=<?php echo $pro['id_products']?>">Xóa</a>
									</div>
								</div>
							</div>
						<?php
					}
				?>
					
					
					</div>
					<a class="card-btn" href="addproduct.php">Thêm sản phẩm</a>
				</div>
			</div>
		</div>
	</body>
</html>
