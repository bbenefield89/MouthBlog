<?php

  include('includes/env.php');

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
  integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="assets/css/main.css">

  <title>Hello, world!</title>
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-light">
    <a class="navbar-brand mx-auto" href="#"><span>Mouth</span> <span>Blog</span></a>

    <?php if (isset($_SESSION['email'])) : ?>

      <div class="mx-auto">
        <form action="<?php echo $env; ?>logout.php" method="POST">
          <button class="btn btn-danger" type="submit" name="logout_button">Log out</button>
        </form>
      </div>

    <?php else :?>

      <div class="dropdown mx-auto">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Log in
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <form action="<?php htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'); ?>" id="login-form" method="POST">
          <div class="form-group">
            <input class="form-control from-control-lg" type="email" name="login_email"
            placeholder="Email Address" required>
          </div>

          <div class="form-group">
            <input class="form-control from-control-lg" type="password" name="login_password"
            placeholder="Password" required>
          </div>
          <button class="btn" id="login-button" type="submit" name="login_button">Log in</button>
        </form>
      </div>
    </div>

  <?php endif; ?>
</nav>
</body>
</html>
