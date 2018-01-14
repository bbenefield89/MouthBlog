<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">

    <title>Hello, world!</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-md navbar-light">
      <a class="navbar-brand mx-auto" href="#"><span>Mouth</span> <span>Blog</span></a>

        <div class="dropdown mx-auto">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Log in
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <form action="<?php htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'); ?>" method="POST">
              <div class="form-group">
                <input class="form-control from-control-lg" type="text" name="login_email" placeholder="Email Address">
              </div>
              
              <div class="form-group">
                <input class="form-control from-control-lg" type="text" name="login_password" placeholder="Email Address">
              </div>
              <button class="btn" type="submit" name="login_button">Log in</button>
            </form>
          </div>
        </div>
    </nav>
