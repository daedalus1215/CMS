<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login"); } ?>

<?php 
    
    // see if the user has submitted the edit form.
    if (isset($_POST['update'])) {
        // instantiating a existing photo object.
        $photo = Photo::find_by_id(trim(htmlspecialchars($_POST['id'])));
                
        // if update did occur.
        if (isset($_POST['update'])) {
            // if we successfully instantiated a photo object.
            if ($photo) {
                $photo->title           = $_POST['title'];
                $photo->alternate_text  = $_POST['alternate_text'];
                $photo->caption         =$_POST['caption'];
                $photo->description     = $_POST['description'];
                $photo->save();
                redirect('photos');
            }
        }        
    }
    // User did not submit the edit form but entered by clicking on a photo 
    else if (empty($_GET['id'])) {
        redirect('photos');
    } else {
        // instantiating a existing photo object.
        $photo = Photo::find_by_id(trim(htmlspecialchars($_GET['id'])));
                
            // if we successfully instantiated a photo object.
            if ($post) {
                $photo->title           = $_POST['title'];
                $photo->alternate_text  = $_POST['alternate_text'];
                $photo->caption         =$_POST['caption'];
                $photo->description     = $_POST['description'];                
            }
     
    }



?>







    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include("includes/top_nav.php"); ?>
        <?php include("includes/side_nav.php"); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        ADMIN
                        <small>Subheading</small>
                    </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                </div>
                    
                    
                    
                    
                    
                    
                    
                        <div class="col-md-8">
                            <form method="post" action="edit_photo.php">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" class="form-control" value="<?php echo $photo->title;?>"></input>
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input name="caption" type="text" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="alternate_text">Alternative Text</label>                                
                                    <input name="alternate_text" type="text" class="form-control" value="<?php echo $photo->alternate_text;?>"/>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    
                                    <img class="thumbnail" style="height: 100px;" src="<?php echo $photo->picture_path(); ?>" alt="<?php echo $photo->alternate_text; ?>" />
                                </div>

                                <div for="description" class="form-group"><label>Description</label>                                
                                    <textarea name="description" cols="30" rows="10" class="form-control"><?php echo $photo->description;?></textarea>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $photo->id; ?>">
                        </div>
                    
                    
                            <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                       <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                    </div>
                                <div class="inside">
                                  <div class="box-inner">
                                     <p class="text">
                                       <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                      </p>
                                      <p class="text ">
                                        Photo Id: <span class="data photo_id_box">34</span>
                                      </p>
                                      <p class="text">
                                        Filename: <span class="data">image.jpg</span>
                                      </p>
                                     <p class="text">
                                      File Type: <span class="data">JPG</span>
                                     </p>
                                     <p class="text">
                                       File Size: <span class="data">3245345</span>
                                     </p>
                                  </div>
                                  <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                  </div>
                                </div>          
                            </div>
                        </div>
                    </form>                    
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>