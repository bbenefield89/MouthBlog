<?php

  include('../includes/db/connection.php');
  include('../includes/db/create/heart_post.query.php');
  
  $post_id = htmlentities($_POST['post_id'], ENT_QUOTES, 'ISO-8859-15');
  $user_id = htmlentities($_POST['user_id'], ENT_QUOTES, 'ISO-8859-15');
  
  $heart_post = new HeartPost();
  $heart_post->heartPost($post_id, $user_id);
