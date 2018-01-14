<?php

session_start();

if (isset($_SESSION['email'])) {
  header('Location: blog_roll.php');
}

include('includes/db/connection.php');
include('includes/db/create/create_account.query.php');
include('includes/db/read/login.query.php');

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
  $name = htmlentities($_POST['name'], ENT_QUOTES, 'ISO-8859-15');
  $email    = htmlentities($_POST['email'], ENT_QUOTES, 'ISO-8859-15');
  $password = password_hash(htmlentities($_POST['password'], ENT_QUOTES, 'ISO-8859-15'), PASSWORD_DEFAULT);
  $create_account = new CreateAccount;
  
  $create_account->create_account($name, $password, $email);
  unset($create_account);
}

if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
  $email = htmlentities($_POST['login_email'], ENT_QUOTES, 'ISO-8859-15');
  $password = htmlentities($_POST['login_password'], ENT_QUOTES, 'ISO-8859-15');
  $login = new Login;
  
  $login->Login($email, $password);
  unset($login);
}

?>
<?php

include('includes/header.php');

?>

<main class="index-page container">
  
  <div class="row">
    <section class="col-10 offset-1">
      
      <h1 class="h1 text-center">Create a New Account</h1>
      
      <form action="<?php htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'ISO-8859-15'); ?>" method="POST">
        <div class="form-group">
          <input class="form-control form-control-lg" type="text" name="name" placeholder="First Name">
        </div>
        
        <div class="form-group">
          <input class="form-control form-control-lg" type="email" name="email" placeholder="Email Address">
        </div>
        
        <div class="form-group">
          <input class="form-control form-control-lg" type="password" name="password" placeholder="Password">
        </div>
        
        <button class="btn btn-lg float-right" type="submit" name="create_account">Create Account</button>
      </form>
      
    </section>
  </div>
  
</main>

<?php

include('includes/footer.php');

?>
