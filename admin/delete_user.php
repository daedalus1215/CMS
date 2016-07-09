<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
    // If ID is not set
    if (empty($_GET['id'])) {
        redirect("../users.php");
    }

    $user = User::find_by_id(htmlspecialchars($_GET['id']));

    // Let's make sure we got a User and title isn't an empty string.
    if ($user) {
        $user->delete();
    } else {
        redirect("../users.php");
    }
?>

<?php redirect("../admin/users.php"); ?>


<?php include("includes/footer.php"); ?>