<?php

include ("delete_modal.php");

if (isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $postValueId){
        $bulkOptions = $_POST['bulkOptions'];
        switch ($bulkOptions) {
            case 'publish':
                $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = 
{$postValueId}";
                $update_publish_status = mysqli_query($connection, $query);
                confirmQuery($update_publish_status);
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = 
{$postValueId}";
                $update_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_draft_status);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $delete_status = mysqli_query($connection, $query);
                confirmQuery($delete_status);
                break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
                $select_post_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    if (empty($post_content)){
                        $post_content = "No content for clone posts";
                    }
                }
                $query  = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
                $query .= "VALUES({$post_category_id}, '{$post_title}',  '{$post_author}',  now(), '{$post_image}','{$post_content}', '{$post_tags}',  '{$post_comment_count}', '{$post_status}' )";

                $copy_query = mysqli_query($connection, $query);
                if (!$copy_query){
                    die("Query Failed " . mysqli_error($connection));
                }
                break;
        }
    }
}
?>

<form action="" method="post">
    <table class="table table-responsive table-bordered">
        <div class="row">
            <div class="col-xs-4" id="bulkOptionsContainer">
                <select name="bulkOptions" id="" class="form-control">
                    <option value="">Select Options</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-primary" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>
        </div>
        <thead>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th class="col-xs-1">Date</th>
        <th class="col-xs-1">Post Views</th>
        <th class="col-xs-1">View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>

        <?php
//        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $query  = "SELECT posts.post_id, posts.post_author, posts.post_title, ";
        $query .= "posts.post_category_id, posts.post_status, posts.post_image, ";
        $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, ";
        $query .= "posts.post_views_count, categories.cat_id, categories.cat_title ";
        $query .= "FROM posts LEFT JOIN categories ON ";
        $query .= "posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            //$post_content = $row['post_content'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_views_count = $row['post_views_count'];

            $category_id = $row['cat_id'];
            $category_title = $row['cat_title'];

            echo "<tr>";
        ?>
            <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]"
                       value="<?php echo $post_id; ?>"></td>
        <?php
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

//            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
//            $select_categories = mysqli_query($connection, $query);
//            while ($row = mysqli_fetch_assoc($select_categories)) {
//                $cat_id = $row['cat_id'];
//                $cat_title = $row['cat_title'];
//                echo "<td>{$cat_title}</td>";
//            }
            echo "<td>{$category_title}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img src='../images/{$post_image}' alt='Image not displayed' 
              class='img-responsive' width='100' height='100'></td>";
            echo "<td class='col-md-2'>{$post_tags}</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($send_comment_query);
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_comment_query);
            echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";

            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a> </td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a> </td>";
            ?>

            <form method="post">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <?php
                echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                ?>
            </form>

            <?php
//            echo "<td><a rel='{$post_id}' href='javascript:void(0)' class='delete_link'>Delete</a> </td>";
            //without modal confirm delete
            //echo "<td><a onclick=\"javascript: return confirm('Are you want to delete                 this post')\" href='posts.php?delete={$post_id}'>Delete</a> </td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>
</form>

<?php

//deleting using post request
if (isset($_POST['delete'])){
    $delete_post_id = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

if (isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}

//deleting using GET request
//if (isset($_GET['delete'])){
//    $delete_post_id = $_GET['delete'];
//    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
//    $delete_query = mysqli_query($connection, $query);
//    header("Location: posts.php");
//}

?>

<script src="js/jquery.js"></script>

<script>

    $(document).ready(function () {
        $(".delete_link").on('click', function () {
           var id = $(this).attr('rel');
           var delete_url = "posts.php?delete="+ id + "";
           $(".modal_delete_link").attr("href", delete_url);
           $("#delete_modal").modal('show');
        });
    });

</script>

