<?php
  $database_name = 'TheShoppingCart';
  $conn = @new mysqli('localhost', 'root', '', $database_name);
  
  if ($conn->connect_errno)
    die('Error connecting to database...');