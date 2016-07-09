<?php require_once("includes/header.php"); ?>


<?php
    if ($session->is_signed_in()) {
        redirect('index.php');
    }

    if (isset($_POST['submit'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Check the DB for the user.
        $user_found = User::verify_user($username, $password);


        if ($user_found) {
            unset($_POST);
            $session->login($user_found);
            redirect("index.php");
        } else {
            $message = "The password or username are incorrect.";
        }

    } else {
        $message = "";
        $username = "";
        $password = "";
    }
?>

<div class="col-md-4 col-md-offset-3">
  <h4 class="bg-danger"> <?php echo $message; ?></h4>
    <form method="post" action="">
      <div class="form-group">
           <label for="username">Username</label>
           <input type="text" class="form-control" name="username" value="<?php htmlentities($username); ?>">
      </div>
      <div class="form-group">
           <label for="password">Password</label>
           <input type="text" class="form-control" name="password" value="<?php echo htmlentities($password); ?>"></input>
      </div>
      <div class="form-group">
           <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
      </div>
    </form>
</div>