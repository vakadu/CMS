<?php include 'includes/database.php'; ?>

<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                $search_query = mysqli_query($connection, $query);
                if (!$search_query) {
                    die("Query Failed " . mysqli_error($connection));
                }
                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo
                    '<div class="alert alert-danger alert-dismissable text-center">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Error!</strong> No results found.
                     </div>';

                } else {

                    while ($row = mysqli_fetch_assoc($search_query)) {
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
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" width="900" height="300"
                             alt="Image not displayed">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>

                        <?php
                    }

                }
            }

            ?>
        </div>

        <?php include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <?php include 'includes/footer.php'; ?>
