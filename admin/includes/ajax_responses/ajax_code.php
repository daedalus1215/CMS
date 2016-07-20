<?php require_once("../init.php"); ?>

<?php

if (isset($_POST['image_name']) && trim(htmlspecialchars($_POST['image_name'])) != '') {
    $user = User::find_by_id(htmlspecialchars($_POST['user_id']));
    if ($user) {
        // Just save the new image.
        $user->ajax_save_user_image(htmlspecialchars($_POST['image_name']));
    }
} else if (isset($_POST['photo_id']) && trim(htmlspecialchars($_POST['photo_id'])) != '') {
    $photo = Photo::find_by_id(trim(htmlspecialchars($_POST['photo_id'])));
    if ($photo) {
        echo "It Works";
    }
} else {
    echo "Can't save this image.";
}