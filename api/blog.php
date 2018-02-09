<?php

  session_start();

  if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header('Location: index.php');
  }

  include('../includes/db/connection.php');
  include('../includes/db/read/blog_roll.query.php');
  $get_data = new BlogRoll;
