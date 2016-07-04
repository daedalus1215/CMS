<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login"); } ?>

<?php 

if (empty($_GET['id'])) {
    redirect("../photos");
}

$photo = Photo::find_by_id(htmlspecialchars($_GET['id']));

if ($photo) {
    $photo->delete_photo();
} else {
    redirect("../photos");
}
?>

<?php redirect("../admin/photos"); ?>


<?php include("includes/footer.php"); ?>