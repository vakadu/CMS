<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4 main-sidebar">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                       placeholder="Search">
                <span class="input-group-btn">
                <button name="submit" class="btn btn-primary" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
            </div>
        </form>
    </div>

    <!-- Login Form   -->

    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control"
                       placeholder="Username">
            </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control"
                       placeholder="Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit" >Login
                    </button>
                </span>
            </div>
        </form> <!-- search form end -->
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($connection, $query);
        ?>

        <h4>Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}
                                  </a></li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <?php include 'widget.php'; ?>

</div>
