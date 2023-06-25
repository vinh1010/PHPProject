<?php 
    include './connect/conDB.php';
	// kiểm tea $_SESSION['cart']tồn tại hay không
    if(isset($_SESSION['cart'])){
		// nếu tồn tại gán hàm cart
        $cart = $_SESSION['cart'];
    }
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Omato Market</title>
	<link rel="stylesheet"
		href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./customer/srccc/css/cart.css">
	<link rel="stylesheet" href="./customer/srccc/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./customer/srccc/bootstrap4.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="./customer/srccc/OwlCarousel/dist/assets/owl.theme.default.min.css">
	<link rel="icon" href="./customer/images/logo-page.png">
	<style>
		button {
			border: none;
		}
	</style>
</head>

<body>

	<?php include 'header.php'?>
	<div class="nav-bar ">
		<div class="container1">
			<div class="row">
				<div class="left col-lg-6">
					<p>Cart</p>
				</div>
				<div class="right col-lg-6">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><i class="fa fa-angle-right" aria-hidden="true" style="padding: 0px 10px;"></i></li>
						<li><a href="view-cart.php">Cart</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php if(empty($_SESSION['cart'])){ ?>
	<h1 class="text-center" style="padding-top: 50px; margin-bottom: 100px">Chưa có sản phẩm trong giỏ hàng</h1>
	<?php }else{ ?>
	<div class="container1" style="padding-top: 50px; margin-bottom: 100px">
		<table class="table table-bordered table-hover" style="font-size: 14px">
			<thead>
				<tr>
					<th style="width: 5%">Id</th>
					<th style="width: 20%">Image</th>
					<th>Name</th>
					<th>Price</th>
					<th style="width: 10%">Quantity</th>
					<th>Money</th>
					<th>Tools</th>
				</tr>
			</thead>
			<tbody>
				<?php $total_price = 0; ?>
				<?php foreach($cart as $key => $value ){ 
                        $total_price += ($value['price'] * $value['quantity']);
                    ?>
				<tr>
					<form action="cart.php">

						<input type="hidden" value="update" name="action">
						<td style="padding-top: 50px">
							<?php echo $key ?>
						</td>
						<td><img src="./uploads/<?php echo $value['image'] ?>" alt="" width="80%"></td>
						<td style="padding-top: 50px"><?php echo $value['name']?></td>
						<td style="padding-top: 50px">$
							<?php echo $value['price'] ?>
						</td>
						<!-- nếu thay đổi quantity form sẽ nhận value của input rồi thay đổi sau khi nhấn update -->
						<td style="padding-top: 50px"><input type="number" name="quantity"
								value="<?php echo $value['quantity'] ?>" width="10%"></td>
						<input type="hidden" name="id" value="<?php echo $value['id'] ?>">
						<td style="padding-top: 50px">$
							<?php echo $value['price'] * $value['quantity'] ?>
						</td>
						<td style="padding-top: 50px">
							<button type="submit"><i class="fa fa-pencil-square text-info" style="font-size: 20px"
									aria-hidden="true"></i></button>
					</form>
					<!-- acction = delete -->
					<a href="cart.php?id=<?php echo $value['id'] ?>&action=delete"><i class="fa fa-trash text-danger"
							style="font-size: 20px" aria-hidden="true"></i></a>
					</td>
				</tr>
				<?php } ?>

			</tbody>
			<tbody>
				<tr>
					<td style="font-weight: bold;" class="" colspan="5">Total Price</td>
					<td style="font-weight: bold;" colspan="2">$
						<?php echo $total_price ?>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="check-out container1">
			<a href="check-out.php">Check Out</a>
		</div>
	</div>
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


	<!-- js -->
	<script src="./customer/srccc/js/jquery-3.5.1.min.js"></script>
	<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./customer/srccc/js/jquery.validate.min.js"></script>
	<script src="./customer/srccc/js/btl.js"></script>
	<script src="./customer/srccc/OwlCarousel/dist/owl.carousel.min.js"></script>

</body>