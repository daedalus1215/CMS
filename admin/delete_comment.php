<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
    // If ID is not set
    if (empty($_GET['id'])) {
        redirect("../comments.php");
    }

    $comment = Comment::find_by_id(htmlspecialchars($_GET['id']));

    // Let's make sure we got a Photo and title isn't an empty string.
    if ($comment) {
        $comment->delete();
    } else {
        redirect("../comments.php");
    }
?>

<?php redirect("../admin/comments.php"); ?>


<?php include("includes/footer.php"); ?>