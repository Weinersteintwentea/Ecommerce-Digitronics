<div id="footer"> <!-- footer section start -->
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6"><!--col-md-3 col-sm-6 Start-->
				<h4>Pages</h4>
				<ul>
					<li><a href="../cart.php">Shopping Cart</a></li>
					<li><a href="../contactus.php">Contact Us</a></li>
					<li><a href="../shop.php">Shop</a></li>
					<li><a href="my_account.php?my_order">My Account</a></li>
				</ul>
				<hr>
				<h4>User Section</h4>
				<ul>
					<li><a href="../checkout.php">Login</a></li>
					<li><a href="customer_registration.php">Register</a></li>
					<li><a href="my_account.php?my_order">Account</a></li>
					<li><a href="../cart.php">Cart</a></li>
				</ul>
				<hr class="hidden-md hidden-lg hidden-sm">
			</div><!--col-md-3 col-sm-6 End-->
			<div class="col-md-3 col-sm-6"> <!--col-md-3 col-sm-6 Start-->
				<h4>Top Product Categories</h4>
				<ul>
					<?php 
					$get_p_cats="select * from product_categories";
					$run_p_cats=mysqli_query($con,$get_p_cats);
					while ($row_p_cat=mysqli_fetch_array($run_p_cats)) {
						$p_cat_id=$row_p_cat['p_cat_id'];
						$p_cat_title=$row_p_cat['p_cat_title'];
						echo "<li><a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a></li>";
					}
					?>
				</ul>
				<hr class="hidden-md hidden-lg">
			</div> <!--col-md-3 col-sm-6 End-->

			<div class="col-md-3 col-sm-6"> <!--col-md-3 col-sm-6 Start-->
				<h4>Where to Find Us</h4>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.608352138813!2d72.9953733149019!3d19.124829987059872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0!2zMTnCsDA3JzI5LjQiTiA3MsKwNTknNTEuMiJF!5e0!3m2!1sen!2sin!4v1606549552795!5m2!1sen!2sin" width="270" height="200" frameborder="1" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				<br>
				<a href="contactus.php">Go To Contact Us Page</a>
				<hr class="hidden-md hidden-lg">
			</div><!--col-md-3 col-sm-6 End-->
			
			<div class="col-md-3 col-sm-6"> <!--col-md-3 col-sm-6 Start-->
				<h4>Get the news</h4>
				<p class="text-muted">
					Subscribe Here For getting news of Digitronics
				</p>
				<form action="" method="post">
					<div class="input-group">
						<input type="text" name="email" class="form-control">
						<span class="input-group-btn">
							<input type="submit" class="btn btn-default" value="subscribe">
						</span>
					</div>
				</form>
				<br>
				<h4>Stay in Touch</h4>
				<p class="social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-google-plus"></i></a>
					<a href="#"><i class="fa fa-envelope"></i></a>
				</p>
			
			</div><!--col-md-3 col-sm-6 End-->

		</div>
	</div>
</div> <!-- footer section End -->

<div id="copyright"> <!-- copyright section start -->
	<div class="container">
		<div class="col-md-6">
			<p class="pull-left">	&copy; 2020 Team Digitronics
			</p>
		</div>
		<div class="container">
		<div class="col-md-6">
			<p class="pull-right">	Template By: <a href="#">Digitronics.com</a>
			</p>
		</div>
	</div>
</div> <!-- copyright section End -->