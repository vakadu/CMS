<?php include 'includes/database.php'; ?>

<?php include 'includes/header.php'; ?>

<?php

if (isset($_POST['submit'])){

    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($firstname) && !empty($lastname) && !empty($username) && !empty($email) &&
        !empty($password)){

        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $password = password_hash($password, PASSWORD_BCRYPT);

//////////////////////// previous password salt ////////////////////
//        $query = "SELECT randSalt From users ";
//        $select_randsalt_query = mysqli_query($connection, $query);
//        if (!$select_randsalt_query){
//            die("Query Failed " . mysqli_error($connection));
//        }
//        $row = mysqli_fetch_array($select_randsalt_query);
//        $salt = $row['randSalt'];
//        $password = crypt($password, $salt);

        $query  = "INSERT INTO users (user_firstname, user_lastname, username, 
user_email, user_password, user_role) ";
        $query .= "VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$email}', 
        '{$password}', 'Subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query){
            die("Query Failed " . mysqli_error($connection));
        }

        $message = "<div class='alert alert-success text-center'>
                        <div class='container-fluid'>
                          <div class='alert-icon'>
                            <i class='material-icons'>check</i>
                          </div>
                          <button type='button' class='close' data-dismiss='alert' 
                          aria-label='Close'>
                            <span aria-hidden='true'><i 
                            class='material-icons'>clear</i></span>
                          </button>
                          <b>Success! </b> Your registration has been submitted.
                        </div>
                     </div>";
    }
    else{
        $message = "<div class='alert alert-danger text-center'>
                        <div class='container-fluid'>
                          <div class='alert-icon'>
                            <i class='material-icons'>error_outline</i>
                          </div>
                          <button type='button' class='close' data-dismiss='alert' 
                          aria-label='Close'>
                            <span aria-hidden='true'><i 
                            class='material-icons'>clear</i></span>
                          </button>
                          <b>Error! </b> Fields cannot be empty.
                        </div>
                     </div>";
    }
}
else{
    $message = "";
}

?>

<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container main-content">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-warp">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post"
                              id="login-form" autocomplete="off">
                            <p class="lead"><?php echo $message; ?></p>
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control"
                                       placeholder="Firstname">
                            </div>
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control"
                                       placeholder="Lastname">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control"
                                       placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email"
                                       class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password"
                                       class="form-control" placeholder="Password">
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn
                            btn-primary" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.container -->

<?php include 'includes/footer.php'; ?>