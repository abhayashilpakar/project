<?php
session_start();
error_reporting(0);
include('includes/config.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fontawesomes/css/all.css">
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.css">

</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
                <section class="sign-in">
                    <div class="container">
                        <div class="signin-content">
                            <div class="signin-image">
                                <figure><img src="assets/img/admin_image1.jpg" alt="sing up image"></figure>
                                <a href="index.php" class="signup-image-link">SignIn with User Account</a>
                            </div>
                            <div class="signin-form">
                                <h2 class="form-title">Admin Account</h2>
                                <form method="POST" role="form">
                                    <div class="form-group">
                                        <label ><i class="fa-solid fa-user" style="color: #000000;"></i></label>
                                        <input type="text" name="username" required autocomplete="off" placeholder="Your Username" />
                                    </div>
                                    <div class="form-group">
                                        <label ><i class="fa-solid fa-lock" style="color: #000000;"></i></label>
                                        <input type="password" name="password" required autocomplete="off" placeholder="Password" />
                                    </div>

                                    <div class="form-group form-button">
                                        <input type="submit" name="login" id="signin" class="form-submit" value="Log in" />

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>


    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <scrip src="assets/js/custom.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>