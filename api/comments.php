<?php

include('../includes/db/connection.php');
include('../includes/db/read/return_all_comments.query.php');

$postID = htmlentities($_POST['post_id'], ENT_QUOTES, 'ISO-8859-15');

$newest_post = new ReturnAllComments($postID);

unset($newest_post);
