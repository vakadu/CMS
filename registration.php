<?php include 'includes/database.php'; ?>

<?php include 'admin/functions.php'; ?>

<?php include 'includes/header.php'; ?>

<?php

//if (isset($_POST['register'])){
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $firstname = trim($_POST['first_name']);
    $lastname  = trim($_POST['last_name']);
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);

    $error = ['first_name' => '', 'last_name' => '' ,'username' => '', 'email' => '', 'password' => ''];

    if (strlen($firstname) < 3){

        $error['first_name'] = 'First Name needs to be longer';
    }

    if (strlen($lastname) < 3){

        $error['last_name'] = 'Last Name needs to be longer';
    }

    if (strlen($username) < 4){

        $error['username'] = 'Username needs to be longer';
    }

    if ($username == ''){

        $error['username'] = 'Username cannot be empty';
    }

    if ($password == ''){

        $error['password'] = 'Password cannot be empty';
    }

    if ($firstname == ''){

        $error['first_name'] = 'First Name cannot be empty';
    }

    if ($lastname == ''){

        $error['last_name'] = 'Last Name cannot be empty';
    }

    if ($email == ''){

        $error['email'] = 'Email cannot be empty';
    }

    if (username_exists($username)){

        $error['username'] = 'Username already exists, pick another username';
    }

    if (email_exists($email)){

        $error['email'] = 'Email already exists, pick another email';
    }


    foreach ($error as $key => $value){

        if (empty($value)){

           unset($error[$key]);
        }
    }

    if (empty($error)){

        register_user($firstname, $lastname, $username, $email, $password);
        login_user($username, $password);
    }

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
<!--                            <p class="lead">--><?php //echo $message; ?><!--</p>-->
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control"
                                       placeholder="Firstname" autocomplete="on"
                                value="<?php echo isset($firstname) ? $firstname : ''; ?>">
                                <p><?php echo isset($error['first_name']) ? $error['first_name'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control"
                                       placeholder="Lastname" autocomplete="on"
                                 value="<?php echo isset($lastname) ? $lastname : ''; ?>">
                                <p><?php echo isset($error['last_name']) ? $error['last_name'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control"
                                       placeholder="Username" autocomplete="on"
                                value="<?php echo isset($username) ? $username : ''; ?>">
                                <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email"
                                       class="form-control" placeholder="Email"
                                       autocomplete="on"
                                value="<?php echo isset($email) ? $email : ''; ?>">
                                <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password"
                                       class="form-control" placeholder="Password">
                                <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>
                            </div>
                            <input type="submit" name="register" id="btn-login" class="btn
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