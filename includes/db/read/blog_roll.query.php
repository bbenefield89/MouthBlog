<?php

class BlogRoll extends Connection {
  public function __construct() {
    $this->connect();
    
    $sql    = "SELECT `id`, `user_id`, `user_name`, `content`, `date_created`
               FROM `posts`
               ORDER BY `date_created` DESC";
    $query  = $this->connect()->prepare($sql);
    $result = $query->execute();
    
    if ($result) {
      if ($_SERVER['PHP_SELF'] == '/mouthblog/blog_roll.php') {
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
          $id                      = htmlentities($row->id, ENT_QUOTES, 'ISO-8859-15');
          $user_id                 = htmlentities($row->user_id, ENT_QUOTES, 'ISO-8859-15');
          $user_name               = htmlentities($row->user_name, ENT_QUOTES, 'ISO-8859-15');
          $content                 = htmlentities($row->content, ENT_QUOTES, 'ISO-8859-15');
          $date_created            = htmlentities($row->date_created, ENT_QUOTES, 'ISO-8859-15');
          
          echo '
                <div class="row">
                  <article class="col-10 offset-1">
                    <h2 class="h2">',$user_name,'</h2>
                    <small>',$date_created,'</small>
                    &nbsp;
                    &nbsp;
                    <form action="',htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'),'" class="" method="POST">
                      <button class="btn btn-danger" name="delete_post" type="submit">DELETE</button>
                      <input id="delete-post-id" name="post_id" type="hidden" value="',$id,'">
                    </form>
                    <hr>
                    <p class="lead">',$content,'</p>
                  </article>
                </div>
          ';
        }
      } else {
        $returnArray = [];
        
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
          array_push($returnArray, $row);
        }
        
        header('Content-Type: application/json;charset=UTF-8');
        exit(json_encode($returnArray));
      }
    } else {
      echo 'NO POSTS TO DISPLAY';
    }
  }
}
