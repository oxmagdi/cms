<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 <?php 

if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($email) && !empty($password))
    {
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);
        
        $query = "INSERT INTO users (user_name, user_password, user_email, user_role)";
        $query .= " VALUES('{$username}', '{$hash}', '{$email}', 'subscriber');";
        $insert_user_query = mysqli_query($connection, $query);

        if(!$insert_user_query)
        {
            die('QUERY FAILD'.mysqli_error($connection));
        }

        $messages = ["User created :)"];

        // if (password_verify($password, $hash)) {
        //     echo 'Password is valid!';
        // } else {
        //     echo 'Password is not valid!';
        // }
    }
    
}

?>

    <!-- Page Content -->
    <div class="container">
    
    <?php 
        if(!empty($messages))
        {
            foreach($messages as $message){
    ?>
        <div class="alert alert-success" role="alert">
          <?php echo $message; ?>
        </div>
    <?php 
            } // end while
        } // end if
    ?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
