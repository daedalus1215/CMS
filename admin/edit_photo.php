<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login"); } ?>

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
                    
                    <div class="col-md-8">
                        <form>
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