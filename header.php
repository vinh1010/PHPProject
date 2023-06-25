<?php 
	$conn = mysqli_connect('localhost','root','','btl_php');
	mysqli_set_charset($conn,"utf8");
	ob_start();
	include 'function.php';
	$category = mysqli_query($conn,"SELECT * FROM category");

	// print_r($_SESSION['user']);
	// die();

?>
	<!-- phone -->
    <div class="phone d-none d-lg-block">
		<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
		<span>1900 0061</span>
	</div>


	<!-- Welcome -->
	<div class="header-wel">
		<div class="container1">
			<div class="row">
				<div class="col-lg-6 col-sm-12 text-lg-left text-center">
					<p>Welcome to Oomato market online shoping store</p>
				</div>
				<div class="col-lg-6 d-none d-sm-none d-lg-block text-right">
					<span>Store Locations</span>
					<span class="range-wel">|</span>
					<span>Track Your Oder</span>
					<span class="range-wel">|</span>
					<span>US Dollar</span>
					<i class="fa fa-angle-down down-wel" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</div>


	<!-- Logo and search -->
	<div class="header-logo">
		<div class="container1">
			<div class="row">
				<div class="col-lg-2 col-sm-3 col-6">
					<img src="./customer/images/Logo.png" class="card-img">
				</div>
				<div class="col-lg-7 col-sm-9 mt-2 mt-sm-0">
					<form>
						<span class="between3">
							<input type="text" class=""><button type="submit" class="right3"><i class="fa fa-search" aria-hidden="true"></i><span class="range3">Search</span></button>
						</span>
					</form>
				</div>
				<div class="col-lg-3 d-none d-lg-block">
					<a href="" class="cart"><i class="fa fa-heart-o h-a-c" aria-hidden="true"><span class="number">3</span></i></a>
						<?php if(empty($_SESSION['cart'])){ ?>
							<a href="view-cart.php" title="cart" class="cart"><i class="fa fa-shopping-bag h-a-c" aria-hidden="true"><span class="number">0</span></i></a>
						<?php } else { ?>
							<a href="view-cart.php" title="cart" class="cart"><i class="fa fa-shopping-bag h-a-c" aria-hidden="true"><span class="number"><?php echo count($cart) ?></span></i></a>
						<?php } ?>
					
					<?php if(!isset($_SESSION['user'])) { ?>
						<a href="login.php" title="login" style="float: right">
							<button type="button" class="login-only">Login / Sign up</button>
						</a>
					<?php } else { ?>
						<a href="sign-out.php" title="login" style="float: right">
							<button type="button" class="login-only">Sign-Out</button>
						</a>
					<?php } ?>
            	</div>	
			</div>
		</div>
		<div class="container-fluid d-block d-lg-none">
			<div class="row">
				<div class="sol-2">
					<i class="fa fa-th-list pl-3 pl-sm-5 pt-4 pt-sm-3 icon-mn-mb" aria-hidden="true"></i>
				</div>
				<div class="col-10 text-right login-mb">
					<i class="fa fa-heart-o pr-4 pr-sm-5 mhc" aria-hidden="true"></i>
					<a href="" title="cart"><i class="fa fa-shopping-bag pr-4 pr-sm-5 mhc" aria-hidden="true"></i></a>
					<?php if(!isset($_SESSION['user'])) { ?>
						<a href="login.php" title="login">
							<button type="button" class="login-only">Login / Sign up</button>
						</a>
					<?php } else { ?>
						<a href="sign-out.php" title="login">
							<button type="button" class="login-only">Sign-Out</button>
						</a>
					<?php } ?>
				</div>
			</div>			
    	</div>
	</div>
    <!-- menu-mb -->
	<div class="menu-mobile">
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php foreach($category as $value){ ?>
				<li><a href="product.php?id=<?php echo $value['id']?>"><?php echo $value['name'] ?></a></li>
			<?php } ?>
			<li>
				<a href="#" title="" id="page">Pages
					<i class="fa fa-angle-down" aria-hidden="true"></i></a>
				<div class="page-mobile">
					<ul>
						<?php if(!isset($_SESSION['user'])) { ?>
							<li><a href="sign-up.php">Sign up</a></li>
							<li><a href="login.php">Login</a></li>
						<?php }else{ ?>
							<li><a href="sign-up.php">Sign up</a></li>		
						<?php } ?>
						<li><a href="">Oder Tracking</a></li>
					</ul>
				</div>
			</li>
			<li><a href="">Blog</a></li>
			<li><a href="contact-us.html">Contact Us</a></li>
		</ul>
	</div>
	<!-- Menu -->
	<div class="container1">
		<div class="row">
			<nav class="col-lg-10 d-none d-lg-block menu1">
				<ul>
					<li><a href="index.php">Home</a></li>
					<?php foreach($category as $value){ ?>
						<li><a href="product.php?id=<?php echo $value['id']?>"><?php echo $value['name'] ?></a></li>
					<?php } ?>
					<li>
						<a href="" title="pages">Pages
							<i class="fa fa-angle-down" aria-hidden="true"></i>
						</a>
						<div class="page">
							<ul>
								<?php if(!isset($_SESSION['user'])) { ?>
									<li><a href="sign-up.php">Sign up</a></li>
									<li><a href="login.php">Login</a></li>
								<?php }else{ ?>
									<li><a href="sign-up.php">Sign up</a></li>
								<?php } ?>
								<li><a href="">Recovery Password</a></li>
								<li><a href="">Order Tracking</a></li>
							</ul>
						</div>
					</li>
					<li><a href="contact-us.html" title="">Contact Us</a></li>
				</ul>
				<span class="hot">Hot</span>
				<span class="offer">Offer</span>
			</nav>
			<div class="col-lg-2 d-none d-lg-block">
				<button type="button" class="btn btn-outline-success seller" style="padding: 10px 15px;font-size: 13px;">
					Become Seller <i class="fa fa-cloud-upload more4" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>