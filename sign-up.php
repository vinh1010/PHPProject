<?php
    include './connect/conDB.php';
    $errors = [];
    if(isset($_POST['submit'])){
        $name = $_POST['name_us'];
        $email = $_POST['email_us'];
        $password = $_POST['password_us'];
        $cf_pass = $_POST['cfpass_us'];
        
 
        $check_email = mysqli_query($conn,"SELECT * FROM user WHERE role = 'customer'");
        $check_email = mysqli_fetch_assoc($check_email);
        if($check_email['email'] == $email){
            $errors['email'] = "$email already exists please choose another name";
        }
        if(empty($name)){
            $errors['name'] = "You have not entered your name";
        }
        if(empty($email)){
            $errors['email'] = "You have not entered your email";
        }
        if(empty($password)){
            $errors['password'] = "You have not entered your password";
        }
        if($password != $cf_pass){
            $errors['cf_pass'] = "Password incorrect";
        }
        if(empty($errors)){
            $password = password_hash($password,PASSWORD_DEFAULT);
            $query = "INSERT INTO user(name,email,password) VALUES ('$name', '$email' , '$password')";
            $add = mysqli_query($conn, $query);
            header("Location: ./login.php");
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
    <link rel="stylesheet" href="./customer/srccc/css/sign-up.css">
	<link rel="stylesheet" href="./customer/srccc/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./customer/srccc/bootstrap4.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.theme.default.min.css">
	<link rel="icon" href="./customer/images/logo-page.png">
</head>

<body>
    
    <?php include './header.php' ?>

    <div class="nav-bar">
        <div class="container1">
            <div class="row">
                <div class="left col-lg-6">
                    <p>Login</p>
                </div>
                <div class="right col-lg-6">
                    <ul>
                        <li><a href="http://localhost:86/BTL/">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a>Page</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a href="http://localhost:86/BTL/customer/modules/sign-up.php">Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- sign-up -->
    <div class="sign text-center">
        <h1>Sign Up</h1>
        <p class="p-page">To track your order please enter your Order ID in the box blew "track" buttion. This was given
            to your on your receipt and in confirmations email your should have recevied </p>
    </div>
    <form id="myF" method="POST">
        <div class="text"><input type="text" name="name_us" placeholder="Name"></div>
        <?php if(isset($errors['name'])){ ?>
            <p style="color:red"><?php echo $errors["name"]?></p>
        <?php } ?>
        <div class="text"><input type="email" name="email_us" placeholder="Email" ></div>
        <?php if(isset($errors['email'])){ ?>
            <p style="color:red"><?php echo $errors["email"]?></p>
        <?php } ?>
        <div class="text"><input type="password" name="password_us" placeholder="Password" id="pass" ></div>
        <?php if(isset($errors['password'])){ ?>
            <p style="color:red"><?php echo $errors["password"]?></p>
         <?php } ?>
        <div class="text"><input type="password" name="cfpass_us" placeholder="Confirm Password" id="pass"></div>
        <?php if(isset($errors['cf_pass'])){ ?>
            <p style="color:red"><?php echo $errors["cf_pass"]?></p>
        <?php } ?>
        <div class="agree"><input type="checkbox">I agree to <span class="fake-a">Term,Privacy</span> and <span class="fake-a">Fees</span></div>
        <button type="submit" class="button"  name="submit">Sign up</button>
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