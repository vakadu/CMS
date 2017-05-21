<?php include 'includes/database.php'; ?>

<?php include 'includes/header.php'; ?>

<?php

if (isset($_POST['submit'])) {

    $to = "vakadu100@gmail.com";
    $header = "From: " . $_POST['email'];
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];

    mail($to, $header, $subject, $body);
}

?>

<?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container main-content">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-warp">
                            <h1>Contact Us</h1>
                            <form role="form" action="" method="post"
                                  id="login-form" autocomplete="off">
                                <!--<p class="lead"><?php //echo $message; ?></p>-->
                                <div class="form-group">
                                    <input type="email" name="email" id="email"
                                           class="form-control"
                                           placeholder="somebody@gmail.com">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" id="subject"
                                           class="form-control" placeholder="Subject">
                                </div>
                                <div class="form-group">
                                    <textarea name="body" id="body"
                                              class="form-control" cols="30" rows="10"
                                              placeholder="Message"></textarea>
                                </div>
                                <input type="submit" name="submit" id="btn-login" class="btn
                            btn-primary pull-right" value="Contact Us">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.container -->

<?php include 'includes/footer.php'; ?>