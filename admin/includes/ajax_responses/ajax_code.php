<?php require_once("../init.php"); ?>

<?php

if (isset($_POST['image_name']) && trim(htmlspecialchars($_POST['image_name'])) != '') {
    $user = User::find_by_id(htmlspecialchars($_POST['user_id']));
    if ($user) {
        // Just save the new image.
        $user->ajax_save_user_image(htmlspecialchars($_POST['image_name']));
    }
} else {
    echo "Can't save this image.";
}