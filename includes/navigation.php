<?php
$path = $_SERVER['PHP_SELF'];
$pages = array('index', 'about', 'services', 'current_projects', 'resources', 'blog', 'get_in_touch', 'career');
$pagesForDarkNav = array('get_in_touch', 'login', 'register');
?>

<!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark fixed-top scrolling-navbar <?php echo setNavbarDark($path, $pagesForDarkNav); ?> ">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="img/logo/logo.gif">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav1">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item <?php echo setPageActive($path, $pages[0]); ?>">
                        <a href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[1]); ?>">
                        <a class="nav-link" href="about.php">About</a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[2]); ?>">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[3]); ?>">
                        <a class="nav-link" href="current_projects.php">Current Projects</a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[4]); ?>">
                        <a class="nav-link" href="resources.php">Resources</a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[5]); ?>">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[6]); ?>">
                        <a class="nav-link" href="get_in_touch.php">Get in touch</a>
                    </li>

                    <li class="nav-item <?php echo setPageActive($path, $pages[7]); ?>">
                        <a href="career.php" class="nav-link">Careers</a>
                    </li>

                </ul>

                <ul class="navbar-nav">

                    <?php
                        if(loggedIn()) {
                            include 'logout_menu.php';

                        }else {
                            include 'login_menu.php';

                        }
                    ?>
                        
                    <?php
                        //display the register menu only if user logout
                        if(!loggedIn()) {
                            include 'register_menu.php';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--/.Navbar-->