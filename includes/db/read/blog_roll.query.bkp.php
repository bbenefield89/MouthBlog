<?php

class BlogRoll extends Connection {
  public function __construct() {
    $this->connect();
    
    $sql    = "SELECT `id`, `user_id`, `user_name`, `content`, `comment_count`, `heart_count`, `date_created`
               FROM `posts`
               ORDER BY `date_created` DESC";
    $query  = $this->connect()->prepare($sql);
    $result = $query->execute();
    
    if ($result) {
      if ($_SERVER['PHP_SELF'] == '/mouthblog/blog_roll.php') {
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
          $id            = htmlentities($row->id, ENT_QUOTES, 'ISO-8859-15');
          $user_id       = htmlentities($row->user_id, ENT_QUOTES, 'ISO-8859-15');
          $user_name     = htmlentities($row->user_name, ENT_QUOTES, 'ISO-8859-15');
          $content       = htmlentities($row->content, ENT_QUOTES, 'ISO-8859-15');
          $comment_count = htmlentities($row->comment_count, ENT_QUOTES, 'ISO-8859-15');
          $heart_count   = htmlentities($row->heart_count, ENT_QUOTES, 'ISO-8859-15');
          $date_created  = htmlentities($row->date_created, ENT_QUOTES, 'ISO-8859-15');
          
          echo '
                <div class="row post-container">
                  <article class="col-10 offset-1" data-toggle="modal" data-target="#exampleModal">
                    <h2 class="h2">',$user_name,'</h2>
                    <small>',$date_created,'</small>
          ';
                    
          if ($_SESSION['id'] == $user_id) {
            echo '
                    <form action="',htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'),'" class="" method="POST">
                      <button class="btn btn-danger" name="delete_post" type="submit">DELETE</button>
                      <input id="delete-post-id" name="post_id" type="hidden" value="',$id,'">
                    </form>
            ';
          }
          
          echo '
                    <hr>
                    <p class="lead">',$content,'</p>
                    <hr>
                    <form action="',htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'),'" class="blog-post-interactions" method="POST">
                      <i class="far fa-comment-alt fa-lg"></i>
                      <small class="mr-3">',$comment_count,'</small>
          ';
          
          if ($heart_count > 0) {
            $newSQL = "SELECT `post_id`, `user_id`
                      FROM `hearted_posts`
                        WHERE `post_id` = :post_id";
            $newQuery = $this->connect()->prepare($newSQL);
            $newResult = $newQuery->execute(
              [
                ':post_id'  => $id,
              ]
            );
            
            if (!$newResult) {
              echo 'FAIL';
            } else {
              $row = $newQuery->fetch(PDO::FETCH_OBJ);
              
              if ($row->user_id === $_SESSION['id']) {
                echo '
                      <button class="heart-post-button liked" type="submit" name="heart_post_button"><i class="fas fa-heart fa-lg"></i></button>
                ';
              }
            }
          } else {
            echo '
                      <button class="heart-post-button" type="submit" name="heart_post_button"><i class="fas fa-heart fa-lg"></i></button>
            ';
          }
                  
          echo '
                      <small>',$heart_count,'</small>
                      <input name="heart_count" type="hidden" value="',$heart_count,'">
                      <input name="post_id" type="hidden" value="',$id,'">
                      <input name="user_id" type="hidden" value="',$_SESSION['id'],'">
                    </form>
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
