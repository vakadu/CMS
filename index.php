<?php include 'includes/database.php'; ?>

<?php include 'includes/header.php'; ?>

<?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container main-content">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                $per_page = 5;
                if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }
                else{
                    $page = "";
                }
                if ($page == "" || $page == 1){
                    $page_1 = 0;//for index page
                }
                else{
                    $page_1 = ($page * $per_page) - $per_page;//it will give us five every page
                }

                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);
                $count = ceil($count / $per_page);//for making number integer


                $query = "SELECT * FROM posts WHERE post_status = 'publish' ORDER BY post_id DESC LIMIT $page_1, $per_page";
                $select_all_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 500) . " .....";
                    $post_status = $row['post_status'];
                ?>

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo
                        $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="authors_posts.php?author=<?php echo $post_author;
                    ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo
                    $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>"
                     width="900" height="auto" alt="Image not displayed">
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

<div class="container">
    <div class="row">
        <div class="cms_pagination text-center">
            <ul class="pagination pagination-danger">
                <?php
                for ($i = 1; $i <= $count; $i++){
                    if ($i == $page){
                        echo "<li><a class='active' href='index.php?page={$i}'>{$i}</a> </li>";
                    }
                    else{
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

