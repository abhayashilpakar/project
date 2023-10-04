<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Issued Books</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
        <style>
            body {
               
                font-weight: 300;
            }

            p {
                color: #b3b3b3;
                font-weight: 300;
            }


            a {
                -webkit-transition: .3s all ease;
                -o-transition: .3s all ease;
                transition: .3s all ease;
            }

            a,
            a:hover {
                text-decoration: none !important;
            }


            h2 {
                font-size: 20px;
            }

            .custom-table {
                min-width: 900px;
            }

            .custom-table thead tr,
            .custom-table thead th {
                border-top: none;
                border-bottom: none !important;
            }

            .custom-table tbody th,
            .custom-table tbody td {
                color: #777;
                font-weight: 400;
                padding-bottom: 20px;
                padding-top: 20px;
                font-weight: 300;
                border: none;
            }

            .custom-table tbody th small,
            .custom-table tbody td small {
                color: #b3b3b3;
                font-weight: 300;
            }

            .custom-table tbody tr {
                -webkit-transition: .3s all ease;
                -o-transition: .3s all ease;
                transition: .3s all ease;
            }

            .custom-table tbody tr:hover,
            .custom-table tbody tr:focus {
                background: #fff;
            }

            .custom-table .td-box-wrap {
                padding: 0;
            }

            .custom-table .box {
                background: #fff;
                border-radius: 4px;
                margin-top: 15px;
                margin-bottom: 15px;
            }

            .custom-table .box td,
            .custom-table .box th {
                border: none !important;
            }
        </style>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">

                    <div class="col-md-12">
                        <h4 class="header-line">Manage Issued Books</h4>
                    </div>

                    <div class="col-md-12">
                        <!-- Advanced Tables -->

                        <div class="panel-heading">
                            Issued Books
                        </div>

                        <div class="table-responsive">
                            <table class="table custom-table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Book Name</th>
                                        <th>ISBN </th>
                                        <th>Issued Date</th>
                                        <th>Return Date</th>
                                        <th>Fine in(USD)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sid = $_SESSION['stdid'];
                                    $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>
                                            <tr class="odd gradeX ">
                                                <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                                <td class="center"><?php echo htmlentities($result->IssuesDate); ?></td>
                                                <td class="center"><?php if ($result->ReturnDate == "") { ?>
                                                        <span style="color:red">
                                                            <?php echo htmlentities("Not Return Yet"); ?>
                                                        </span>
                                                    <?php } else {
                                                                        echo htmlentities($result->ReturnDate);
                                                                    }
                                                    ?>
                                                </td>
                                                <td class="center"><?php echo htmlentities($result->fine); ?></td>

                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
<?php } ?>