<?php
	include './connect/conDB.php';
	// kiểm tra đăng nhập chưa
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}
	// Lấy session cart
	if(isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
	}
	// Set total_price từ cart để insert vào mysql
	$total_price = 0;
	foreach($cart as $value){
		$total_price += $value['price'] * $value['quantity'];
	}
	// Lấy các thông tin từ forrm
	if(isset($_POST['name'])){
		$id_user = $user['id'];
		$total = $total_price;
		$address_ship = $_POST['address_ship'];
		$phone = $_POST['phone'];
		$note = $_POST['note'];
		// validate form
		$error = [];
		if($address_ship == ''){
			$error['address'] = "You do not enter an address";
		}
		if($phone == ''){
			$error['phone'] = "You did not enter a phone number";
		}
		else{
			// insert các thông tin vào bảng orders trong mysql
			$insert = mysqli_query($conn, "INSERT INTO orders(id_user,total_price,address_ship,phone,note) VALUES ('$id_user','$total','$address_ship','$phone','$note')");
			if($insert){
				// Lấy thông tin từ cart qua hàm mysqli_insert_id để lấy name và image từ cart
				$id_order = mysqli_insert_id($conn);
				// insert vào bảng order_detail
				foreach($cart as $value){
					$name = $value['name'];
					$image = $value['image'];
					$check = mysqli_query($conn, "INSERT INTO order_detail(id_order,id_product,price,quantity,image,name) VALUES ('$id_order','$value[id]','$value[price]','$value[quantity]','$image','$name')");
					var_dump($check);
				}
				unset($_SESSION['cart']);
				header("Location: thank.php");
			}
		}
		
	}
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Omato Market</title>
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./customer/srccc/css/check-out.css">
	<link rel="stylesheet" href="./customer/srccc/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./customer/srccc/bootstrap4.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.theme.default.min.css">
	<link rel="icon" href="./customer/images/logo-page.png">
    <style>

    </style>
</head>
<body>
    <?php include 'header.php'?>
    
    <div class="nav-bar">
        <div class="container1">
            <div class="row">
                <div class="left col-lg-6">
                    <p>Check Out</p>
                </div>
                <div class="right col-lg-6">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a href="check-out.php">Check Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
	<?php if(isset($_SESSION['user'])){ ?>
		<div class="check-out">
			<div class="container1">  
				<div class="row">
					<div class="col-lg-7">
						<div class="container">
							<form method="post">
								<h3 style="padding-top: 20px">Billing Address</h3>
								<label for="fname"><i class="fa fa-user"></i> Full Name</label>
								<input type="text" id="fname" name="name" value="<?php echo $user['name']?>">
								<label for="email"><i class="fa fa-envelope"></i> Email</label>
								<input type="text" id="email" name="email" value="<?php echo $user['email']?>">
								<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
								<input type="text" id="adr" name="address_ship" placeholder="Address">
								<?php if(isset($error["address"])){ ?>
									<p style="color:red">
										<?php echo $error["address"]?>
									</p>
								<?php } ?>
								<label for="city"><i class="fa fa-phone" aria-hidden="true"></i> Phone</label>
								<input type="text" id="city" name="phone" placeholder="Phone">
								<?php if(isset($error["phone"])){ ?>
									<p style="color:red">
										<?php echo $error["phone"]?>
									</p>
								<?php } ?>
								<label for="city"><i class="fa fa-commenting" aria-hidden="true"></i> Note</label>
								<textarea name="note" id="input" class="form-control" rows="3" placeholder="Note..."></textarea>
								<input type="submit" value="Continue to checkout" class="btn">
							</form>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="container">
							<h4 style="padding-top: 20px">Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo count($cart)?></b></span></h4>
							<?php foreach($cart as $key => $value ){ ?>
								<p><a ><?php echo $value['name']?> x <?php echo $value['quantity']?></a> <span class="price">$<?php echo $value['price'] * $value['quantity'] ?></span></p>
							<?php } ?>
							<hr>
							<p>Total <span class="price" style="color:black"><b>$<?php echo $total_price ?></b></span></p>
						</div>
					</div>
				</div>
			</div>  
    	</div>
	<?php }else{ ?>
		<h1 class="text-center" style="padding-top: 50px; margin-bottom: 100px">You are not logged in <span><a href="login.php?action=check-out">Login Now</a></span></h1>
	<?php } ?>
    

    <!-- footer1 -->
    <div class="footer1">
		<div class="container1">
			<div class="row">
				<div class="col-lg-3 col-sm-5 col-8">
					<p class="p5">CONTACTS</p>
					<p class="p6">8-100-9000-300</p>
					<p class="p6">24 Oak,Abohar punjab</p>
					<p class="p6">Usa,152122</p>
					<p class="p6">Company@gmail.com</p>
					<a href="#" class="mxh"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<a href="#" class="mxh"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					<a href="#" class="mxh"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
					<a href="#" class="mxh"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
				</div>
				<div class="col-lg-2 col-sm-4 col-4">
					<p class="p5">OUR COMPANY</p>
					<p class="p6">Our Blog</p>
					<p class="p6">Search Page</p>
					<p class="p6">About Us</p>
					<p class="p6">Contact Us</p>
					<p class="p6">Collections</p>
					<p class="p6">Catalog Page</p>
				</div>
				<div class="col-lg-2 col-sm-3 col-8">
					<p class="p5">INFORMATIONS</p>
					<p class="p6">privancy</p>
					<p class="p6">FAQs</p>
					<p class="p6">Login page</p>
					<p class="p6">Term of use</p>
				</div>
				<div class="col-lg-2 col-sm-5 col-4">
					<p class="p5">CATEGORIES</p>
					<p class="p6">Fruits</p>
					<p class="p6">Juice</p>
					<p class="p6">Vegetables</p>
					<p class="p6">Other Products</p>
					<p class="p6">Vegetables</p>
					<p class="p6">Other Products</p>
				</div>
				<div class="col-lg-3 col-sm-4 col-12">
					<p class="p5">@OOMATO MARKET</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-sm-4 col-2 img-ft1">
								<img src="./customer/images/ft/ftm1.jpg">
							</div>
							<div class="col-lg-4 col-sm-4 col-2 img-ft1">
								<img src="./customer/images/ft/ftm2.jpg">
							</div>
							<div class="col-lg-4 col-sm-4 col-2 img-ft1">
								<img src="./customer/images/ft/ftm3.jpg">
							</div>
							<div class="col-lg-4 col-sm-4 col-2 img-ft1">
								<img src="./customer/images/ft/ftm4.jpg">
							</div>
							<div class="col-lg-4 col-sm-4 col-2 img-ft1">
								<img src="./customer/images/ft/ftm5.jpg">
							</div>
							<div class="col-lg-4 col-sm-4 col-2 img-ft1">
								<img src="./customer/images/ft/ftm6.jpg">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- footer2 -->
	<footer class="footer2 d-none d-lg-block">
		<div class="container1">
			<div class="row">
				<div class="col-lg-5 p7">
					<p class="p8">2020 all rights reserved.Power by Madbrains</p>
				</div>
				<div class="col-lg-2 text-center back-top">
					<i class="fa fa-angle-up up" aria-hidden="true"></i>
				</div>
				<div class="col-lg-5 text-right logo-ft">
					<img src="./customer/images/ft/master card.png">
					<img src="./customer/images/ft/visa.png">
					<img src="./customer/images/ft/paypal.png">
					<img src="./customer/images/ft/citi.png">
				</div>
			</div>
		</div>
	</footer>
<!-- script validate js -->
<script src="./customer/srccc/js/jquery-3.5.1.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./customer/srccc/js/jquery.validate.min.js"></script>
<script src="./customer/srccc/js/btl.js"></script>
<script src="./customer/srccc/OwlCarousel/dist/owl.carousel.min.js"></script>
</body>
</html>