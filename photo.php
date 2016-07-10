<?php require_once 'admin/includes/init.php';?>

<?php 


if (empty($_GET['id'] || empty($_POST['photo_id']))) {
    redirect('index.php');
}


$photo = (!empty($_GET['id'])) ? Photo::find_by_id($_GET['id']) : Photo::find_by_id($_POST['photo_id']);

$d = "";
if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    
    if ($author != '' && $body != '') {
        $new_comment = Comment::create_comment($photo->id, $author, $body);
           if ($new_comment && $new_comment->save()) {
                unset($_POST['submit']);
                redirect("photo.php?id={$photo->id}");
            } else {
                $message = "issue with saving.";
                echo $message;
            }
    }     
} else {
    $arthur = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);


?>






<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo 'admin'.DS.'images'.DS.$photo->filename?>" alt="<?php echo $print->alternate_text; ?>">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->description; ?></p>
                <p><?php echo $photo->caption; ?></p>
                
                <hr>

                <!-- Blog Comments -->

                
                
                
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="photo.php" method="post">                        
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>                                                
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <input name="photo_id" type="hidden" value="<?php echo $photo->id; ?>">
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                
                
                
                
                
                
                <hr>

                <!-- Posted Comments -->

                <?php foreach ($comments as $comment) :?>
                
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small>July 09, 2016 at 9:30 AM</small>
                        </h4>
                        <p><?php echo $comment->body; ?></p>
                        
                    </div>
                </div>
                
              <?php endforeach;?>

            </div>

           

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
