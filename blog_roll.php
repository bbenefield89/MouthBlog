<?php

session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
  header('Location: index.php');
}

include('includes/db/connection.php');
include('includes/db/create/submit_post.query.php');
include('includes/db/read/blog_roll.query.php');
include('includes/db/delete/delete_post.query.php');

$id    = htmlentities($_SESSION['id'], ENT_QUOTES, 'ISO-8859-15');
$name  = htmlentities($_SESSION['name'], ENT_QUOTES, 'ISO-8859-15');
$email = htmlentities($_SESSION['email'], ENT_QUOTES, 'ISO-8859-15');

// CREATE A NEW POST
if (isset($_POST['content'])) {
  $content     = htmlentities($_POST['content'], ENT_QUOTES, 'ISO-8859-15');
  $submit_post = new SubmitPost($id, $name, $content);
  
  // $submit_post->submit_post($id, $name, $content);
  unset($submit_post);
}

// DELETE A POST
// if (isset($_POST['delete_post']) && isset($_POST['post_id'])) {
//   $post_id = htmlentities($_POST['post_id'], ENT_QUOTES, 'ISO-8859-15');
//   $delete_post = new DeletePost($post_id);
  
//   unset($delete_post);
// }

include('includes/header.php');

?>

<main class="blog-roll container-fluid">
  <div class="row">
    <div class="col-10 offset-1">
      
      <div class="content-wrapper row">
        <header class="col-10 offset-1 col-md-4 offset-md-4 mb-5">
          <h1 class="h1">Welcome back, <?php echo $name; ?>!</h1>
          <p class="lead">What's on your mind?</p>
          
          <form action="<?php htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'); ?>" id="submit-post" method="POST">
            <div class="form-group">
              <textarea class="form-control" id='submit-post-content' name="content"></textarea>
            </div>
            <button class="btn btn-lg lead" id="submit-post-button" type="submit" name="submit_new_post">Post</button>
            <input id="submit-post-id" name="submit-post-id" type="hidden" value="<?php echo $id; ?>">
            <input id="submit-post-name" name="submit-post-name" type="hidden" value="<?php echo $name; ?>">
          </form>
        </header>
        
        <section class="col-8 pt-4">
          
          <?php
          
            $blog_roll = new BlogRoll;
          
          ?>
          
        </section>
        
        <aside class="col-4 text-center">
          
          <h3 class="h3">Following</h3>
          <hr>
          <ul class="list-unstyled mb-5">
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
          </ul>
          
          <h3 class="h3">Discover Someone</h3>
          <hr>
          <ul class="list-unstyled mb-5">
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
          </ul>
          
          <h3 class="h3">Stories</h3>
          <hr>
          <ul class="list-unstyled mb-5">
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
            <li>User 1</li>
          </ul>
          
        </aside>
      </div>
      
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
