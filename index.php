<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if ($_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}

if (isset($_POST['login'])) {
    $usernameOrEmail = $_POST['username_email'];
    $password = $_POST['password'];

    // Check in admin table
    $adminQuery = $dbh->prepare("SELECT UserName FROM admin WHERE UserName=:usernameOrEmail AND Password=:password");
    $adminQuery->bindParam(':usernameOrEmail', $usernameOrEmail, PDO::PARAM_STR);
    $adminQuery->bindParam(':password', $password, PDO::PARAM_STR);
    $adminQuery->execute();

    if ($adminQuery->rowCount() > 0) {
        $_SESSION['alogin'] = $usernameOrEmail;
        echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        exit();
    }

    // Check in student table
    $studentQuery = $dbh->prepare("SELECT EmailId, StudentId, Status FROM tblstudents WHERE EmailId=:usernameOrEmail AND Password=:password");
    $studentQuery->bindParam(':usernameOrEmail', $usernameOrEmail, PDO::PARAM_STR);
    $studentQuery->bindParam(':password', $password, PDO::PARAM_STR);
    $studentQuery->execute();
    $studentResults = $studentQuery->fetchAll(PDO::FETCH_OBJ);

    if ($studentQuery->rowCount() > 0) {
        foreach ($studentResults as $result) {
            if ($result->Status == 1) {
                $_SESSION['stdid'] = $result->StudentId;
                $_SESSION['login'] = $usernameOrEmail;
                echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                exit();
            } else {
                echo "<script>alert('Your Account Has been blocked. Please contact admin');</script>";
                exit();
            }
        }
    }

    echo "<script>alert('Invalid Details');</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    
    
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css">
    
    
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fontawesomes/css/all.css">  
    <!-- CUSTOM STYLE  -->

    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.css">
    
 
</head>



<body>
    <?php include('includes/header.php'); ?>

    
                <section class="sign-in">
                    <div class="container">
                        <div class="signin-content">
                            <div class="signin-image">
                                <figure><img src="assets/img/signin-image.jpg" alt="sing up image"></figure>
                                <a href="signup.php" class="signup-image-link">Create an account</a>
                                <a href="adminlogin.php" class="signup-image-link" >SignIn with Admin Account</a>
                            </div>

                            <div class="signin-form">
                                <h2 class="form-title">User Account</h2>
                                <form method="POST"  role="form">
                                    <div class="form-group">
                                        <label for="your_name"><i class="fa-solid fa-user" style="color: #000000;"></i></label>
                                        <input type="text" name="username_email" required autocomplete="off"  placeholder="Your Email"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="your_pass"><i class="fa-solid fa-lock" style="color: #000000;"></i></label>
                                        <input type="password" name="password" required autocomplete="off"  placeholder="Password" />
                                    </div>

                                    <div class="form-group form-button">
                                        <input type="submit" name="login" id="signin" class="form-submit" value="Log in" />
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
           
    

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>