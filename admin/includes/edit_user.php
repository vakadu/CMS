<?php

if (isset($_GET['edit_user'])){

    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['edit_user'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname ='{$user_lastname}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$the_user_id}";
    $update_query = mysqli_query($connection, $query);
    confirmQuery($update_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo
        $user_firstname; ?>">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo
        $user_lastname; ?>">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo
        $username; ?>">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="user_role" class="form-control">
            <option value="Subscriber"><?php echo $user_role; ?></option>
            <?php
            if ($user_role == 'Admin'){
                echo "<option value='Subscriber'>Subscriber</option>";
            }
            else {
                echo "<option value='Admin'>Admin</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo
        $user_email; ?>">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php
        echo $user_password; ?>">
    </div>

<!--        <div class="form-group">-->
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update
        user">
    </div>
</form>