<div class="container_nav_header ">
    <div class="navbar-header ">

        <a>
            <img src="assets/img/logo.png" />
        </a>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

    </div>
</div>

<!-- LOGO HEADER END-->

<?php if ($_SESSION['login']) { ?>
    <section class="menu-section">

       
            <div class="navBar">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse">

                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                            <li><a href="issued-books.php">Issued Books</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">
                                    Account <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu " role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">LOG ME OUT</a></li>


                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        

    </section>
<?php } ?>