<?php include "includes/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <?php 
                    if(isset($_GET['p_id'])){ // check post id 
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
            ?>


                <hr>

                <!-- Blog Comments -->
                <?php 
                    if(isset($_POST['create_comment'])){
                        $comment_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        
                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        
                        $query .= "VALUES ($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now());";

                        $create_comment_query_result = mysqli_query($connection, $query);

                        if(! $create_comment_query_result){
                            die("QUERY FAILD ". mysqli_error($connection));
                        }

                        // increase comments count by one
                        $query = "UPDATE posts SET post_comment_count = post_comment_count +1 "; 
                        $query .= "WHERE post_id = {$comment_post_id};";

                        $increase_comment_count_result = mysqli_query($connection, $query);
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="email">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                    $query = "SELECT  comment_author, comment_content, comment_date FROM comments ";
                    $query .= "WHERE comment_post_id = {$post_id} AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id desc;";

                    $select_comments_results = mysqli_query($connection, $query);

                    if(!$select_comments_results){
                        die('QUERY FAILD '. mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($select_comments_results)) {
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <!-- Comment -->
            <?php 
                    } // end loop thorw comments while block
                } // end check post id if block
            ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>