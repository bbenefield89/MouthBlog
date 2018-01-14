<?php

session_start();

if (!isset($_SESSION['email'])) {
  header('Location: index.php');
} else {
  echo 'Welcome to your blog roll';
}
