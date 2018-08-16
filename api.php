<?php
  class OnlineStore {
    public $conn = NULL;
    public $init = false;
    public $inventory = [];
    public $shopping_cart = [];
    public $total;

    public function __construct() {
      include 'connection.php';
      $this->conn = $conn;
    }

    public function __destruct() {
      if (!$this->conn->connect_error)
        $this->conn->close();
    }

    public function set_inventory() {
      if ($this->init == false) {
        $sql = 'select * from Product';
        if ($result = $this->conn->query($sql)) {
          $this->inventory = [];
          $this->shopping_cart = [];
          while (($row = $result->fetch_assoc()) != NULL) {
            $this->inventory[$row['product_id']] = [];
            $this->inventory[$row['product_id']]['name'] = $row['name'];
            $this->inventory[$row['product_id']]['description'] = $row['description'];
            $this->inventory[$row['product_id']]['price'] = $row['price'];
            $this->shopping_cart[$row['product_id']] = 0;
          }
        }
        $this->init = true;
      }
    }

    public function get_product_list() {
      $this->total = 0;
      if (count($this->inventory) > 0) { ?> 
        <table style="width:100%;border-collapse:collapse">
          <?php foreach ($this->inventory as $id => $info) { ?> 
            <tr style="display:block;border-bottom: 2px solid #e0e0e0; padding-bottom:2%; margin-bottom:20px;">
            <td style="width:20%"> 
              <img src="images/products/jhtp.jpg" width="170" height="170">
            </td>
            <td style="vertical-align:top; width:67%; padding-left:10px;">
              <h4 style="margin-top:0px"><?php echo $info['name'] ?></h4>
              <p><?php echo $info['description'] ?></p>
              <h4>Mowbray</h4>
            </td>
            <td style="vertical-align:top;width:13%">
              <h3 style="margin-top:0px; margin-bottom:30%">R<?php echo $info['price'] ?></h3>
              <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&item-to-remove=<?php echo $id ?>"><img style="margin-right:15px" src="images/prodUnfav.png"></a>
              <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&item-to-add=<?php echo $id ?>">
              
              <?php
                if ($this->shopping_cart[$id] > 0) {
                  echo '<img src="images/cartShop.png" width="" height="">';
                } else {
                  echo '<img src="images/cartUnshop.png" width="" height="">';
                }
              ?>
              
            
            
              </a>
              <h5 style="margin-top:30px"><?php echo $this->shopping_cart[$id] ?> in your basket</h5>
              <h5 style="margin-top:30px">Subtotal: R<?php printf('%.2f',$info['price'] * $this->shopping_cart[$id])  ?></h5>
            </td>
          </tr>
          <?php $this->total += ($info['price'] * $this->shopping_cart[$id]);
        } ?>
        </table> 
        <h4>TOTAL: <?php printf('R%.2f', $this->total) ?></h4>
        <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&empty-cart=true">Empty Cart</a><br><br>
        <h3><a href="checkout.php?phpsessid=<?php echo session_id(); ?>">Checkout</a></h3>
      <?php }
    }

    public function __wakeup() {
      include 'connection.php';
      $this->conn = $conn;
    }

    public function add_item() {
      $prod_id = $_GET['item-to-add'];

      if ($this->shopping_cart[$prod_id] > 0)
        echo '<script>alert("This item has already been added");</script>';

      if (array_key_exists($prod_id, $this->shopping_cart)) 
        $this->shopping_cart[$prod_id] += 1;
      
    }

    public function remove_item() {
      $prod_id = $_GET['item-to-remove'];
      if (array_key_exists($prod_id, $this->shopping_cart))
        if ($this->shopping_cart[$prod_id] > 0)
          $this->shopping_cart[$prod_id]--;
    }

    public function remove_row() {
      $prod_id = $_GET['remove-row'];
      if (array_key_exists($prod_id, $this->shopping_cart)) {
        $size = $this->shopping_cart[$prod_id];
        for ($i = 0; $i < $size; $i++) {
          $this->shopping_cart[$prod_id]--;
        }
      }
    }

    public function empty_cart() {
      foreach ($this->shopping_cart as $key => $value)
        $this->shopping_cart[$key] = 0;
    }

    public function get_items_count() {
      $this->items = 0;
      foreach ($this->inventory as $id => $info) 
        if ($this->shopping_cart[$id] > 0)
          $this->items += $this->shopping_cart[$id];
      
      return $this->items;
    }

    public function process_user_input() {
      if (!empty($_GET['item-to-add'])) 
        $this->add_item();

      if (!empty($_GET['item-to-remove']))
        $this->remove_item();

      if (!empty($_GET['empty-cart'])) 
        $this->empty_cart();

      if (!empty($_GET['remove-row'])) 
        $this->remove_row();
      
      if (!empty($_GET['checkout']))
        if ($_GET['checkout'] != 'success')
          $this->checkout();
    }

    public function checkout() {
      $first_name = explode(' ', $_SESSION['current_user'])[0];
      $sql = 'select * from Customer where first_name = "'.$first_name.'"';
      if ($row = $this->conn->query($sql)->fetch_assoc()) {
        $user_id = $row['customer_id'];
      }

      $sql = 'insert into OrderTable (customer_id, order_id, date_of_purchase, delivery_date, payment) values ("'.$user_id.'", "'.session_id().'", CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 3 DAY), "'.$this->total.'")';
      
      $this->conn->query($sql);

      foreach ($this->shopping_cart as $product_id => $quantity) {
        if ($quantity > 0) {
          $sql = 'insert into OrderLine (product_id, order_id, quantity) values ("'.$product_id.'", "'.session_id().'", "'.$quantity.'")';
          if (!$this->conn->query($sql)) {echo 'falied';};
        }
      }

      header('Location: products.php?checkout=success&empty-cart=true');
    }
  }