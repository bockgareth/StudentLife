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

  
  if (!($store->get_items_count() > 0))
    header('Location: products.php?cart=empty');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/stylesheet.css">
  <title>Checkout</title>
</head>
<body>
  <table style="width:100%;border-collapse:collapse">
    <tr style="display:block;border-bottom: 2px solid #e0e0e0; padding-bottom:2%; margin-bottom:20px;">
      <th style="width:35%"> 
        Name
      </th>
      <th style="vertical-align:top; width:20%; padding-left:10px;">
        # in basket
      </th>
      <th style="vertical-align:top;width:25%">
        Subtotal
      </th>
      <th style="vertical-align:top;width:20%"></th>
    </tr>

    <?php foreach ($store->inventory as $id => $info) {
      if ($store->shopping_cart[$id] > 0) { ?>
      <tr style="display:block;border-bottom: 2px solid #e0e0e0; padding-bottom:2%; margin-bottom:20px;">
      <td style="width:35%"> 
        <?php echo $info['name'] ?>
      </td>
      <td style="vertical-align:top; width:20%; padding-left:10px;">
        <?php echo $store->shopping_cart[$id] ?>
      </td>
      <td style="vertical-align:top;width:25%">
        R<?php printf('%.2f',$info['price'] * $store->shopping_cart[$id]) ?>
      </td>
      <td style="vertical-align:top;width:20%">
        <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&remove-row=<?php echo $id ?>">Remove this row</a>
      </td>
    </tr>   
      <?php }} ?>
  </table> 
  <h3><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&checkout=true">Confirm checkout</a></h3>
  <h4><a href="products.php">Back to products</a></h4>
</body>
</html>
