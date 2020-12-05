<?php 
session_start();
if(!isset($_SESSION['customer_email'])){
	echo "<script>window.open('../checkout.php','_self')</script>";
}else{
include("includes/db.php");
include("functions/functions.php");
if (isset($_GET['order_id'])) {
	$order_id=$_GET['order_id'];
}
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

				<a href="#">Shopping Cart Total Price: INR 100, Total Item 2</a>
				
			</div> <!--col-md-6 offer End-->
			
			<div class="col-md-6">
				<ul class="menu">
					<li>
						<a href="../customer_registration.php"> Register</a>
					</li>
					<li>
						<a href="my_account.php"> My Account</a>
					</li>
					<li>
						<a href="../cart.php"> Go to Cart</a>
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
							<a href="../index.php">Home</a>
						</li>
						<li>
							<a href="../shop.php">Shop</a>
						</li>
						<li  class="active">
							<a href="my_account.php">My Account</a>
						</li>
						<li>
							<a href="../cart.php">Shopping Cart</a>
						</li>
						<li>
							<a href="../about.php">About Us</a>
						</li>
						<li>
							<a href="../services.php">Services</a>
						</li>
						<li>
							<a href="../contactus.php">Contact Us</a>
						</li>
					</ul>
				</div> <!--padding-nav End-->
				<a href="cart.php" class="btn btn-primary navbar-btn right">
					<i class="fa fa-shopping-cart"></i>
					<span>4 items in cart</span>
				</a>

				<div class="navbar-collapse collapse right"> <!--navbar-collapse-right Start-->
					<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
						<span class="sr-only">Toggle Search</span>
						<i class="fa fa-search"></i>
					</button>
				</div> <!--navbar-collapse-right End-->
				
				<div class="collapse clearfix" id="search"> <!--collapse clearfix Start-->
					<form class="navbar-form" method="get" action="result.php">
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
				<li><a href="../index.php">Home</a></li>
				<li>My Account</li>
			</ul>
		</div><!--col-md-12 End-->
		<div class="col-md-3"><!--col-md-3 Start-->
			<?php
			include("includes/sidebar.php");
			?>
		</div><!--col-md-3 End-->
		<div class="col-md-9">
			<div class="box">
				<h1 align="center">Please confirm your payment</h1>
				<form action="confirm.php?update_id=<?php echo $order_id ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Invoice Number</label>
						<input type="text" class="form-control" name="invoice_number" required="">
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control" name="amount" required="">
					</div>
					<div class="form-group">
						<label>Select Payment Mode</label>
						<select class="form-control" name="payment_mode">
							<option>Bank Transfer</option>
							<option>Paypal</option>
							<option>PayuMoney</option>
							<option>Paytm</option>
						</select>
					</div>
					<div class="form-group">
						<label>Transaction Number</label>
						<input type="text" class="form-control" name="trfr_number" required="">
					</div>
					<div class="form-group">
						<label>Payment Date</label>
						<input type="date" class="form-control" name="date" required="">
					</div>
					<div class="text-center">
						<button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">
							Confirm Payment
						</button>
					</div>
				</form>
				<?php 
				if (isset($_POST['confirm_payment'])) {
					$update_id=$_GET['update_id'];
					$invoice_number=$_POST['invoice_number'];
					$amount=$_POST['amount'];
					$payment=$_POST['payment_mode'];
					$trfr_number=$_POST['trfr_number'];
					$date=$_POST['date'];
					$invoice_no=$_POST['update_id'];
					$complete="complete";
					$insert="insert into payments (invoice_id,amount,payment_mode,ref_no,payment_date) values ('$invoice_number','$amount','$payment','$trfr_number','$date')";
					$run_insert=mysqli_query($con,$insert);
					$update_q="update customer_order set order_status='$complete' where order_id='$update_id' ";
					$run_insert=mysqli_query($con,$update_q);
					// $update_p="update pending_order set order_status='$complete' where order_id='$update_id' ";
					// $run_insert=mysqli_query($con,$update_p);
					echo "<script>alert('Your order has been received')</script>";
					echo "<script>window.open('my_account.php?order','_self')</script>";

				}
				?>
			</div>
		</div>

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
<?php } ?>