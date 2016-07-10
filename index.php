<?php include("includes/header.php"); ?>

<?php

// make sure we get the page, if we don't have one then we know we must be on page one.
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1; 

$items_per_page = 4; // limit how many items per page.

$items_total_count = (int) Photo::count_all(); // all the photos


$paginate = new Paginate($page, $items_per_page, $items_total_count);


$sql  = "SELECT * FROM photos";
$sql .= " LIMIT {$items_per_page}";
$sql .= " OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);
?>
        <!-- PHOTOS -->
        <div class="row">            
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
        </div>

        <!-- PAGINATION -->
        <div class="row">
            <ul class="pager">
                <?php if ($paginate->page_total() > 1): ?> 
                    <?php if ($paginate->has_next()): ?>
                <li class="next"><a href="index.php?page=<?php echo $paginate->next(); ?>">Next</a></li>                        
                    <?php endif; ?>
                    <?php if ($paginate->has_previous() > 0): ?>
                        <li class="previous"><a href="index.php?page=<?php echo $paginate->previous(); ?>">Previous</a></li>
                    <?php endif; ?>
                <?php endif; ?>               
                
            </ul>
        </div>

        <?php include("includes/footer.php"); ?>
