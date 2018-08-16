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
<h4 style="display:inline-block"><a href="index.php">Back to home</a></h4> |
<h4 style="display:inline-block"><a href="products.php">Back to products</a></h4>
<h1>History</h1>
  <table>
    <tr>
      <th>Quantity</th>
      <th>Name</th>
      <th>Price</th>
      <th>Date of purchase</th>
    </tr>
    <?php 
      $first_name = explode(' ', $_SESSION['current_user'])[0];
      echo '<h3>Account details for the user:</h3>';
      echo $first_name;
      echo '<br><br>';
      $sql = '
      select OrderLine.quantity, Product.product_name, Product.price, OrderTable.date_of_purchase 
        from OrderLine 
        join Product 
        on OrderLine.product_id = Product.product_id 
        join OrderTable 
        on OrderLine.order_id = OrderTable.order_id 
        join Customer on OrderTable.customer_id = Customer.customer_id
        where Customer.first_name = "'.$first_name.'"';
        echo $sql;
        if ($result = $store->conn->query($sql)) {
          while (($row = $result->fetch_assoc()) != NULL) { ?>
            <tr>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['product_name']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['date_of_purchase']; ?></td>
            </tr>
          <?php }
        }
    ?>
  </table>
</body>
</html>