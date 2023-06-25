<?php
	include './connect/conDB.php';
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$error = [];

		$data = mysqli_query($conn,"SELECT * FROM user WHERE email = '$email' AND role = 'customer'");
		$data = mysqli_fetch_assoc($data);
		if(empty($email)){
			$error['email'] = "You have not entered your email";
		}
		if($data['email'] == $email){
			$checkPass = password_verify($password, $data['password']);
			if($checkPass){
				$_SESSION['user'] = $data;
				if(isset($_GET['action'])){
					$action = $_GET['action'];
					header("Location: ".$action.'.php');
				}
				else{
					header("Location: index.php");
				}
			}
			else{
				$error['password'] = "incorrect password";
			}
		}
		else{
			$error['email'] = "Email is incorrect";
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
    <link rel="stylesheet" href="./customer/srccc/css/login.css">
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
    <div class="nav-bar ">
        <div class="container1">
            <div class="row">
                <div class="left col-lg-6">
                    <p>Login</p>
                </div>
                <div class="right col-lg-6">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a>Page</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- login -->
    <div class="login text-center">
        <h1>Login</h1>
        <p class="p-page">To track your order please enter your Order ID in the box blew "track" buttion. This was given to
            your on your receipt and in confirmations email your should have recevied </p>
    </div>
    <form id="myF" method="POST" action>
        <div class="text"><input type="text" placeholder="Email" id="email" name="email">
		<?php if(isset($error['email'])){ ?>
            <p style="color:red"><?php echo $error["email"]?></p>
        <?php } ?>
        </div>
        <div class="text"><input type="password" placeholder="Password" id="pass" name="password">
        </div>
		<?php if(isset($error['password'])){ ?>
            <p style="color:red"><?php echo $error["password"]?></p>
        <?php } ?>
        <div class="text-left agree">
            <input type="checkbox">Remember me<span class="fogot">Fogot Password?</span>
        </div> 
        <button type="submit" class="button" name="submit">Login</button>

        <div class="text-center login-with-mxh col-lg-12">
            <div class="w-gg">
                <a href="#" title="Đăng nhập bằng Google">Login with Google +</a>
            </div>
            <div class="w-f">
                <a href="#" title="Đăng nhập bằng Facebook">Login with Facebook</a>
            </div>
        </div>

        <p class="text-center p-login">Don't have an account | <a href="sign-up.php" title="Đăng ký" style="cursor: pointer;">Sign up</a></p>
    </form>

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


	<!-- js -->
	<script src="./customer/srccc/js/jquery-3.5.1.min.js"></script>
	<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./customer/srccc/js/jquery.validate.min.js"></script>
	<script src="./customer/srccc/js/btl.js"></script>
	<script src="./customer/srccc/OwlCarousel/dist/owl.carousel.min.js"></script>

</body>