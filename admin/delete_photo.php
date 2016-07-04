<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login"); } ?>

<?php 

if (empty($_GET['photo_id'])) {
    redirect("photos");
}

$photo = Photo::find_by_id(htmlspecialchars($_GET['photo_id']));

if ($photo) {
    $photo->delete();
} else {
    redirect("photos");
}

?>




<?php include("includes/footer.php"); ?>