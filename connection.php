<?php
  $database_name = 'ShoppingCart';
  $conn = @new mysqli('localhost', 'root', '', $database_name);
  
  if ($conn->connect_errno)
    die('Error connecting to database...');