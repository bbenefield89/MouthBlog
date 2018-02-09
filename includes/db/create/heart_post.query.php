<?php

class HeartPost extends Connection {
  public function __construct() {
    $this->connect();
  }
  
  /**********************
  ** HEART POST METHOD **
  **********************/
  public function heartPost($post_id, $user_id) {
    $sql = "INSERT INTO `hearted_posts` (`post_id`, `user_id`)
            VALUES (:post_id, :user_id)";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':post_id' => $post_id,
        ':user_id' => $user_id
      ]
    );
    
    if (!$result) {
      echo 'WOOOOPS';
    } else {
      $sql = "UPDATE `posts`
              SET `heart_count` = heart_count + 1
              WHERE id = :id";
      $query = $this->connect()->prepare($sql);
      $result = $query->execute(
        [
          ':id' => $post_id,
        ]
      );
      
      if (!$result) {
        echo 'UPDATE FAILED';
      } else {
        echo 'UPDATE SUCCEEDED';
      }
    }
  }
  
  /*************************
  ** UN-HEART POST METHOD **
  *************************/
  public function unHeartPost($post_id, $user_id) {
    $sql      = "DELETE FROM `hearted_posts`
                   WHERE `post_id` = :post_id AND `user_id` = :user_id";
    $query    = $this->connect()->prepare($sql);
    $result   = $query->execute(
      [
        'post_id'   => $post_id,
        'user_id'   => $user_id,
      ]
    );
    
    if (!$result) {
      echo 'DELETE FAILED';
    } else {
      $sql    = "UPDATE `posts`
                   SET `heart_count` = heart_count - 1
                   WHERE `id` = :post_id";
      $query  = $this->connect()->prepare($sql);
      $result = $query->execute(
        [
          ':post_id'  => $post_id,
        ]
      );
    }
  }
}
