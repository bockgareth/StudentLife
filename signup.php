<?php
  include 'connection.php';

  if (isset($_POST['submit'])) {
    $first_name = htmlentities($_POST['firstName']);
    $last_name = htmlentities($_POST['lastName']);
    $cellphone = htmlentities($_POST['cellphone']);
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    $sql = 'select * from Customer where email = "'.$email.'"';
    echo $sql;

    if ($result = $conn->query($sql)) {
      $row_count = $result->num_rows;

      if ($row_count > 0) {
        echo "This email addess has already been taken.";
      } else {
        $hashed_password = md5($password);
        $sql = '
          insert into Customer (first_name, last_name, cellphone, email, password)
          values ("'.$first_name.'", "'.$last_name.'", "'.$cellphone.'", "'.$email.'", "'.$hashed_password.'")
        ';
        echo $sql;

        $conn->query($sql);
      }
    }
    else { echo $conn->error; }
  }