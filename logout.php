<?php

// check if cookie was set for user
if (isset($_COOKIE[ session_name() ])) {
  // clear cookie
  setcookie(session_name(), '' , time()-86400, '/');
}

// unset and destroy session
session_unset();
session_destroy();

header('Location: index.php');
