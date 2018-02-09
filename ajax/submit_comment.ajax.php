<?php

  include('../includes/db/connection.php');
  include('../includes/db/create/submit_comment.query.php');

  $post_id         = htmlentities($_POST['post_id'], ENT_QUOTES, 'ISO-8859-15');
  $user_id         = htmlentities($_POST['user_id'], ENT_QUOTES, 'ISO-8859-15');
  $username        = htmlentities($_POST['username'], ENT_QUOTES, 'ISO-8859-15');
  $comment_content = htmlentities($_POST['comment_content'], ENT_QUOTES, 'ISO-8859-15');
  
  $submit_comment = new SubmitComment($post_id, $user_id, $username, $comment_content);
  
  unset($submit_comment);
