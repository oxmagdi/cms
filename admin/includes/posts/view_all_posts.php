<?php 

if(isset($_POST['checkBoxArray']))
{
    $checkBoxArray = $_POST['checkBoxArray'];

    foreach($checkBoxArray as $postValueId)
    {
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options)
        {
            case 'published':
            
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                        
                $update_to_published_status = mysqli_query($connection,$query);       
                confirm_query($update_to_published_status);
                
            break;
                
                
            case 'draft':
            
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                        
                $update_to_draft_status = mysqli_query($connection,$query);
                            
                confirm_query($update_to_draft_status);

            break;
                
            case 'delete':
            
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
                        
                $update_to_delete_status = mysqli_query($connection,$query);
                            
                confirm_query($update_to_delete_status);  
                
            break;

            case 'clone':

                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);
    
                while ($row = mysqli_fetch_array($select_post_query)) 
                {
                    $post_title         = $row['post_title'];
                    $post_category_id   = $row['post_category_id'];
                    $post_date          = $row['post_date']; 
                    $post_author        = $row['post_author'];
                    $post_status        = $row['post_status'];
                    $post_image         = $row['post_image'] ; 
                    $post_tags          = $row['post_tags']; 
                    $post_content       = $row['post_content'];

                }

                    
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
                    
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

                $copy_query = mysqli_query($connection, $query);   

                if(!$copy_query )
                {

                    die("QUERY FAILED" . mysqli_error($connection));
                }   
                    
            break;

        } // end switch
    } // end foreach
} // end if


?>


<form action="" method="post">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" style="margin-bottom:10px;" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>

        </div> 

        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

        </div>

        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                $query = "SELECT * FROM posts";
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

                    echo "<tr>";
                    ?>
                        <td><input type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>" id="" class="checkBoxes"></td>
                    <?php
                    echo "<td>{$post_id}</td>";
                    echo "<td>{$post_author}</td>";
                    echo "<td>{$post_title}</td>";

                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id;";
                    $select_category = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_category)) {
                        # code...
                        $cat_title = $row['cat_title'];
                        echo "<td>{$cat_title}</td>";
                    }

                    echo "<td>{$post_status}</td>";
                    echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
                    echo "<td>{$post_tags}</td>";
                    echo "<td>{$post_comment_count}</td>";
                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a href='posts.php?delete_post={$post_id}'>DELETE</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</form>


<?php 
    
    if (isset($_GET['delete_post'])) {
        $the_post_id = $_GET['delete_post'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
        $delete_post_query_result = mysqli_query($connection, $query);

        header("Location: posts.php");
    }

?>