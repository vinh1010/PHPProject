<?php 
	include './connect/conDB.php';
	if(isset($_GET['id'])){
        $id = $_GET['id'];
        $select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , product.status , product.image , product.description , product.category_id , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id WHERE product.id = $id");
        $select = mysqli_fetch_array($select);
		$id_category = $select['category_id'];
		$category1 = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , product.status , product.image , product.description , product.category_id , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id WHERE product.category_id = $id_category");
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
    <!-- <link rel="stylesheet" href="./srccc/css/menu.css"> -->
    <link rel="stylesheet" href="./customer/srccc/css/detail.css">
	<link rel="stylesheet" href="./customer/srccc/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./customer/srccc/bootstrap4.5/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="./srccc/css/menu.css"> -->
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
                    <p>Product</p>
                </div>
                <div class="right col-lg-6">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a >Product Detail</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="details">
        <div class="container1">
            <div class="row">
                <div class="img col-lg-6">
                    <img src="./uploads/<?php echo $select['image'] ?>" alt="" width="70%">
                </div>
                <div class="text col-lg-6">
					<form action="cart.php" method="GET">
						<ul>
							<li><h3 style="color: black;"><?php echo $select['name']?></h3></li>
							<li class='reviu'>
								<ul >
									<li><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><p>5.0 <span>32 Reviews</span></p></li>
								</ul>
							</li>
							<?php if($select['sale_price'] > 0){ ?>
								<li><p style="color: black;font-weight: bold;">$<?php echo $select['sale_price'] ?> <span style="color: red;font-weight: bold;margin-left: 20px"><strike>$<?php echo $select['price'] ?></strike></span></p></li>
							<?php }else{ ?>
								<li><p style="color: black;font-weight: bold;">$<?php echo $select['price'] ?></p></li>
							<?php } ?>
							<li><p style="color:black">Category <span style="color: #bbbcc1;">: <?php echo $select['category']?></span></p></li>
							<li style="padding-top: 10px;"><?php echo $select['description']?></li>
							<input type="hidden" name="id" value="<?php echo $select['id'] ?>">
							<li style="padding-top: 10px;"><input type="number" value="1" name="quantity"><span><button type="submit" class="add">ADD TO CART <span class="plus">+</span></button></span></li>
							<li class="tag"><p>Tags <span><a href="">Template</a><span><a href="">Fresh</a><span><a href="">Capsicum</a></span></span></span></p></li>
						</ul>
					</form>
                </div>
            </div>
        </div>
    </div>

	<!-- join -->
	<div class="join text-center">
		<img src="./customer/images/banner/banner3.jpg">
		<div class="p-join1">Join our Event & make help us to farmer</div>
		<div class="p-join2 d-none d-lg-block">Over 25,000 User and Farmer trust the martplace</div>
		<div class="join-now">
			<a href="" title="">Join Now</a>
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
					<?php foreach ($category1 as $key => $value){?>
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