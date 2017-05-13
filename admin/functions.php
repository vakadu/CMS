<?php

function confirmQuery($result){

    global $connection;
    if (!$result){
        die("Query Failed " . mysqli_error($connection));
    }
}

function insert_categories(){

    global $connection;
    if (isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)){
            echo "<div class='alert alert-danger'>
                    <div class='container-fluid'>
                      <div class='alert-icon'>
                        <i class='material-icons'>error_outline</i>
                      </div>
                      <button type='button' class='close' data-dismiss='alert' 
                      aria-label='Close'>
                        <span aria-hidden='true'><i class='material-icons'>clear</i></span>
                      </button>
                      <b>Error! </b>  This field should not be empty
                    </div>
                   </div>";
        }else{
            $query  = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}') ";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query){
                die("Query failed " . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories(){

    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){

    global $connection;
    if (isset($_GET['delete'])){
        $cat_id_delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete} ";
        $delete_query = mysqli_query($connection, $query);
        //refreshing page once category is deleted
        header("Location: categories.php");
    }
}

function users_online(){

    global $connection;
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 300;//amount of time user will be marked if offline
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if ($count == null){
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    }
    else{
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    return $count_user = mysqli_num_rows($users_online_query);
}