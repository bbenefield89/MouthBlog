<?php

class DeletePost extends Connection {
  public function __construct($id) {
    $this->connect();
    
    $sql    = "START TRANSACTION;
    
               DELETE FROM
                 `posts`
               WHERE
                 `id` = :id;
                 
               DELETE FROM
                 `hearted_posts`
               WHERE
                 `post_id` = :id;
                 
               DELETE FROM
                 `comments`
               WHERE
                 `post_id` = :id;
                 
               COMMIT;";
    $query  = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':id' => htmlentities($id, ENT_QUOTES, 'ISO-8859-15'),
      ]
    );
  }
}
