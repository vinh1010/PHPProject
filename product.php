<?php 
	include './connect/conDB.php';
	$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';
		// TH keyword = '' không tồn tại keyword
		// TH không phân trang và keyword = '' = câu lệnh SELECT * FROM
		$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
		product.status , product.image , product.description , category.name AS 'category' FROM product 
		JOIN category ON product.category_id = category.id WHERE product.category_id = $id  AND product.name 
		LIKE '%$keyword%'");
		// Tính page
		$toatal = mysqli_num_rows($select);
		$limit = 6;
		$toatal_page = ceil($toatal / $limit);
		$cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = ($cr_page - 1) * $limit;
		//TH phân trang nhưng keyword = ''
		$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
		product.status , product.image , product.description , category.name AS 'category' FROM product 
		JOIN category ON product.category_id = category.id WHERE product.category_id = $id LIMIT $start,$limit");
		// TH tồn tại keyword và phân trang
		if(isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
			$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
			product.status , product.image , product.description , category.name AS 'category' FROM product 
			JOIN category ON product.category_id = category.id WHERE product.category_id = $id  AND product.name 
			LIKE '%$keyword%' LIMIT $start,$limit");
		}
		// Bộ lọc
		if(isset($_GET['filter'])){
			$filter = $_GET['filter'];
			// Giá giảm dần
			if($filter == 'about-one'){
				$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
				product.status , product.image , product.description , category.name AS 'category' FROM product 
				JOIN category ON product.category_id = category.id WHERE product.category_id = $id AND product.price <= 5 AND product.name 
				LIKE '%$keyword%' LIMIT $start,$limit");
			}
			// Giá tăng dần
			else if($filter == 'about-tow'){
				$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
				product.status , product.image , product.description , category.name AS 'category' FROM product 
				JOIN category ON product.category_id = category.id WHERE product.category_id = $id AND product.price <= 10 AND product.name 
				LIKE '%$keyword%' LIMIT $start,$limit");
			}
			// Tên từ A -> Z
			else if($filter == 'about-three'){
				$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
				product.status , product.image , product.description , category.name AS 'category' FROM product 
				JOIN category ON product.category_id = category.id WHERE product.category_id = $id AND product.price <= 20 AND product.name 
				LIKE '%$keyword%' LIMIT $start,$limit");
			}
			// Tên từ Z -> A
			else{
				$select = mysqli_query($conn,"SELECT product.id , product.name , product.price , product.sale_price , 
				product.status , product.image , product.description , category.name AS 'category' FROM product 
				JOIN category ON product.category_id = category.id WHERE product.category_id = $id AND product.price > 20 AND product.name 
				LIKE '%$keyword%' LIMIT $start,$limit");
			}
		}
		// Lấy tên category
		$get_category = mysqli_query($conn,"SELECT * FROM category WHERE id = $id");
		$get_category = mysqli_fetch_assoc($get_category);
		$list_category = mysqli_query($conn,"SELECT * FROM category");
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
    <link rel="stylesheet" href="./customer/srccc/css/vegetable.css">
	<link rel="stylesheet" href="./customer/srccc/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./customer/srccc/bootstrap4.5/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="./srccc/css/menu.css"> -->
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.theme.default.min.css">
	<link rel="icon" href="./customer/images/logo-page.png">
    <style>
		.check{
      		display: none !important;
    	}
    </style>
</head>

<body>
	
	<?php include 'header.php'?>

    <!-- nav-bar -->
    <div class="nav-bar ">
        <div class="container1">
            <div class="row">
                <div class="left col-lg-6">	
                    <p>Fresh <?php echo $get_category['name'] ?></p>
                </div>
                <div class="right col-lg-6">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
                        <li><a><?php echo $get_category["name"] ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- items -->
    <div class="vegetable container2">
        <div class="row">
            <div class="menu col-lg-3">
                <div class="menu1">
                    <ul style="padding-bottom: 35px">
                        <li style="border: 1px solid #b5b8bf;"><h5>Categories</h5></li>
						<?php foreach($list_category as $value){ ?>
							<li><a href="product.php?id=<?php echo $value['id']?>"><?php echo $value['name']?> <span></span></a></li>
						<?php } ?>
                    </ul>
                </div>
                <div class="menu1" style="margin-top: 50px;">
                    <ul style="padding-bottom: 15px">
                        <li style="border: 1px solid #b5b8bf;"><h5>Filter Price</h5></li>
                        <li><a href="product.php?id=<?php echo $id ?>&filter=about-one">0$ - 5$</a></li>
                        <li><a href="product.php?id=<?php echo $id ?>&filter=about-tow">5$ - 10$</a></li>
                        <li><a href="product.php?id=<?php echo $id ?>&filter=about-three">15$ - 20$</a></li>
                        <li><a href="product.php?id=<?php echo $id ?>&filter=about-four">Bigger 20$</a></li>
                    </ul>
                </div>
            </div>
            <div class="item col-lg-9">
				<form method="GET">
					<div class="shea" >
							<?php if($filter != '') { ?>
								<input type="hidden" name="filter" value="<?php echo $filter ?>">
							<?php } ?>
							<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="text" name="keyword" placeholder="Search your products"><span><button type="submit">Search</button></span>
					</div>
				</form>
                <div class="product" style="margin-bottom: 50px;">
					<div class="row">
						<?php foreach($select as $key => $value){ ?>
							<div class="col-lg-4">
								<div class="items">
									<div class="p-item">
										<img src="./uploads/<?php echo $value['image'] ?>" alt="">
										<div class="bg">
											<a href="./detail.php?id=<?php echo $value['id'] ?>">
												<p class="p2"><?php echo $value['name'] ?></p>
												<p class="p3"><?php echo $value['category'] ?></p>
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
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				
				<div style="text-align: center">
					<ul class="pagination" style="display: inline-block">
						<li class="<?php echo (($cr_page - 1 == 0) ? 'check' : '')?>">
							<a href="product.php?id=<?php echo $id ?>&page=<?php echo $cr_page - 1?>
							<?php echo (($filter != '') ? "&filter=$filter":"")?>
							<?php echo ($keyword != '') ? "&keyword=$keyword" : ''?>">&laquo;</a>
						</li>
						<?php for( $i=1; $i <= $toatal_page ; $i++ ){?>
							<li class="<?php echo (($cr_page  == $i) ? 'active' : '') ?>">
								<a href="product.php?id=<?php echo $id ?>&page=<?php echo $i ?>
								<?php echo (($filter != '') ? "&filter=$filter":"")?>
								<?php echo ($keyword != '') ? "&keyword=$keyword" : ''?>">
								<?php echo $i ?></a>
							</li>
						<?php } ?>
						<li class="<?php echo (($cr_page == $toatal_page) ? 'check' : '')?>">
							<a href="product.php?id=<?php echo $id?>&page=<?php echo $cr_page + 1?>
							<?php echo (($filter != '') ? "&filter=$filter":"")?>
							<?php echo ($keyword != '') ? "&keyword=$keyword" : ''?>">&raquo;</a>
						</li>
					</ul>
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