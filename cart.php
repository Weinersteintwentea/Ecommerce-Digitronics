<?php 
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ecommerce Store</title>


<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<link rel="stylesheet" href="styles/style.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>
<body>
	<div id="top"> <!--Top Bar Start-->	
		<div class="container"> <!--Container Start-->
			<div class="col-md-6 offer"><!-- Start col-md-6 offer-->
				<a href="#" class="btn btn-success btn-sm">
					<?php 
					if(!isset($_SESSION['customer_email'])){
						echo "Welcome Guest";
					}else {
						echo "Welcome: " .$_SESSION['customer_email'] . "";
					}
					?>
				</a>

				<a href="#">Shopping Cart Total Price: Rs. <?php totalPrice(); ?>, Total Item <?php item(); ?></a>
				
			</div> <!--col-md-6 offer End-->
			
			<div class="col-md-6">
				<ul class="menu">
					<li>
						<a href="customer_registration.php"> Register</a>
					</li>
					<li>
						<?php 
						if (!isset($_SESSION['customer_email'])) {
							echo "<a href='checkout.php'>My Account</a>";
						}else{
							echo "<a href='customer/my_account.php?my_order'>My Account</a>";
						}
						?>
					</li>
					<li>
						<a href="cart.php"> Go to Cart</a>
					</li>
					<li>
						<?php 
						if(!isset($_SESSION['customer_email'])){
							echo "<a href='checkout.php'>Login</a>";
						}else{
							echo "<a href='logout.php'>Logout</a>";
						}
						?>
					</li>
				</ul>
			</div>

		</div> <!--Container End-->
	</div> <!--Top Bar End-->

	<div class="navbar navbar-default" id="navbar"> <!--navbar navbar-default start-->
		<div class="container">
			<div class="navbar-header"> <!--navbar-header start-->
				<a class="navbar-brand home" href="index.php">
					<img src="images/logo.PNG" alt="Digitronics" class="hidden-xs" width="70" height="60">
					<img src="images/logo.PNG" alt="Digitronics" class="visible-xs" width="70" height="60">
				</a>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
					<span class="sr-only">Toggle Navigation</span>
					<i class="fa fa-align-justify"></i>
				</button>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
					<span class="sr-only"></span>
					<i class="fa fa-search"></i>
				</button>

			</div> <!--navbar-header End-->

			<div class="navbar-collapse collapse" id="navigation"> <!--navbar-collapse start-->
				<div class="padding-nav"> <!--padding-nav start-->
					<ul class="nav navbar-nav navbar-left">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="shop.php">Shop</a>
						</li>
						<li>
							<?php 
							if (!isset($_SESSION['customer_email'])) {
								echo "<a href='checkout.php'>My Account</a>";
							}else{
								echo "<a href='customer/my_account.php?my_order'>My Account</a>";
							}
							?>
						</li>
						<li class="active">
							<a href="cart.php">Shopping Cart</a>
						</li>
						<li>
							<a href="contactus.php">Contact Us</a>
						</li>
					</ul>
				</div> <!--padding-nav End-->
				<a href="cart.php" class="btn btn-primary navbar-btn right">
					<i class="fa fa-shopping-cart"></i>
					<span><?php item(); ?> items in cart</span>
				</a>

				<div class="navbar-collapse collapse right"> <!--navbar-collapse-right Start-->
					<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
						<span class="sr-only">Toggle Search</span>
						<i class="fa fa-search"></i>
					</button>
				</div> <!--navbar-collapse-right End-->
				
				<div class="collapse clearfix" id="search"> <!--collapse clearfix Start-->
					<form class="navbar-form" method="get" action="shop.php">
						<div class="input-group">
							<input type="text" name="user_query" placeholder="Search" class="form-control" required="">
							<span class="input-group-btn">
								<button type="submit" value="Search" name="search" class="btn btn-primary">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
				</div> <!--collapse clearfix End-->
			</div> <!--navbar-collapse End-->
		


		</div> 

		
	</div> <!--navbar navbar-default End-->


<div id="content"> <!-- content start -->
	<div class="container"> <!--container start-->
		<div class="col-md-12"><!--col-md-12 start-->
			<ul class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li>Cart</li>
			</ul>
		</div><!--col-md-12 End-->
		<div class="col-md-9" id="cart"> <!-- col-md-9 Start -->
			<div class="box">
				<form action="cart.php" method="post" enctype="multipart-form-data">

					<h1>Shopping Cart</h1>
					<?php 
					$ip_add=getUserIp();
					$select_cart="select * from cart where ip_add='$ip_add' ";
					$run_cart=mysqli_query($con,$select_cart);
					$count=mysqli_num_rows($run_cart);
					?>
					<p class="text-muted">Currently You have <?php echo $count ?> item(s) in your cart</p>
					<div class="table-responsive"><!-- table-responsive Start -->
						<table class="table">
							<thead>
								<tr>
									<th colspan="2">Product</th>
									<th>Quantity</th>
									<th>Unit-Price</th>
									<th>Size</th>
									<th colspan="1">Delete</th>
									<th colspan="1">Sub-Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$total=0; 
								while ($row=mysqli_fetch_array($run_cart)) {
									$pro_id=$row['p_id'];
									$pro_size=$row['size'];
									$pro_qty=$row['qty'];
									$get_product="select * from products where product_id='$pro_id' ";
									$run_pro=mysqli_query($con,$get_product);
									while ($row=mysqli_fetch_array($run_pro)) {
										$p_title=$row['product_title'];
										$p_img1=$row['product_img1'];	
										$p_price=$row['product_price'];	
										$sub_total=$row['product_price']*$pro_qty;
										$total += $sub_total; //$total=$total + $sub_total;	
								?>
								<tr>
									<td><img src="admin_area/product_images/<?php echo $p_img1 ?>"></td>
									<td><?php echo $p_title ?></td>
									<td><?php echo $pro_qty ?></td>
									<td>Rs.<?php echo $p_price ?></td>
									<td><?php echo $pro_size ?></td>
									<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
									<td>Rs.<?php echo $sub_total ?></td>
								</tr>
								<?php } } ?>
							</tfoot>
						</table>
					</div> <!-- table-responsive End -->
					
					<div class="box-footer">
						<div class="pull-left"><!-- pull-left Start -->
							<h4>Total Price</h4>
						</div><!-- pull-left End -->
						<div class="pull-right"><!-- pull-right Start -->
							<h4>Rs.<?php echo $total ?></h4>
						</div> <!-- pull-right End -->
					</div>
					<div class="box-footer">
						<div class="pull-left"><!-- pull-left Start -->
							<a href="index.php" class="btn btn-default">
								<i class="fa fa-chevron-left"></i> Continue Shopping
							</a>
						</div><!-- pull-left End -->
						<div class="pull-right"><!-- pull-right Start -->
							<button class="btn btn-default" type="submit" name="update" value="Update Cart">
								<i class="fa fa-refresh"></i> Update Cart
							</button>
							<a href="checkout.php" class="btn btn-primary">
								Proceed to Checkout <i class="fa fa-chevron-right"></i>
							</a>
						</div> <!-- pull-right End -->
					</div>
				</form>
			</div>

			<?php 
			function update_cart(){
				global $con;
				if (isset($_POST['update'])) {
					foreach ($_POST['remove'] as $remove_id) {
						$delete_product="delete from cart where p_id='$remove_id' ";
						$run_del=mysqli_query($con,$delete_product);
						if ($run_del) {
							echo "<script>window.open('cart.php','_self')</script>";
						}
					}
				}
			}
			echo @$up_cart=update_cart();
			?>
			<div id="row same-height-row"> <!--row same-height-row Start -->
		<div class="col-md-3 col-sm-6"> <!-- col-md-3 col-sm-6 Start -->
			<div class="box same-height headline"> <!-- box same-height headline Start -->
				<h3 class="text-center">You May Also Like These Products <i class='fas fa-hand-point-right' style='font-size:24px;color:#696969'></i></h3>
			</div><!-- box same-height headline End -->
		</div><!-- col-md-3 col-sm-6 Start -->
		<?php 
		$get_product="select * from products order by 1 LIMIT 0,3";
		$run_product=mysqli_query($con,$get_product);
		while ($row=mysqli_fetch_array($run_product)) {
			$pro_id=$row['product_id'];
			$product_title=$row['product_title'];
			$product_price=$row['product_price'];
			$product_img1=$row['product_img1'];
			echo "
			<div class='center-responsive col-md-3 col-sm-6'>
			<div class='product same-height'>
			<a href='details.php?pro_id=$pro_id'>
			<img src='admin_area/product_images/$product_img1' class='img-responsive'>
			</a>
			<div class='text'>
			<h3><a href='details.php?pro_id=$pro_id'>$product_title</a></h3>
			<p class='price'>$product_price</p>
			</div>
			</div>
			</div>
			";
		}
		?>
			</div> <!-- row same-height-row End -->
		</div> <!-- col-md-9 End -->

		<div class="col-md-3"> <!-- col-md-3 Start -->
			<div class="box" id="order-summary">
				<div class="box-header">
					<h3>Order Summary</h3>
				</div>
				<p class="text-muted">
					Shipping and additional costs are calculated based on the value you have entered
				</p>
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<td>Order Sub-Total</td>
								<th>Rs.<?php echo $total ?></th>
							</tr>
							<tr>
								<td>Shipping and handling</td>
								<td>Rs.0</td>
							</tr>
							<tr>
								<td>Tax</td>
								<td>Rs.0</td>
							</tr>
							<tr class="total">
								<td>Total</td>
								<th>Rs.<?php echo $total ?></th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- col-md-3 End -->
		

		</div> <!--container End-->
</div> <!-- content End -->

<!--Footer Start-->
<?php 
include("includes/footer.php")
 ?>
<!--Footer End-->


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>