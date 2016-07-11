<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 
    // if no id we shouldn't even be here.
    if (empty($_GET['id'])) {
        redirect('users.php');        
    }
    
    // see if the user has submitted the edit form.
    if (isset($_POST['update'])) {
        // instantiating a existing photo object.
        $user = User::find_by_id(trim(htmlspecialchars($_GET['id'])));

        // if we successfully instantiated a photo object.
        if ($user) {
            $user->first_name = htmlspecialchars($_POST['first_name']);
            $user->last_name  = htmlspecialchars($_POST['last_name']);
            $user->username   = htmlspecialchars($_POST['username']);
            $user->password   = htmlspecialchars($_POST['password']);
            if (!empty($_FILES['user_image'])) {
                $user->set_file($_FILES['user_image']);
            }
            $user->save_user_and_image();                
            redirect('users.php');
        }        
    }
    // User did not submit the edit form but entered by clicking on a photo 
     else {
        // instantiating a existing photo object.
        $user = User::find_by_id(trim(htmlspecialchars($_GET['id'])));
                
        // if we didn't successfully instantiated a photo object.          
        if (!$user) {
            redirect('users.php');
        }
    }



?>

    <?php include('includes/photo_library_modal.php'); ?>

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
                    
                    
                <div class="col-md-6">
                    <a href="#" data-toggle="modal" data-target="#photo-modal"><img class="img-responsive" src="<?php echo $user->getImage(); ?>" alt=""></a>
                </div>    
                    
                    
                    
                    
                         <!--Shorten  center-   col-md-offset-3-->
                <div class="col-md-6">
                    <form method="post" action="" enctype="multipart/form-data">                                                               
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input name="first_name" type="text" class="form-control" value="<?php echo $user->first_name ;?>"/>
                        </div>

                        <div class="form-group">
                            <label for="caption">Last Name</label>
                            <input name="last_name" type="text" class="form-control" value="<?php echo $user->last_name ;?>"/>
                        </div>                                                          


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input name="username" type="text" class="form-control" value="<?php echo $user->username ;?>"/>
                        </div>

                       <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" value="<?php echo $user->password; ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <input type="file" name="user_image" >
                        </div>
                        
                        <div class="form-group">
                            <a href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                            <input name="update" value="Update" type="submit" class="btn btn-primary pull-right">
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