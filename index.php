<?php 
	include './connect/conDB.php';
	$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);
	$select_sale_price = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description, product.created_at , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id WHERE product.sale_price > 0 ORDER BY product.created_at DESC LIMIT 6");
	$select_pro_new = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id ORDER BY product.created_at DESC LIMIT 6");
	$select_seking_pro = mysqli_query($conn,"SELECT SUM(order_detail.quantity) as 'quantity' , product.* ,category.name as 'category' FROM order_detail JOIN product on order_detail.id_product = product.id JOIN category ON category.id = product.category_id GROUP BY order_detail.id_product ORDER BY quantity DESC LIMIT 6");
	$select_fruit = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id WHERE product.category_id = '1' ORDER BY product.created_at DESC LIMIT 6");
	$select_juices = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id WHERE product.category_id = '2' ORDER BY product.created_at DESC LIMIT 6");

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Omato Market</title>
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="./srccc/css/menu.css"> -->
    <link rel="stylesheet" href="./customer/srccc/css/menu.css">
	<link rel="stylesheet" href="./customer/srccc/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./customer/srccc/bootstrap4.5/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="./srccc/css/menu.css"> -->
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.theme.default.min.css">
	<link rel="icon" href="./customer/images/logo-page.png">
</head>

<body>
	
	<?php include 'header.php'?>

	<!-- Banner1 -->
	<div class="banner1">
		<img src="./customer/images/banner/tomatoleaves-1920x560.jpg">
		<div class="text">
			<p class="col-lg-12 col-sm-12 p1">Welcome to Oomato market</p>
			<a href="" class="col-lg-12 col-sm-12 a1">Always best Fruits For everyone</a>
			<p class="col-lg-12 col-sm-12 p1" style="padding-bottom: 10px;">Anytime - Anywhere</p>
			<a href="" title="shop now" class="a2 text-center">Shop now</a>
		</div>
	</div>


	<!-- title1 -->
	<div class="item1 container-fluid">
		<div class="row">
			<div class="col-lg-2 d-none d-lg-block">
				<img src="./customer/images/title/titlem3.jpg" class="card-img">
			</div>
			<div class="col-lg-9 pd1">
				<div class="owl-carousel">
					<?php foreach ($select_seking_pro as $key => $value){?>
						<div class="items">
							<img src="./uploads/<?php echo $value['image'] ?>" alt="">
							<div class="bg">
								<a href="./detail.php?id=<?php echo $value['id'] ?>">
									<p class="p2"><?php echo $value['name'] ?></p>
									<p class="p3"><?php echo $value['category']?></p>
									<p class="p4">
										<?php if($value['sale_price'] > 0){ ?>		
											<span>$<?php echo $value['sale_price']?></span>
											<span style="color: red; padding-left: 10px; font-size: 15px"><del>$<?php echo $value['price']?></del></span>
										<?php }else{ ?>
											$<?php echo $value['price']?>
										<?php } ?>
									</p>
								</a>
							</div>
							<i class="fa fa-heart-o heart" aria-hidden="true"></i>
							<div class="atc1">
								<a href="cart.php?id=<?php echo $value['id']?>" style="color: white;">ADD TO CART <span class="plus">+</span></a>
							</div>
							<div class="bonus">
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div> 

	<!-- title3 -->
	<div class="item1 container-fluid">
		<div class="row">
			<div class="col-lg-2 d-none d-lg-block">
				<img src="./customer/images/title/titlem3.jpg" class="card-img">
			</div>
			<div class="col-lg-9 pd1">
				<div class="owl-carousel">
					<?php foreach ($select_sale_price as $key => $value){?>
						<div class="items">
							<img src="./uploads/<?php echo $value['image'] ?>" alt="">
							<div class="bg">
								<a href="./detail.php?id=<?php echo $value['id'] ?>">
									<p class="p2"><?php echo $value['name'] ?></p>
									<p class="p3"><?php echo $value['category']?></p>
									<p class="p4">
										<?php if($value['sale_price'] > 0){ ?>		
											<span>$<?php echo $value['sale_price']?></span>
											<span style="color: red; padding-left: 10px; font-size: 15px"><del>$<?php echo $value['price']?></del></span>
										<?php }else{ ?>
											$<?php echo $value['price']?>
										<?php } ?>
									</p>
								</a>
							</div>
							<i class="fa fa-heart-o heart" aria-hidden="true"></i>
							<div class="atc1">
								<a href="cart.php?id=<?php echo $value['id']?>" style="color: white;">ADD TO CART <span class="plus">+</span></a>
							</div>
							<div class="bonus">
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>


	<!-- Banner2 -->
	<div class="banner2 mt-4">
		<div class="container1">
			<img src="./customer/images/banner/banner-home.jpg" class="card-img mt-0 mt-lg-5">
		</div>
	</div>


	<!-- title4 -->
	<div class="item4 container-fluid">
		<div class="row">
			<div class="col-lg-2 d-none d-lg-block">
				<img src="./customer/images/title/titlem4.jpg" class="card-img">
			</div>
			<div class="col-lg-9 pd1">
				<div class="owl-carousel">
					<?php foreach ($select_pro_new as $key => $value){?>
						<div class="items">
							<img src="./uploads/<?php echo $value['image'] ?>" alt="">
							<div class="bg">
								<a href="./detail.php?id=<?php echo $value['id'] ?>">
									<p class="p2"><?php echo $value['name'] ?></p>
									<p class="p3"><?php echo $value['category']?></p>
									<p class="p4">
										<?php if($value['sale_price'] > 0){ ?>		
											<span>$<?php echo $value['sale_price']?></span>
											<span style="color: red; padding-left: 10px; font-size: 15px"><del>$<?php echo $value['price']?></del></span>
										<?php }else{ ?>
											$<?php echo $value['price']?>
										<?php } ?>
									</p>
								</a>
							</div>
							<i class="fa fa-heart-o heart" aria-hidden="true"></i>
							<div class="atc1">
								<a href="cart.php?id=<?php echo $value['id']?>" style="color: white;">ADD TO CART <span class="plus">+</span></a>
							</div>
							<div class="bonus">
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>


	<!-- title5 -->
	<div class="item5 container-fluid">
		<div class="row">
			<div class="col-lg-2 d-none d-lg-block">
				<img src="./customer/images/title/titlem5.jpg" class="card-img">
			</div>
			<div class="col-lg-9 pd1">
				<div class="owl-carousel">
					<?php foreach ($select_juices as $key => $value){?>
						<div class="items">
							<img src="./uploads/<?php echo $value['image'] ?>" alt="">
							<div class="bg">
								<a href="./detail.php?id=<?php echo $value['id'] ?>">
									<p class="p2"><?php echo $value['name'] ?></p>
									<p class="p3"><?php echo $value['category']?></p>
									<p class="p4">
										<?php if($value['sale_price'] > 0){ ?>		
											<span>$<?php echo $value['sale_price']?></span>
											<span style="color: red; padding-left: 10px; font-size: 15px"><del>$<?php echo $value['price']?></del></span>
										<?php }else{ ?>
											$<?php echo $value['price']?>
										<?php } ?>
									</p>
								</a>
							</div>
							<i class="fa fa-heart-o heart" aria-hidden="true"></i>
							<div class="atc1">
								<a href="cart.php?id=<?php echo $value['id']?>" style="color: white;">ADD TO CART <span class="plus">+</span></a>
							</div>
							<div class="bonus">
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<!-- blog -->
	<div class="blog">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 d-none d-lg-block">
					<img src="./customer/images/title/titlem7.jpg" class="card-img">
				</div>
				<div class="col-lg-10 col-sm-12 col-12">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-sm-6 col-6 item7">
								<img src="./customer/images/product/sphv1.jpg" class="img-log card-img">
								<p class="b1">27 March 2018</p>
								<p class="b2">Personalized <br> and targets conversations</p>
								<p class="b3">Read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></p>
							</div>
							<div class="col-lg-3 d-none d-lg-block item7 item8">
								<img src="./customer/images/product/sphv2.jpg" class="img-log card-img">
								<p class="b1">27 March 2018</p>
								<p class="b2">Personalized <br> and targets conversations</p>
							</div>
							<div class="col-lg-3 col-sm-6 col-6 item7">
								<img src="./customer/images/product/sphv3.jpg" class="img-log card-img">
								<p class="b1">27 March 2018</p>
								<p class="b2">Personalized <br> and targets conversations</p>
								<p class="b3">Read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


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