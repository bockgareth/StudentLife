<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet"  href="css/stylesheet.css" />
</head>

<body>
<div id="header"> <!-- start of header -->
	<div class="wrap">
		<a href="#"><img src="images/Logo.png" alt="" style="margin-top:10px"/></a>
		<div class="dropdown" style="float:right;margin-top:10px;padding-bottom:10px">

		<!-- DROPDOWN PANEL -->
<!--		
			<div class="dropdown" style="float:right;margin-top:10px;padding-bottom:10px">
				<div class="dropdown-content">
				</div>
			</div>
	-->

	<!-- WHEN LOGGED IN -->

	<!--		<a href="#" class="account">Gareth Abrahams<span style="font-size:12px;color:black;margin-left:10px"/>▼</span></a>
	-->

	<!-- WHEN NOT LOGGED IN -->
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

			<!-- MUST BE LOGGED IN FOR THIS TO APPEAR ON THE DROPDOWN PANEL -->
				<!-- <div class="account-content">
				<ul>
					<li><a href="#">My Account</a></li>
					<li><a href="#">My Cart</a></li>
					<li><a href="#">My Favourites</a></li>
					<li><a href="#">Log Out</a></li>
				</ul>
			</div> -->
			
		</div>


				
				<div id="right-block" style="clear:right;margin-bottom:10px">
					<ul>
						<a href="#" style="color:white">
						<li class="icon-container dropdown"><img src="images/favourite icon.png" /><span class="icon-pos">0</span>
						</a>
						<div class="dropdown-content">
							<ul>
								<li>Java <span style="float:right">R600</span></li>
								<li><a href=""><button style="width:100%; height:40px;color:white;background-color: #0497c3;border:none;">View wishlist</button></a></li>
							</ul>
						</div>
						</li>
						<a href="#" style="color:white"><li class="icon-container dropdown"><img src="images/cart.png" /><span class="icon-pos">0</span></a>
							<div class="dropdown-content">
								<ul>
									<li>Java <span style="float:right">R600</span></li>
									<li>
										<span style="color:#124b75">subtotal</span><span style="float:right">R600</span></a>
									</li>
									<li>
										<a href="#"><button style="width:110px; height:40px;color:white;background-color: #0497c3;border:none;">Cart</button></a>
										<a href="#"><button style="width:110px; height:40px;float: right;color:white;background-color: #0497c3;border:none;">Check out</button></a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div> <!-- end header -->

		<div id="nav">
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
		</div>
		<div id="main" class="wrap"> <!-- start of main -->
		<?php 
			if (isset($_GET['login'])) 
				if($_GET['login'] === 'invalid') 
					echo '<h2 style="color:red">Invalid login</h2>';
				else 
					echo '<h2 style="color:green">Login success</h2>';
		?>
		<h2 style="margin:30px 0px 50px 0px; color:">Categories</h2>

		<div class="cat_cont">
			<a href=""><img src="images/icons/allCat.png" width="200" height="200"></a>
			<h2 class="cat_con_text">All Categories</h2>
			<p style="color:white;text-align:center">Under construction</p>
		</div> 

		<div class="cat_cont">
			<a href="products.php"><img src="images/icons/textbooks.png" width="200" height="200"></a>
			<h2 class="cat_con_text">Text Books</h2>
			<p style="color:#0098CB">&nbsp;</p>
		</div>

		<div class="cat_cont">
			<a href="">	<img src="images/icons/stationary.png" width="200" height="200"></a>
			<h2 class="cat_con_text">Stationary</h2>
			<p style="color:white;text-align:center">Under construction</p>
		</div>

		<div class="cat_cont">
			<a href="">	<img src="images/icons/computing.png" width="200" height="200"></a>
			<h2 class="cat_con_text">Computing</h2>
			<p style="color:white;text-align:center">Under construction</p>
		</div>

		</div> <!-- end main -->

		<div id="footer" class="wrap"> <!-- start of footer -->

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
