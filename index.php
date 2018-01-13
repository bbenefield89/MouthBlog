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

<h1>Hello, world!</h1>

<?php

include('includes/footer.php');

?>
