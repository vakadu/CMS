<?php

function confirmQuery($result){

    global $connection;
    if (!$result){
        die("Query Failed " . mysqli_error($connection));
    }
}

function redirect($location){

    header("Location: " . $location);
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

/* for counting things in charts and boxes on dashboard*/
function recordCount($table){

    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_tables = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_tables);
    confirmQuery($result);
    return $result;
}

function isAdmin($username = ''){

    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if ($row['user_role'] == 'Admin'){
        return true;
    }
    else{
        return false;
    }
}

function username_exists($username){

    global $connection;
    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if (mysqli_num_rows($result) > 0){
        return true;
    }
    else{
        return false;
    }
}

function email_exists($email){

    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if (mysqli_num_rows($result) > 0){
        return true;
    }
    else{
        return false;
    }
}

function register_user($firstname, $lastname, $username, $email, $password){

    global $connection;

    $firstname = mysqli_real_escape_string($connection, $firstname);
    $lastname = mysqli_real_escape_string($connection, $lastname);
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $password = password_hash($password, PASSWORD_BCRYPT);

    $query  = "INSERT INTO users (user_firstname, user_lastname, username, 
user_email, user_password, user_role) ";
    $query .= "VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$email}', 
    '{$password}', 'Subscriber')";
    $register_user_query = mysqli_query($connection, $query);
    if (!$register_user_query){
        die("Query Failed " . mysqli_error($connection));
    }

    //////////////////////// previous password salt ////////////////////
//        $query = "SELECT randSalt From users ";
//        $select_randsalt_query = mysqli_query($connection, $query);
//        if (!$select_randsalt_query){
//            die("Query Failed " . mysqli_error($connection));
//        }
//        $row = mysqli_fetch_array($select_randsalt_query);
//        $salt = $row['randSalt'];
//        $password = crypt($password, $salt);

}

function login_user($username, $password){

    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query){
        die("Query Failed " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    if(password_verify($password, $db_user_password)){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        redirect("/CMS/admin/");
    }
    else{
        redirect("/CMS/index.php");
    }


///////////// Previous crypt password /////////////////
    //$password = crypt($password, $db_user_password);

//    if ($username !== $db_username && $password !== $db_user_password){
//        header("Location: ../index.php");
//    }
//    else{
//        $_SESSION['username'] = $db_username;
//        $_SESSION['firstname'] = $db_user_firstname;
//        $_SESSION['lastname'] = $db_user_lastname;
//        $_SESSION['user_role'] = $db_user_role;
//        header("Location: ../admin");
//    }
}