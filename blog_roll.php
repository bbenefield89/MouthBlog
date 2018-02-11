<?php

  session_start();

  if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header('Location: index.php');
  }

  include('includes/db/connection.php');
  include('includes/db/read/blog_roll.query.php');
  include('includes/db/create/submit_comment.query.php');
  
  if (isset($_POST['submit_comment'])) {
    $submit_comment = new SubmitComment($_POST['post_id'], $_POST['user_id'], $_POST['username'], $_POST['comment_content']);
    
    unset($submit_comment);
  }

  $id    = htmlentities($_SESSION['id'], ENT_QUOTES, 'ISO-8859-15');
  $name  = htmlentities($_SESSION['name'], ENT_QUOTES, 'ISO-8859-15');
  $email = htmlentities($_SESSION['email'], ENT_QUOTES, 'ISO-8859-15');

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
        </header><!-- col -->
        
        <section class="col-12 pt-4">
          
          <?php
          
            $blog_roll = new BlogRoll;
          
          ?>
          
        </section><!-- col -->
      </div><!-- row -->
      
    </div><!-- col -->
  </div><!-- row -->
</main><!-- container -->

<div class="post-modal-outer col-12">
  <div class="post-modal-inner col-12 col-sm-10 col-md-8 col-xl-6 mb-4">
    <div class="post-modal-header modal-header">
      <h3 class="h5" id="post-modal-username"><!-- USERNAME --></h3>
      <i class="post-modal-close fas fa-times fa-lg text-danger"></i>
      <small id="post-modal-created-on"><!-- CREATED ON --></small>
    </div><!-- header -->
    
    <hr>
    
    <div class="post-modal-body modal-body">
      <p class="lead" id="post-modal-content"><!-- CONTENT --></p>
    </div><!-- body -->
    
    <hr>
    
    <!-- ADD COMMENT FORM -->
    <form action="<?php htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'); ?>" class="post-modal-add-comment-form" method="POST">
      <h4 class="h6 mb-3">Add a comment</h4>
      <textarea class="mb-3 post-modal-comment-content" name="comment_content" required></textarea>
      <small class="text-danger new-comment-error display-none">Please add some content before submitting</small>
      <input class="post-modal-post-id" name="post_id" type="hidden" value="">
      <input class="post-modal-comment-user-id" name="user_id" type="hidden" value="<?php echo $id; ?>">
      <input class="post-modal-comment-username" name="username" type="hidden" value="<?php echo $name; ?>">
      <button class="btn btn-lg btn-success mb-3" name="submit_comment" type="submit">Add Comment</button>
    </form><!-- form -->
    
    <!-- COMMENTS WILL BE DYNAMICALLY GENERATED AND PLACED HERE WITH JS/PHP -->
    
  </div><!-- inner modal -->
</div><!-- outer modal -->

<?php include('includes/footer.php'); ?>
