
<?php 
	
	if(isset($_GET['p_id'])){
		$the_post_id = $_GET['p_id'];
	}
	
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $select_post_by_id_query_result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_post_by_id_query_result)){
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_title = $row["post_title"];
        $post_category_id = $row["post_category_id"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_content = $row["post_content"];
    }

    if(isset($_POST['edit_post'])){

    		$post_title = $_POST['post_title'];
			$post_category_id = $_POST['post_category_id'];
			$post_author = $_POST['post_author'];
			$post_status = $_POST['post_status'];

			$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];

			$post_tags = $_POST['post_tags'];
			$post_content = $_POST['post_content'];

			$post_date = date('d-m-y');
			$post_comment_count = 0;
			$post_views_count = 0;

			// move image from temporary directory to our directory
			move_uploaded_file($post_image_temp, "../images/$post_image");

			if(empty($post_image)){
				$query = "SELECT * FROM posts WHERE post_id = $the_post_id;";
				$select_image = mysqli_query($connection, $query);
				while($row = mysqli_fetch_array($select_image)){
					$post_image = $row['post_image'];
				}				
			}

			$query = "UPDATE posts SET ";
			$query .= "post_title = '{$post_title}',";
			$query .= "post_category_id = '{$post_category_id}',";
			$query .= "post_date = now(),";
			$query .= "post_author = '{$post_author}',";
			$query .= "post_status = '{$post_status}',";
			$query .= "post_tags = '{$post_tags}',";
			$query .= "post_content = '{$post_content}',";
			$query .= "post_image = '{$post_image}'";
			$query .= "WHERE post_id = '{$the_post_id}';";

			$update_post_query_result = mysqli_query($connection, $query);
			confirm_query($update_post_query_result);

    }

?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
	</div>

	<div class="form-group">
		<label for="post_category_id">Post Category : </label>
		<select class="form-control" name="post_category_id" id="post_category_id">
			<?php 

				$query = "SELECT * FROM categories WHERE 1";
				$select_all_categories = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_assoc($select_all_categories)) {
					# code...
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];

			?>
				<option <?php if($post_category_id == $cat_id) echo 'selected=true'; ?> value=<?php echo $cat_id ?> > <?php echo $cat_title; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input type="text" class="form-control" name="post_author"  value="<?php echo $post_author; ?>">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status"  value="<?php echo $post_status; ?>">
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
		<br>
		<img width="100" src="../images/<?php echo $post_image; ?>">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags"  value="<?php echo $post_tags; ?>">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
	</div>


</form>