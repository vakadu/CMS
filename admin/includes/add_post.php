<?php
if (isset($_POST['create_post'])){
    $post_category_id = $_POST['post_category'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_date = date('d-m-y');
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_content = str_replace("'", "''", $post_content);
    $post_comment_count = 0;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query  = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}',  '{$post_author}',  now(), 
    '{$post_image}','{$post_content}', '{$post_tags}',  '{$post_comment_count}',
    '{$post_status}' )";
    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);
    $last_id = mysqli_insert_id($connection);
    echo "<div class='alert alert-success text-center'>
            <div class='container-fluid'>
              <div class='alert-icon'>
                <i class='material-icons'>check</i>
              </div>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'><i class='material-icons'>clear</i></span>
              </button>
              <b>Success! </b> {$post_title} post created.<b><a href=
              '../post.php?p_id={$last_id}'> View Post</a> </b>
            </div>
          </div>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" class="form-control">
            <option value=''>All Categories</option>
            <?php
            $query = "SELECT * FROM categories";
            $category_query = mysqli_query($connection, $query);
            confirmQuery($category_query);
            while($row = mysqli_fetch_assoc($category_query)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>

        </select>
    </div>

<!--    <div class="form-group">-->
<!--        <label for="post_users">Users</label>-->
<!--        <select name="post_users" class="form-control">-->
<!--            <option value=''>All Users</option>-->
<!--            --><?php
//            $query = "SELECT * FROM users";
//            $select_users = mysqli_query($connection, $query);
//            confirmQuery($select_users);
//            while($row = mysqli_fetch_assoc($select_users)) {
//                $user_id = $row["user_id"];
//                $username = $row["username"];
//                echo "<option value='{$user_id}'>{$username}</option>";
//            }
//            ?>
<!--        </select>-->
<!--    </div>-->

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control">
            <option value='draft'>Select Options</option>
            <option value='publish'>Publish</option>
            <option value='draft'>Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Upload Image</label>
       <input id="file_input_file" class="form-control" type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="6"
                  class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>