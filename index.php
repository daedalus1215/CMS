<?php include("includes/header.php"); ?>

<?php

// make sure we get the page, if we don't have one then we know we must be on page one.
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1; 

$items_per_page = 4; // limit how many items per page.

$items_total_count = Photo::count_all();



?>

<?php $photos = Photo::find_all(); ?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">
                <?php foreach($photos as $photo): ?>
                
                    <div class="col-xs-6 col-md-3">
                        <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                            <img class="img-responsive home-page-photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="<?php $photo->alternate_text; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
                </div>                                               
            </div>

        <!-- /.row -->
        </div>
        <?php include("includes/footer.php"); ?>
