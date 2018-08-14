<?php
  class OnlineStore {
    private $conn;
    private $inventory = [];
    private $shopping_cart = [];

    public function __construct() {
      include 'connection.php';
      $this->conn = $conn;
    }

    public function __destruct() {
      if (!$this->conn->connect_error)
        $this->conn->close();
    }

    public function get_product_list() {
      
    }

    public function __wakeup() {
      include 'connection.php';
      $this->conn = $conn;
    }

    public function add_item() {
      $prod_id = $_GET['item-to-add'];
      if (!array_key_exists($prod_id, $this->shopping_cart))
        return;

      $this->shopping_cart[$prod_id]++;
    }

    public function remove_item() {
      $prod_id = $_GET['item-to-remove'];
      if (!array_key_exists($prod_id, $this->shopping_cart))
        return;

      if ($this->shopping_cart[$prod_id] > 0)
        $this->shopping_cart[$prod_id]--;
    }

    public function empty_cart() {
      foreach ($this->shopping_cart as $key => $value)
        $this->shopping_cart[$key] = 0;
    }

    public function process_user_input() {
      if (!empty($_GET['item-to-add']));
        $this->add_item();

      if (!empty($_GET['item-to-remove']));
        $this->remove_item();

      if (!empty($_GET['empty-cart']));
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