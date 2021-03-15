<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 

            $query = "SELECT * FROM users";
            $select_all_users = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_users)){
                $user_id = $row["user_id"];
                $user_name = $row["user_name"];
                $user_firstname = $row["user_firstname"];
                $user_lastname = $row["user_lastname"];
                $user_email = $row["user_email"];
                $user_image = $row["user_image"];
                $user_role = $row["user_role"];
                $created_at = $row["created_at"];

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>image</td>";
                echo "<td>$user_name</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";

                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                echo "<td>$created_at</td>";
                echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>EDIT</a></td>";
                echo "<td><a href='users.php?delete={$user_id}'>DELETE</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 
    
    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

        $delete_query = mysqli_query($connection, $query);

        header("Location: users.php");

    }

?>