<?php

include('../includes/db/connection.php');
include('../includes/db/create/submit_post.query.php');

$submitPost = new SubmitPost($_POST['id'], $_POST['name'], $_POST['content']);
