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
                        <?php 
                            $source = '';
                            
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }

                            switch($source) {

                                case 'add_post':
                                    include "includes/posts/add_post.php";
                                break;

                                case 'edit_post':
                                    include "includes/posts/edit_post.php";
                                break;

                                case '300':
                                    echo 'NICE 300';
                                break;

                                default:
                                    include "includes/posts/view_all_posts.php";
                                break;
                            }
                        ?>
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
