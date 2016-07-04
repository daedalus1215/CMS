<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login"); } ?>

<?php 
    // If ID is not set
    if (empty($_GET['id'])) {
        redirect("../photos");
    }

    $photo = Photo::find_by_id(htmlspecialchars($_GET['id']));

    // Let's make sure we got a Photo and title isn't an empty string.
    if ($photo && $photo->title != '') {
        $photo->delete_photo();
    } else {
        redirect("../photos");
    }
?>

<?php redirect("../admin/photos"); ?>


<?php include("includes/footer.php"); ?>