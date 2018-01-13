<?php

include('includes/db/connection.php');
include('includes/db/create/create_account.query.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = htmlentities($_POST['username'], ENT_QUOTES, 'ISO-8859-15');
  $password = password_hash(htmlentities($_POST['password'], ENT_QUOTES, 'ISO-8859-15'), PASSWORD_DEFAULT);
  $create_account = new CreateAccount;
  
  $create_account->create_account($username, $password);
  unset($create_account);
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
          <input class="form-control form-control-lg" type="name" name="name" placeholder="First Name">
        </div>
        
        <div class="form-group">
          <input class="form-control form-control-lg" type="email" name="email" placeholder="Email Address">
        </div>
        
        <div class="form-group">
          <input class="form-control form-control-lg" type="password" name="password" placeholder="Password">
        </div>
        
        <input class="btn btn-success float-right" type="submit" name="create_account" value="Create Account">
      </form>
      
    </section>
  </div>
  
</main>

<?php

include('includes/footer.php');

?>
