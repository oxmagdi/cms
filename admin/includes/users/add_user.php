
<?php 
	
	if(isset($_POST['create_user'])){

			/* echo */ $user_firstname = $_POST['user_firstname'];
			/* echo */ $user_lastname = $_POST['user_lastname'];
			/* echo */ $user_name = $_POST['user_name'];
			/* echo */ $user_email = $_POST['user_email'];
			/* echo */ $user_password = $_POST['user_password'];
			/* echo */ $user_image = NULL;
			/* echo */ $user_role = $_POST['user_role'];
			/* echo */ $randSalt = NULL;

			if(isset($_FILES['image'])){
				$user_image = $_FILES['image']['name'];
				$user_image_temp = $_FILES['image']['tmp_name'];

				// move image from temporary directory to our directory
				move_uploaded_file($post_image_temp, "../images/$post_image");
			}

			$query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_role) ";
			$query .="VALUES('{$user_name}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}');";

			// echo $query;

			$create_user_query_result = mysqli_query($connection, $query);
			confirm_query($create_user_query_result);

        	header("Location: users.php");
			
	}

?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="user_lastname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_name">Username</label>
		<input type="text" class="form-control" name="user_name">
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>

<!-- 	<div class="form-group">
		<label for="post_image">User Image</label>
		<input type="file" name="image">
	</div> -->

	<div class="form-group">
		<label for="post_category_id">User Role: </label>
		<select class="form-control" name="user_role" id="user_role">
				<option value="admin">admin</option>
				<option value="subscriber">subscriber</option>
		</select>	
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>


</form>