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
                    <form method="post" action="" enctype="multipart">                                                               
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input name="first_name" type="text" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="caption">Last Name</label>
                            <input name="last_name" type="text" class="form-control"/>
                        </div>                                                          


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input name="username" type="text" class="form-control"/>
                        </div>

                       <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control"/>
                        </div>
                    </form>                    
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>