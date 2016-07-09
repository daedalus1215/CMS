<!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        ADMIN
                        <small>Subheading</small>
                    </h1>


<?php
    include("includes/User.php");
/*
    $users = User::find_all();
    foreach ($users as $user) {
        echo $user->username . '<br/>';
    }
*/

/*
    $user = new User();
    $user->username = "NEW_USER";
    $user->save();
*/

    /*
    $photos = Photo::find_all();

    foreach ($photos as $photo) {
        echo $photo->title;
    }
    */
    
    /*
        $user = User::find_by_id(2);
        echo "username = " . $user->username;
        $result = $user->delete();
        echo $result;
    */
?>                   
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
        