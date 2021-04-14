
<?php 

	if(isset($_GET['u_id'])){
		$the_user_id = $_GET['u_id'];
	
		if(isset($_POST['edit_user'])){
				 // echo $the_user_id;
				 /* echo */ $user_firstname = $_POST['user_firstname'];
				 /* echo */ $user_lastname  = $_POST['user_lastname'];
				 /* echo */ $user_name      = $_POST['user_name'];
				 /* echo */ $user_email     = $_POST['user_email'];
				 /* echo */ $user_password  = $_POST['user_password'];
				 /* echo */ $user_image     = NULL;
				 /* echo */ $user_role      = $_POST['user_role'];

				if(isset($_FILES['image'])){
					$user_image = $_FILES['image']['name'];
					$user_image_temp = $_FILES['image']['tmp_name'];

					// move image from temporary directory to our directory
					move_uploaded_file($post_image_temp, "../images/$post_image");
				}

				$query = "UPDATE users SET ";
				$query .= "user_firstname = '{$user_firstname}',";
				$query .= "user_lastname = '{$user_lastname}',";
				$query .= "user_name = '{$user_name}',";
				$query .= "user_email = '{$user_email}',";
				if(!empty($user_password))
				{
					$hash = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 8]);
					$query .= "user_password = '{$hash}',";
				}
				$query .= "user_role = '{$user_role}' ";
				$query .= "WHERE user_id = {$the_user_id} ;";
				// echo $query;

				$update_user_query_result = mysqli_query($connection, $query);
				confirm_query($update_user_query_result);
        		
        		header("Location: users.php");
				
		}

	
	    $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
	    $select_user_by_id = mysqli_query($connection, $query);

	    while($row = mysqli_fetch_assoc($select_user_by_id)){
	        $the_user_id = $row["user_id"];
	        /* echo */ $the_user_firstname = $row['user_firstname'];
			/* echo */ $the_user_lastname = $row['user_lastname'];
			/* echo */ $the_user_name = $row['user_name'];
			/* echo */ $the_user_email = $row['user_email'];
			/* echo */ $the_user_password = $row['user_password'];
			/* echo */ $the_user_role = $row['user_role'];
			// echo  $user_image = NULL;
			// echo  $randSalt = NULL;
	    }
	}

?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname" value="<?php echo $the_user_firstname; ?>">
	</div>

	<div class="form-group">
		<label for="user_lastname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname" value="<?php echo $the_user_lastname; ?>">
	</div>

	<div class="form-group">
		<label for="user_name">Username</label>
		<input type="text" class="form-control" name="user_name" value="<?php echo $the_user_name; ?>">
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email" value="<?php echo $the_user_email; ?>">
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
				<?php if($the_user_role == 'admin') { ?>
					<option selected=true value="admin">admin</option>
					<option value="subscriber">subscriber</option>
				<?php } else { ?>
					<option value="admin">admin</option>
					<option selected=true value="subscriber">subscriber</option>
				<?php } ?>
		</select>	
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
	</div>


</form>