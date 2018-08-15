<?php
  session_start();

  $_SESSION['current_user'] = NULL;

  header('Location: index.php');