<?php include 'includes/header.php' ?>

<?php include 'includes/navigation.php' ?>

<div id="page-wrapper">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Post Comment
                </h1>
                <table class="table table-responsive table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>In Response to</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>

                    <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) . " ";
                    $select_comments = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_comments)) {
                        $comment_id = $row['comment_id'];
                        $comment_post_id = $row['comment_post_id'];
                        $comment_author = $row['comment_author'];
                        $comment_email = $row['comment_email'];
                        $comment_content = $row['comment_content'];
                        $comment_status = $row['comment_status'];
                        $comment_date = $row['comment_date'];

                        echo "<tr>";
                        echo "<td>{$comment_id}</td>";
                        echo "<td>{$comment_author}</td>";
                        echo "<td>{$comment_content}</td>";
                        echo "<td>{$comment_email}</td>";
                        echo "<td>{$comment_status}</td>";

                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                        $select_post_id_query = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_post_id_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];

                            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                        }

                        echo "<td>{$comment_date}</td>";
                        echo "<td><a href='post_comments.php?approve={$comment_id}'>Approve</a> </td>";
                        echo "<td><a href='post_comments.php?unapprove={$comment_id}'>Unapprove</a> </td>";
                        echo "<td><a href='post_comments.php?delete={$comment_id}&id=". $_GET['id'] ."'>Delete</a> </td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>

                <?php

                if (isset($_GET['approve'])){
                    $the_comment_id = $_GET['approve'];
                    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
                    $unapprove_query = mysqli_query($connection, $query);
                    header("Location: post_comments.php");
                }

                if (isset($_GET['unapprove'])){
                    $the_comment_id = $_GET['unapprove'];
                    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id";
                    $unapprove_query = mysqli_query($connection, $query);
                    header("Location: post_comments.php");
                }

                if (isset($_GET['delete'])){
                    $the_comment_id = $_GET['delete'];
                    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
                    $delete_query = mysqli_query($connection, $query);
                    header("Location: post_comments.php?id=". $_GET['id'] ."");
                }
                ?>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?php include 'includes/footer.php' ?>