<?php 
include "db.php";
// Start the session
session_start();

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(!empty($username) && !empty($password)){
		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT user_id, user_name as 'username', user_password as 'password', user_firstname as 'firstname', user_lastname as 'lastname', user_email as 'email', user_role as 'role'";
		$query .= " FROM users WHERE user_name='{$username}';";
		$fetch_user_query_result = mysqli_query($connection, $query);

		if(!$fetch_user_query_result){
			die('QUERY FAILD'.mysqli_error($connection));
		}

		while ($row = mysqli_fetch_array($fetch_user_query_result)) {
			echo $db_user_id        = $row['user_id'];   echo "<br>";
			echo $db_user_name      = $row['username'];  echo "<br>";
			echo $db_user_password  = $row['password'];  echo "<br>";
			echo $db_user_firstname = $row['firstname']; echo "<br>";
			echo $db_user_lastname  = $row['lastname'];  echo "<br>";
			echo $db_user_email     = $row['email'];     echo "<br>";
			echo $db_user_role      = $row['role'];      echo "<br>";
		}
			
		if($username == $db_user_name && password_verify($password, $db_user_password))
		{
			echo "um logged";

			$_SESSION['user_id']        = $db_user_id;
			$_SESSION['username']       = $db_user_name;
			$_SESSION['user_firstname'] = $db_user_firstname;
			$_SESSION['user_lastname']  = $db_user_lastname;
			$_SESSION['user_email']     = $db_user_email;
			$_SESSION['user_role']      = $db_user_role;

			header('Location: ../admin');
		} else {
			header('Location: ../index.php');
		}
	}
}