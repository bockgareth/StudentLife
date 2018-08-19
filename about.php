<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/stylesheet.css">
  <title>About</title>
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

<div class="wrap">
<h1>About</h1>

<p>
At Student Life, we believe we best know the students needs because we're students ourselves. We know and understand that buying textbooks on a student's budget is difficult and shouldn't have to pay excessive prices for textbooks and/or stationairy. That's why we provide a service for you to buy new or used (at a discounted price) textbooks and/or stationairy as well as the opportunity to make money by selling your textbooks or stationairy.
</p>

<h3>Terms and Conditions</h3>

<p>Please make sure you read our terms and conditions before making any transactions.

To read our terms and conditions click <a target="_blank" href="Student Life Terms and Conditions.pdf" type="application/pdf">here</a>.</p>

<h3>Code of Conduct</h3>

<p>Student Life is dedicated to providing a secure and safe service and an interesting and friendly experience for all and is outlined in our code of conduct.

To read our code of conduct click <a target="_blank" href="Student Life Code of Conduct.pdf" type="application/pdf">here</a>.<p>

<h3>Location</h3>

<p>Student Life is located at:</p>
<p>Keizersgracht, Cape Town, Western Province - 7925, South Africa</p>
<p>Website: http://studentliferesources.com</p>
<p>E-mail address: studentlife@gmail.com</p>
<p>Tel: 021 703 2081</p></div></div>
</body>
</html>