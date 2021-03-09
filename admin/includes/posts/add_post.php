
<?php 
	
	if(isset($_POST['create_post'])){
		if(isset($_FILES['image'])){

			$post_title = $_POST['post_title'];
			$post_category_id = $_POST['post_category'];
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

			$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
			$query .="VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}');";

			$create_post_query_result = mysqli_query($connection, $query);
			confirm_query($create_post_query_result);
		} else {
			echo "<span style='color:red;'>Something wrong!</span> <br>";
		}
	}

?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
		<label for="post_category_id">Post Category : </label>
		<select class="form-control" name="post_category" id="post_category_id">
			<?php 

				$query = "SELECT * FROM categories WHERE 1";
				$select_all_categories = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_assoc($select_all_categories)) {
					# code...
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];
			?>
				<option value=<?php echo $cat_id ?> > <?php echo $cat_title; ?></option>
			<?php } ?>
		</select>	
	</div>

	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input type="text" class="form-control" name="post_author">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status">
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_post" value="Publis Post">
	</div>


</form>