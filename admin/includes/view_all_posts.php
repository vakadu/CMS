<?php
if (isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $postValueId){
        $bulkOptions = $_POST['bulkOptions'];
        switch ($bulkOptions){
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
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>

        <?php
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
        ?>
            <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]"
                       value="<?php echo $post_id; ?>"></td>;
        <?php
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<td>{$cat_title}</td>";
            }
            echo "<td>{$post_status}</td>";
            echo "<td><img src='../images/{$post_image}' alt='Image not displayed' 
              class='img-responsive' width='100' height='100'></td>";
            echo "<td class='col-md-2'>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a> </td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a> </td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a> </td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>
</form>

<?php
if (isset($_GET['delete'])){
    $delete_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}