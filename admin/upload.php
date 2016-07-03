<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login"); } ?>


<?php 
    if (isset($_POST['submit'])) {
        
        $photo = new Photo();
        $photo->title = htmlspecialchars($_POST['title']);
        print_r($_FILES['file_upload']);
        $photo->set_file($_FILES['file_upload']);        
        
        if ($photo->save()) {
            $message = "Photo upload successfully.";
        } else {
            foreach ($photo->errors as $error) {
                print($error . "<br/>");
                $message[] = $error;
            }
        }
        
    }

?>
        <?php print_r($message); ?>
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
                            UPLOAD
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
                        
                        <div class="col-md-6">
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="title"></input>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file_upload"></input>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit"></input>
                                </div>
                            </form>
                        </div>   
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>

        
        