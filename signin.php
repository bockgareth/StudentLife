<?php
  include 'connection.php';
  session_start();

  if (isset($_POST['submit'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $hashed_password = md5($password);
    $sql = 'select * from Customer where email = "'.$email.'"';

    if ($result = $conn->query($sql)) {
      $row_count = $result->num_rows;
      if ($row_count > 0) {
        while ($row = $result->fetch_assoc()) {
          if ($row['email'] == $email && $row['password'] == trim($hashed_password)) {
            $_SESSION['current_user'] = $row['first_name'].' '.$row['last_name'];
            header('Location: index.php');
          }
          else {
            echo 'Failed to login.';
          }
        }
      }
      else {
        echo 'This user does not exist. Please consider signing up.';
      }
    }
  }