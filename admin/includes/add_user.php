<?php
if (isset($_POST['create_user'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password, PASSWORD_BCRYPT);

//    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query  = "INSERT INTO users(user_firstname, user_lastname, username, 
               user_role, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$username}',
              '{$user_role}','{$user_email}', '{$user_password}')";
    $insert_user_query = mysqli_query($connection, $query);

    confirmQuery($insert_user_query);

    echo "<div class='alert alert-success'>
            <div class='container-fluid'>
              <div class='alert-icon'>
                <i class='material-icons'>check</i>
              </div>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'><i class='material-icons'>clear</i></span>
              </button>
              <b>Success! </b> User is Created.
            </div>
          </div>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="user_role" class="form-control">
            <option value='subscriber'>Select Role</option>;
            <option value='admin'>Admin</option>;
            <option value='subscriber'>Subscriber</option>;
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

<!--    <div class="form-group">-->
<!--        <div class="file_input_div">-->
<!--            <div class="file_input">-->
<!--                <i class="material-icons md-48">file_upload</i>-->
<!--                <input id="file_input_file" class="none" type="file" name="image">-->
<!--            </div>-->
<!--            <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">-->
<!--                <input class="file_input_text mdl-textfield__input form-control" type="text" disabled readonly id="file_input_text"-->
<!--                       style="color: #1a1a1a" placeholder="Upload Images">-->
<!--                <label class="mdl-textfield__label" for="file_input_text"></label>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add
        user">
    </div>
</form>