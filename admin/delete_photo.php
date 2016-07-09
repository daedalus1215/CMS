<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
    // If ID is not set
    if (empty($_GET['id'])) {
        redirect("../photos.php");
    }

    $photo = Photo::find_by_id(htmlspecialchars($_GET['id']));

    // Let's make sure we got a Photo and title isn't an empty string.
    if ($photo && $photo->title != '') {
        $photo->delete_photo();
    } else {
        redirect("../photos.php");
    }
?>

<?php redirect("../admin/photos.php"); ?>


<?php include("includes/footer.php"); ?>