<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login"); } ?>

<?php 
    
    // Make sure we have a photo id and that it is not invalid.
    if (empty($_GET['id']) || trim(htmlspecialchars($_GET['id'])) != '') {
        redirect('photos');
    } else {
        // instantiating a existing photo object.
        $photo = User::find_by_id(trim(htmlspecialchars($_GET['id'])));
        // if update did occur.
        if (isset($_POST['update'])) {
            // if we successfully instantiated a photo object.
            if ($post) {
                $_POST['title'];
                $_POST['alternate_text'];
                $_POST['caption'];
                $_POST['description'];
                $_POST[''];
                $_POST[''];
                $_POST[''];
            }
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
                                    <input name="title" type="text" class="form-control"></input>
                                </div>

                                <div class="form-group">
                                    <label for="title">Caption</label>
                                    <input name="caption" type="text" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="alternate_text">Alternative Text</label>                                
                                    <input name="alternate_text" type="text" class="form-control"/>
                                </div>

                                <div class="form-group">
                                   <input name="image" type="text" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <input name="image" type="text" class="form-control"/>
                                </div>

                                <div for="description" class="form-group"><label>Description</label>                                
                                    <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
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