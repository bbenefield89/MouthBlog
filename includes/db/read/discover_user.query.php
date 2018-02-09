<?php

class DiscoverUser extends Connection {
  public function __construct() {
    $this->connect();
    
    $sql = "SELECT `id`, `name`, `email`
            FROM `users`"
  }
}
