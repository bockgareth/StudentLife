<?php
  $database_name = 'TheShoppingCart';
  $conn = @new mysqli('localhost', 'root', '', $database_name);
  
  if ($conn->connect_errno)
    die('Error connecting to database...');

  $category = file('sql/category.csv');

  foreach ($category as $cat) {
    $sql = 'insert into Category (category_name) value ("'.trim($cat).'")';
    $conn->query($sql);
  }

  $products = file('sql/product.csv');

  foreach ($products as $product) {
    $data = explode(',', $product);
    $sql = 'insert into Product (product_name, description, price, photo_id, category_id)
        values ("'.$data[0].'", "'.$data[1].'", "'.$data[2].'", "'.$data[3].'", "'.trim($data[4]).'")';
    
    $conn->query($sql);
  }

  $campus = file('sql/campus.csv');

  foreach ($campus as $camp) {
    $sql = 'insert into Campus (campus_name) values ("'.trim($camp).'")'; 
    $conn->query($sql);
  }

  $inventory = file('sql/inventory.csv');

  foreach ($inventory as $inv) {
    $data = explode(',', $inv);
    $sql = 'insert into Inventory (product_id, campus_id, stock) 
            values ("'.$data[0].'", "'.$data[1].'", "'.trim($data[2]).'")';

    $conn->query($sql);
  }