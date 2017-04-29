<?php include 'includes/header.php' ?>

<?php include 'includes/navigation.php' ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Categories
                </h1>
                <div class="col-xs-6">

                    <?php insert_categories(); ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="cat_title"
                                   placeholder="Add Category">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit"
                                   value="Add Category">
                        </div>
                    </form>
                    <?php
                    //update and include on clicking edit link
                    if (isset($_GET['edit'])){
                        $cat_id = $_GET['edit'];
                        include "includes/update_categories.php";
                    }
                    ?>
                </div>

                <div class="col-xs-6">
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php findAllCategories(); ?>
                        <?php deleteCategories(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include 'includes/footer.php' ?>
