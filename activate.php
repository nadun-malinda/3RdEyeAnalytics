<?php
require 'core/init.php';
loggedin_redirect();

if(isset($_GET['email'], $_GET['email_code']) === true) {
    $email = trim($_GET['email']);
    $email_code = trim($_GET['email_code']);

    if(emailExists($email) === false) {
        $errors[] = 'Oops! something went wrong. We couldn\'t find that email!';

    }else if(activateUser($email, $email_code) === false) {
        $errors[] = 'We had problems activating your account!';

    }

    if(empty($errors)) {
        // header('Location: activate.php?success');
        header('Location: login.php?success=activated');
        exit();

    }

}else {
    header('Location: index.php');
    exit();

}

include 'includes/overall/header.php';
?>

<header>
    <!-- hero -->
    <div class="container-fluid top-hero activate-user-hero">
        <div class="mask">
            <div class="container animated fadeInLeft">

                <?php
                    if(isset($_GET['success']) && empty($_GET['success'])) {
                        echo "<h1 class=\"main-header\">Thanks, we've activated your account...</h1>";
                        echo "<h3 class=\"sub-header\">You're free to lo in!</h3>";

                    }else {
                        echo "<h1 class=\"main-header\">Ooops..!</h1>";
                        echo "<h3 class=\"sub-header\">We're encountering following issues.</h3>";

                    }
                ?>

            </div>
        </div>
    </div>
    <!-- /hero -->
</header>

<main>
    
    <div class="container-fluid activate-user-landing pd-2 bg-softgrey">
        
        <div class="container">
            
            <div class="row custom-flex">

                <?php

                if(!empty($errors)) {
                    ?>

                    <div class="col-md-7">
                        <?php echo outputErrors($errors); ?>
                    </div>

                    <div class="col-md-5">
                        
                    </div>

                    <?php

                }else {

                    ?>

                    <div class="col-sm-7">

                    </div>

                    <div class="col-sm-5">
                            
                        <div class="card">
                            <div class="card-header">
                                <h3 class="sub-header">Login</h3>
                            </div>
                            <div class="card-block">

                                <form action="login.php" method="post">
                                    <div class="form-group md-form">
                                        <i class="fa fa-pencil prefix"></i>
                                        <input type="email" name="email" id="email" class="form-control" />
                                        <label for="email">Email:</label>
                                    </div>
                                    <div class="form-group md-form">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" name="password" id="password" class="form-control" />
                                        <label for="password">Password:</label>
                                    </div>
                                    <input type="hidden" name="handle_redirect" id="handle_redirect" value="1" />
                                    <div class="form-group text-left">
                                        <button type="submit" class="btn btn-primary btn-md ml-0">Login <i class="fa fa-long-arrow-right"></i></button>
                                    </div>
                                </form>
                                <hr>

                                <label><a href="register.php">Don't have an account?</a></label>

                            </div>
                        </div>

                    </div>

                    <?php

                }

                ?> 

            </div>

        </div>

    </div>

</main>

<?php include 'includes/overall/footer.php'; ?>