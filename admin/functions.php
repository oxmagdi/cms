<?php 


/*
* @descr : Insert new category into db
*
* @global : $connection
*
* @return void
*/
function insert_Category(){
	global $connection;

	// Check if add category form was submitted
    if(isset($_POST['submit'])){
    	// @var string $cat_title: set category title
        $cat_title = $_POST['cat_title'];

        // Check if $cat_title is not empty
        if($cat_title == '' || empty($cat_title)){
        	// Display error message
            echo "<span style='color:red;'>This field should not be empty!</span>";
        } else {

        	// @var string $query : set insert query
            $query = "INSERT INTO categories (cat_title) ";
            $query .= "VALUES ('{$cat_title}');";

            // @var array $insert_category_query_result : excute insert query
            $insert_category_query_result = mysqli_query($connection, $query);

            // handle error
            if(!$insert_category_query_result){
                die('QUERY FAILED ' . mysqli_error($connection));
            }
        }
    }
                            
}

/*
* @descr : Delete specific category from database
*
* @global : $connection
*
* @return void
*/
function delete_category(){
	global $connection;

	// Check if delete category request was fired
    if(isset($_GET['delete'])){
    	// @var integer $get_delete_cat_id : set category id
        $get_delete_cat_id = $_GET['delete'];

        // Check if $get_delete_cat_id is not empty
        if(!empty($get_delete_cat_id)){
        	// @var string $query : set delete query
            $query = "DELETE FROM categories WHERE cat_id = {$get_delete_cat_id}";

            // @var array $delete_query_result : excute delete query
            $delete_query_result = mysqli_query($connection, $query);

            // Refresh the page 
            header("Location: categories.php");
        }
    }
}

/*
* @descr : Display all categories in categories table 
*
* @global : $connection
*
* @return void
*/
function the_all_categories(){
	global $connection;

    // @var string $query : set select query
    $query = "SELECT * FROM categories";
    
    // @var array $all_categories_query_result : excute select query
    $all_categories_query_result = mysqli_query($connection, $query);

    //  loop throw $all_categories_query_result
    while($row = mysqli_fetch_assoc($all_categories_query_result)){
        
        // @var integer $cat_id : set category id 
        $cat_id = $row['cat_id'];
        
        // @var string $cat_title : set category title 
        $cat_title = $row['cat_title'];
        
        // print table row 
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
                                
}


?>