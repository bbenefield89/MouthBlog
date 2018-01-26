<?php

class DeletePost extends Connection {
  public function __construct($id) {
    $this->connect();
    
    $sql = "DELETE FROM `posts`
            WHERE `id`=:id";
    $query = $this->connect()->prepare($sql);
    $result = $query->execute(
      [
        ':id' => htmlentities($id, ENT_QUOTES, 'ISO-8859-15'),
      ]
    );
  }
}
