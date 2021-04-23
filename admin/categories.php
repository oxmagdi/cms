<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Area
                            <small>Author</small>
                        </h1>
                        
                        <!-- Add Category Form -->
                        <div class="col-xs-6">
                            <?php insert_Category(); ?>


                                
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php 

                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    include "includes/categories/update_category.php";
                                } 
                            ?>
                        </div><!-- End Add Category Form -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php the_all_categories(); ?>
                                </tbody>
                            </table>
                        </div>

                        <?php delete_category(); ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
