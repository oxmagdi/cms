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

                                case 'add_user':
                                    include "includes/users/add_user.php";
                                break;

                                case 'edit_user':
                                    include "includes/users/edit_user.php";
                                break;

                                case '300':
                                    echo 'NICE 300';
                                break;

                                default:
                                    include "includes/users/view_all_users.php";
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
