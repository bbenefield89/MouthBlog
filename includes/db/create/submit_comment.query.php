<?php

class SubmitComment extends Connection {
  public function __construct($post_id, $user_id, $username, $comment_content) {
    $this->connect();
    
    $sql = "INSERT INTO
              comments
            VALUES
              (
                NULL,
                :post_id,
                :user_id,
                :username,
                :comment_content,
                CURRENT_TIMESTAMP
              )";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':post_id'         => $post_id,
        ':user_id'         => $user_id,
        ':username'        => $username,
        ':comment_content' => $comment_content,
      ]
    );
    
    if (!$result) {
      echo 'SUBMIT COMMENT FAILED';
    } else {
      echo 'SUBMIT COMMENT SUCCESS';
    }
  }
}
