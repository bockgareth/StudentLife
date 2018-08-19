<?php
  session_start();
  include 'api.php';

  if (!isset($_SESSION['current_user']))
    header('Location: products.php?login=false');

  if (class_exists('OnlineStore')) {
    if (isset($_SESSION['current_store'])) {
      $store = unserialize($_SESSION['current_store']);
    }
    else {
      $store = new OnlineStore();
    }
    $store->process_user_input();
  }
  else {
    echo 'The OnlineStore class is not available';
    $store = NULL;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/stylesheet.css">
  <title>My Account</title>
</head>
<body>
<div id="header"> <!-- start of header -->
	<div class="wrap">
		<a href="index.php"><img src="images/Logo.png" alt="" style="margin-top:10px"/></a>
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
<h4 style="display:inline-block"><a href="index.php">Back to home</a></h4> |
<h4 style="display:inline-block"><a href="products.php">Back to products</a></h4>
<h1>History</h1>
  <table >
    <tr>
      <th>Quantity</th>
      <th>Name</th>
      <th>Price</th>
      <th>Date of purchase</th>
      <th>Delivery date</th>
    </tr>
    <?php 
      $first_name = explode(' ', $_SESSION['current_user'])[0];
      echo '<h3>Account details for the user:</h3>';
      echo $first_name;
      echo '<br><br>';
      $sql = '
      select OrderLine.quantity, Product.product_name, Product.price, OrderTable.date_of_purchase, OrderTable.delivery_date 
        from OrderLine 
        join Product 
        on OrderLine.product_id = Product.product_id 
        join OrderTable 
        on OrderLine.order_id = OrderTable.order_id 
        join Customer on OrderTable.customer_id = Customer.customer_id
        where Customer.first_name = "'.$first_name.'"';
        if ($result = $store->conn->query($sql)) {
          while (($row = $result->fetch_assoc()) != NULL) { ?>
            <tr>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['product_name']; ?></td>
              <td>R<?php echo $row['price']; ?></td>
              <td><?php echo $row['date_of_purchase']; ?></td>
              <td><?php echo $row['delivery_date']; ?></td>
            </tr>
          <?php }
        }
    ?>
  </table>
</body>
</html>