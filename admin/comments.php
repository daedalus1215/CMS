<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php"); }?>

<?php 

$comments = Comment::find_all();

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
                            USERS
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
                        
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo's Id</th>
                                        <th>Author</th>
                                        <th>Body</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($comments as $comment):?>
                                    <tr>                                                                                                                       
                                        <td>
                                            <?php echo $comment->id; ?>
                                            <!-- Control of each one. -->
                                            <div class="picture_link">
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                                <a href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a>
                                                <a href="view_comment.php?id=<?php echo $comment->id; ?>">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $comment->photo_id?>
                                        </td>
                                        <td>
                                            <?php echo $comment->author; ?>
                                        </td>
                                        <td>
                                            <?php echo $comment->body; ?>
                                        </td>                                        
                                    </tr>                                       
                                    <?php endforeach; ?>    
                                       
                                </tbody>
                            </table>                                                                                   
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>