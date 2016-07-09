<?php include("includes/header.php"); ?>

<?php 
/**
 * Coming to this page via comment_photo.php.
 * The user clicks to delete a comment from the list of comments related to the
 * photo.
 */

?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
    // If ID is not set
    if (empty($_GET['id'] || empty($_GET['photo_id']))) {
        redirect("../comments.php");
    }

    $comment = Comment::find_by_id(htmlspecialchars($_GET['id']));

    // Let's make sure we got a Photo and title isn't an empty string.
    if ($comment) {
        $comment->delete();
    } else {
        redirect("comment_photo.php?id={$_GET['photo_id']}");
    }
?>

<?php redirect("comment_photo.php?id={$_GET['photo_id']}"); ?>


<?php include("includes/footer.php"); ?>