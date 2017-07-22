<?php
require_once('core/init.php');
loggedin_redirect();

if(empty($_POST) === false) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $handle_redirect = $_POST['handle_redirect'];

    if(empty($email) || empty($password)) {
        $errors[] = 'You need to enter a email and password!';

    }else if(emailExists($email) === false) {
        $errors[] = 'We can\'t find that email. Have you registered?';

    }else if(userActive($email) === false) {
        $errors[] = 'You haven\'t activate your account!';

    }else {
        $login = login($email, $password);

        if($login === false) {
            $errors[] = 'That email/password combination is incorrect!';

        }else {
            //set user session
            $_SESSION['user_id'] = $login;
            //redirect
            if($handle_redirect == 1) {
                header('Location: resources.php');

            }else {
                header('Location: index.php');

            }


        }
    }
}

include 'includes/overall/header.php';
?>

<main style="background-color: #eee">
    
    <div class="container-fluid login-landing">
        
        <div class="container">
            
            <div class="row">

                <div class="col-md-4 col-sm-2 col-0"></div>

                <div class="col-md-4 col-sm-8 col-12">

                    <?php

                    if(isset($_GET['success']) && empty($_GET['success'])) {
                        ?>

                        <div class="alert alert-success">
                            <strong>Thanks for register!</strong>
                            <p>Please check your email and click the link for activate your account.</p>
                        </div>

                        <?php
                    }else {
                        if(isset($_GET['success']) && $_GET['success'] == 'activated') {
                            ?>

                            <div class="alert alert-success">
                                <strong>Thanks, we've activated your account.</strong>
                                <p>You're free to log in!</p>
                            </div>

                            <?php
                        }

                    }

                    if(!empty($errors)) {
                        echo outputErrors($errors); 
                    } 

                    ?>
                    
                    <div class="card">
                        <div class="card-header bg-blue">
                            <h3 class="sub-header">Login</h3>
                        </div>
                        <div class="card-block">

                            <form action="login.php" method="post" class="login-form regular-form">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'login')" />
                                    <span class="errDisplay"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'login')" />
                                    <span class="errDisplay"></span>
                                </div>
                                <!-- <div class="form-group magic">
                                    <input type="checkbox" name="remember_me" id="remember_me" class="" />
                                    <label>remember me</label>
                                </div> -->
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

                <div class="col-md-4 col-sm-2 col-0"></div>

            </div>

        </div>

    </div>

</main>

<?php include 'includes/overall/footer.php'; ?>