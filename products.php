<?php
  session_start();
  include 'api.php';

  if (class_exists('OnlineStore')) {
    if (isset($_SESSION['current_store'])) {
      $store = unserialize($_SESSION['current_store']);
    }
    else {
      $store = new OnlineStore();
    }
    $store->set_inventory();
    $store->process_user_input();
  }
  else {
    echo 'The OnlineStore class is not available';
    $store = NULL;
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet"  href="css/stylesheet.css" />
</head>

<body>
		<div id="header"> <!-- start of header -->
			<div class="wrap">
			<a href="index.php"><img src="images/Logo.png" alt="" style="margin-top:10px"/></a>
    	<span style="float:right">
      <?php
      if (isset($_SESSION['current_user'])) {
			  echo '<a style="color:white" href="myaccount.php">'.$_SESSION['current_user'].'</a> | <a href="logout.php" class="account">Logout</a>';
      } else {
        echo '<a class="account">Login</a>
        |
        <a class="account">Register</a>';
      }
      ?>
      </span>
				<!-- <a href="#"><img src="images/Logo.png" alt="" style="margin-top:10px"/></a> -->
				<!-- <div class="dropdown" style="float:right;margin-top:10px;padding-bottom:10px">
					<a href="#" class="account"><span style="font-size:12px;color:black;margin-left:10px"/>▼</span></a>	<div class="account-content">
						<ul>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Cart</a></li>
							<li><a href="#">My Favourites</a></li>
							<li><a href="#">Log Out</a></li>
						</ul>
					</div>
				</div> -->
				<div id="right-block" style="clear:right;margin-bottom:10px">
					<ul>
						<a href="#" style="color:white"><li class="icon-container dropdown"><img src="images/favourite icon.png" /><span class="icon-pos">0</span></a>
						<!-- <div class="dropdown-content">
							<ul>
								<li>Java <span style="float:right">R600</span></li>
								<li><a href=""><button style="width:100%; height:40px;color:white;background-color: #0497c3;border:none;">View wishlist</button></a></li>
							</ul>
						</div> -->
						</li>
						<a href="checkout.php?phpsessid=<?php echo session_id(); ?>" style="color:white"><li class="icon-container dropdown"><img src="images/cart.png" /><span class="icon-pos"><?php echo $store->get_items_count(); ?></span></a>
							<!-- REGISTRATION POP-UP -->
	<div id="register" class="modal-box">

<div class="box-content">
	<span class="exit">x</span>

	<h1 style="text-align:center;margin-bottom:50px">Register</h1>

	<form action="signup.php" method="POST" class="acc_form">
		<p>First name</p>
		<input required minlength="2" name="firstName" type="text">
		<p>Last name</p>
		<input required minlength="2" name="lastName"ype="text">
		<p>Cellphone</p>
		<input required minlength="9" name="cellphone" type="text">
		<p>Email</p>
		<input required name="email" type="email">
		<p>Password</p>
		<input required minlength="6" name="password" type="password">

		<input name="submit" type="submit" value="Create Account"/>
	</form>

</div>

</div>


<!-- LOGIN POP-UP -->

<div id="login" class="modal-box">

<div class="box-content">
	<span class="exit">x</span>

	<h1 style="text-align:center;margin-bottom:50px">Log In</h1>

	<form action="signin.php" method="POST" class="acc_form">
		<p>Email</p>
		<input name="email" type="email">
		<p>Password</p>
		<input minlength="6" name="password" type="password">

		<input name="submit" type="submit" value="Login"/>
	</form>
</div>
</div>
							<!-- <div class="dropdown-content"> -->
								<!-- <ul>
									<li>Java <span style="float:right">R600</span></li>
									<li>
										<span style="color:#124b75">subtotal</span><span style="float:right">R600</span></a>
									</li>
									<li>
										<a href="#"><button style="width:110px; height:40px;color:white;background-color: #0497c3;border:none;">Cart</button></a>
										<a href="#"><button style="width:110px; height:40px;float: right;color:white;background-color: #0497c3;border:none;">Check out</button></a>
									</li>
								</ul> -->
							<!-- </div> -->
						</li>
					</ul>
				</div>
			</div>
		</div> <!--end header -->

		<div id="nav"> <!-- start nav -->
			<div class="wrap">
			<form action="#" method="#">
				<ul>
					<li>
						<div>
							<input type="text" id="search-field" class="nav-field" placeholder="search for a product" />
							<input type="image" src="images/search.png" style="float:right;width:30px; height:32px; background-color:#0a3558; border:none"/>
						</div>
					</li>
					<li>
						<select class="nav-field" style="border: 1px solid #6489a4">
							<option>All Categories</option>
							</select>
					</li>
					<li>
						<select class="nav-field" style="border: 1px solid #6489a4">
							<option>All Campuses</option>
							</select>
					</li>
				</ul>
			</form>
			</div>
		</div> <!-- end nav -->



		<div id="main" class="wrap"> <!-- start of main -->
        <?php

        if (isset($_GET['login'])) 
				  if($_GET['login'] === 'false') 
            echo '<h2 style="color:red">Please login</h2>';
            
        if (isset($_GET['transaction']))
          if ($_GET['transaction'] === 'success') {
            echo '<h2 style="color:green">Order successful</h2>';
						echo '<h4 style="color:green">Thank you</h4>'; 
          } else {
						echo '<h2 style="color:red">Order unsuccessful</h2>';
						echo '<h4 style="color:red">Items out of stock</h4>'; 
					}

        if (isset($_GET['cart']))
          if ($_GET['cart'] === 'empty')
            echo '<h2 style="color:red">Cart is empty</h2>';
        ?>
				<h2 style="padding: 20px 0px 20px 0px">Products</h2>

					<div 
						id="section_1"
						style="float:left;width:25%;"
					>

					<h3 style="font-weight:normal;text-align: center;background-color: #0098CB; padding: 10px 0px 10px 0px; margin:0px 0px 5px 0px;color: #EAF1F7;">Filter</h3>

						<div style="padding:5%;height:30pxloverflow:hidden">
							<ul class="prodcat">
								<li>
									<h4>Categories</h4>

									<!-- SHOULD BE PROGRAMMATICALLY GENERATED -->

									<ul>
										<li><a href="#">All Categories <span style="float:right">(2)</span></a></li>
										<li><a href="#">Text Books <span style="float:right">(2)</span></a></li>
										<li><a href="#">Computing <span style="float:right">(2)</span></a></li>
										<li><a href="#">Stationary <span style="float:right">(2)</span></a></li>
									</ul>

									<!-- ***************************************** -->

								</li>
								<li>
									<h4>Campuses</h4>
									<ul>

										<!-- SHOULD BE PROGRAMMATICALLY GENERATED -->

										<li><a href="#">All Campuses <span style="float:right">(2)</span></a></li>
										<li><a href="#">Bellville <span style="float:right">(2)</span></a></li>
										<li><a href="#">Cape Town <span style="float:right">(2)</span></a></li>
										<li><a href="#">Mowbray <span style="float:right">(2)</span></a></li>

										<!-- ***************************************** -->
								</li>
							</ul>
						</div>
				</div>
					<div id="section_2" style="width:72%;height:300px;float:right">

						<!-- SHOULD BE PROGRAMMATICALLY GENERATED -->

						<h3 style=" font-weight:normal;background-color: #0098CB; padding: 10px 0px 10px 15px; margin-top:0px;color: #EAF1F7;">
						All Campuses >> Text Books (2)</h3>

						<!-- ***************************************** -->

            <?php
              $store->get_product_list();
              $_SESSION['current_store'] = serialize($store);
            ?>
					</div>		
		</div> <!-- end main -->

		<!-- <div id="footer" class="wrap"> start of footer -->

		</div> <!-- end footer -->
		<script type="text/javascript">


var regBox = document.getElementById('register');
var logBox = document.getElementById('login');

var regExit = document.getElementsByClassName("exit")[0];
var logExit = document.getElementsByClassName("exit")[1];

var login = document.getElementsByClassName("account")[0];
var register = document.getElementsByClassName("account")[1];


login.onclick = function() {
	logBox.style.display = "block";
}
register.onclick = function() {
	regBox.style.display = "block";
}

logExit.onclick = function() {
	logBox.style.display = "none";
}

regExit.onclick = function() {
	regBox.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == logBox) {
		logBox.style.display = "none";
	}
	else if (event.target == regBox) {
		regBox.style.display = "none";
	}
}

</script>
</body>

</html>
