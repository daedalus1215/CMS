<?php require_once("init.php"); ?>


<?php
    if ($session->is_signed_in()) {
        redirect('index');
    }

    if (isset($_POST['submit'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Check the DB for the user.
        $user_found = User::verify_user($username, $password);


        if ($user_found) {
            $session->login($user_found);
            redirect("index.php");
        } else {
            $the_message = "The password or username are incorrect.";
        }

    } else {
        $username = "";
        $password = "";
    }
?>


<form method="post" action="login.php">
  <div class=""form-group">

  </div>
  <div class=""form-group">

  </div>
  <div class=""form-group">
    <in
  </div>
</form>