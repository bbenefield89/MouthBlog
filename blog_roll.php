<?php

session_start();

if (!isset($_SESSION['email'])) {
  header('Location: index.php');
}

include('includes/header.php');

?>

<main class="blog-roll container-fluid">
  <div class="row">
    <div class="col-10 offset-1">
      
      <div class="content-wrapper row">
        <header class="col-10 offset-1 col-md-4 offset-md-4 mb-5">
          <h1 class="h1">Welcome back, [USERS NAME]!</h1>
          <p class="lead">What's on your mind?</p>
          
          <form action="<?php htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'); ?>" method="POST">
            <div class="form-group">
              <textarea class="form-control" name="new_post"></textarea>
            </div>
            <button class="btn btn-lg lead" type="submit" name="submit_new_post">Post</button>
          </form>
        </header>
        
        <section class="col-8 pt-4">
          
          <div class="row">
            <article class="col-10 offset-1">
              <h2 class="h2">Hello</h2>
              <hr>
              <p class="lead">
                This is some content for my blog post
              </p>
            </article>
          </div>
          
          <div class="row">
            <article class="col-10 offset-1">
              <h2 class="h2">Hello</h2>
              <hr>
              <p class="lead">
                This is some content for my blog post
              </p>
            </article>
          </div>
          
          <div class="row">
            <article class="col-10 offset-1">
              <h2 class="h2">Hello</h2>
              <hr>
              <p class="lead">
                This is some content for my blog post
              </p>
            </article>
          </div>
          
          <div class="row">
            <article class="col-10 offset-1">
              <h2 class="h2">Hello</h2>
              <hr>
              <p class="lead">
                This is some content for my blog post
              </p>
            </article>
          </div>          
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
