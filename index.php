<?php include 'includes/database.php'; ?>

<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container main-content">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                $query = "SELECT * FROM posts WHERE post_status = 'publish' ORDER BY 
                          post_id DESC ";
                $select_all_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 400) . " .....";
                    $post_status = $row['post_status'];

                ?>

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo
                        $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href=""><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo
                    $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>"
                     width="900" alt="Image not displayed">
                <hr>
                <p class="text-justify"><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;
                ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <hr>

                <?php
                }
                ?>

            </div>

            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->
    </div>
<!-- /.container -->

<?php include 'includes/footer.php'; ?>

