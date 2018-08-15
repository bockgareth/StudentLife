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
	<title></title>
	<link rel="stylesheet"  href="css/stylesheet.css" />
</head>

<body>
		<div id="header"> <!-- start of header -->
			<div class="wrap">
				<a href="#"><img src="images/Logo.png" alt="" style="margin-top:10px"/></a>
				<div class="dropdown" style="float:right;margin-top:10px;padding-bottom:10px">
					<a href="#" class="account">Gareth Abrahams<span style="font-size:12px;color:black;margin-left:10px"/>▼</span></a>	<div class="account-content">
						<ul>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Cart</a></li>
							<li><a href="#">My Favourites</a></li>
							<li><a href="#">Log Out</a></li>
						</ul>
					</div>
				</div>
				<div id="right-block" style="clear:right;margin-bottom:10px">
					<ul>
						<a href="#" style="color:white"><li class="icon-container dropdown"><img src="images/favourite icon.png" /><span class="icon-pos">0</span></a>
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
</body>

</html>
