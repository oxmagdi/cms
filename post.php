<?php include "includes/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <?php 
                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];


                        $query = "SELECT * FROM posts WHERE post_id = $post_id;";
                        $select_posts_query_result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_posts_query_result)){
                            $post_id = $row["post_id"];
                            $post_author = $row["post_author"];
                            $post_title = $row["post_title"];
                            $post_category_id = $row["post_category_id"];
                            $post_status = $row["post_status"];
                            $post_image = $row["post_image"];
                            $post_tags = $row["post_tags"];
                            $post_comment_count = $row["post_comment_count"];
                            $post_date = $row["post_date"];
                            $post_content = substr($row["post_content"], 0, 30);
                ?>

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content; ?></p>

            <?php 
                    }
                } 
            ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>