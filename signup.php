<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {

    //Code for student ID
    $count_my_page = ("studentid.txt");
    $hits = file($count_my_page);
    $new_student_id = sprintf("SID%03d", $hits[0]);
    $fp = fopen($count_my_page, "w");
    fputs($fp, ++$hits[0]); // Increment after using the current value
    fclose($fp);
    $fname = $_POST['fullanme'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $password = ($_POST['password']);
    $status = 1;
    $sql = "INSERT INTO  tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':StudentId', $new_student_id, PDO::PARAM_STR);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo '<script>alert("Your Registration successfull and your student id is  "+"' . $new_student_id . '")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#emailid").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>

</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->

    <section class="sign-up">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="register-form" onSubmit="return valid();">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="fullanme" id="fullanme" placeholder="Your Name" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="mobileno" maxlength="10" autocomplete="off" required placeholder="Your Mobile Number" />
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="emailid" placeholder="Your Email" onBlur="checkAvailability()" autocomplete="off" required />
                            <span id="user-availability-status" style="font-size:12px;"></span>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" placeholder="Password" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="confirmpassword" placeholder="Repeat your password" autocomplete="off" required />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit " autocomplete="off" required value="Register" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="assets/img/signup-image.jpg" alt="sing up image"></figure>
                    <a href="index.php" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT-WRAPPER SECTION END-->

    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>