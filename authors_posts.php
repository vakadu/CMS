<?php include 'includes/database.php'; ?>

<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container main-content">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <?php

            if (isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $post_author = $_GET['author'];
            }
            $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";
            $select_post = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_post)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>

                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo
                    $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>"
                     alt="Image not displayed">
                <hr>
                <p class="text-justify"><?php echo $post_content; ?></p>
                <hr>

                <?php
            }
            ?>

            <!-- Blog Comments -->

            <?php

            if (isset($_POST['create_comment'])){
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if (!empty($comment_author) && !empty($comment_email) && !empty
                    ($comment_content)){
                    $query = "INSERT INTO comments (comment_post_id, comment_author, 
                          comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES ($the_post_id, '{$comment_author}', 
                '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                    $comment_query = mysqli_query($connection, $query);
                    if (!$comment_query){
                        die("Query Failed ". mysqli_error($connection));
                    }

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query .= "WHERE post_id = $the_post_id";
                    $update_comment_count = mysqli_query($connection, $query);
                }
                else{
                    echo "<script>alert('Fields cannot be empty')</script>";
                }
            }

            ?>

            <hr>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<?php include 'includes/footer.php'; ?>

