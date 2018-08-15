<?php
  class OnlineStore {
    public $conn = NULL;
    public $init = false;
    public $inventory = [];
    public $shopping_cart = [];

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
      $subtotal = 0;
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
              <img style="margin-right:15px" src="images/prodUnfav.png">
              <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&item-to-add=<?php echo $id ?>"><img src="images/cartUnshop.png" width="" height=""></a>
              <h5 style="margin-top:30px"><?php echo $this->shopping_cart[$id] ?> in your basket</h5>
              <h5 style="margin-top:30px">Subtotal: R<?php printf('%.2f',$info['price'] * $this->shopping_cart[$id])  ?></h5>
              
            </td>
          </tr>
          <?php $subtotal += ($info['price'] * $this->shopping_cart[$id]);
        } ?>
        </table> 
        <h4>TOTAL: <?php printf('R%.2f', $subtotal) ?></h4>
        <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?phpsessid=<?php echo session_id(); ?>&emptyCart=true">Empty Cart</a><br><br>
      <?php }
    }

    public function __wakeup() {
      include 'connection.php';
      $this->conn = $conn;
    }

    public function add_item() {
      $prod_id = $_GET['item-to-add'];
      if (array_key_exists($prod_id, $this->shopping_cart)) 
        $this->shopping_cart[$prod_id] += 1;
      
    }

    public function remove_item() {
      $prod_id = $_GET['item-to-remove'];
      if (!array_key_exists($prod_id, $this->shopping_cart))
        if ($this->shopping_cart[$prod_id] > 0)
          $this->shopping_cart[$prod_id]--;
    }

    public function empty_cart() {
      foreach ($this->shopping_cart as $key => $value)
        $this->shopping_cart[$key] = 0;
    }

    public function process_user_input() {
      if (!empty($_GET['item-to-add'])) {
        $this->add_item();
      }

      if (!empty($_GET['item-to-remove'])){

      }
        //$this->remove_item();

      if (!empty($_GET['emptyCart'])) 
        $this->empty_cart();
    }

    public function checkout() {
      $products_ordered = 0;
      foreach ($this->shopping_cart as $prod_id => $quantity) {
        if ($quantity > 0) {
          $products_ordered++;
          $sql = 'insert into ';
          $this->conn->query($sql);
        }
      }
    }
  }