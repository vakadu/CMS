<!-- Navigation -->
<nav class="navbar navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="
        .navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li>
            <a href="../index.php">User</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa
            fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw
                    fa-power-off"></i> LogOut</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?= ($activePage == 'index') ? 'active':''; ?>">
                <a href="index.php"><i class="material-icons md-25
                orange600">dashboard</i> Dashboard</a>
            </li>
            <li class="<?= ($activePage == 'posts') ? 'active':''; ?>">
                <a href="javascript:;"
                   data-toggle="collapse"data-target="#posts_dropdown"><i
                   class="material-icons md-25 orange600">border_color</i></i> Posts <i
                            class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="posts.php" style="color: white">View All Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post" style="color: white">Add
                            Post</a>
                    </li>
                </ul>
            </li>
            <li class="<?= ($activePage == 'categories') ? 'active':''; ?>">
                <a href="categories.php"><i class="material-icons md-25
                        orange600">folder_special</i>  Categories</a>
            </li>
            <li class="<?= ($activePage == 'comments') ? 'active':''; ?>">
                <a href="comments.php"><i class="material-icons md-25
                        orange600">comment</i> Comments</a>
            </li>
            <li class="<?= ($activePage == 'users') ? 'active':''; ?>">
                <a href="javascript:;" data-toggle="collapse"
                   data-target="#users_dropdown">
                    <i class="material-icons md-25 orange600">people</i> Users <i
                            class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="users.php" style="color: white">View All Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user" style="color: white">Add User</a>
                    </li>
                </ul>
            </li>
            <li class="<?= ($activePage == 'profile') ? 'active':''; ?>">
                <a href=""><i class="material-icons md-25
                orange600">sentiment_very_satisfied</i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>