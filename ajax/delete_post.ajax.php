<?php

  include('../includes/db/connection.php');
  include('../includes/db/delete/delete_post.query.php');
  
  $delete_post = new DeletePost($_POST['id']);
