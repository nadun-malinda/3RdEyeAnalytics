<?php
require 'core/init.php';
loggedin_redirect();

if(empty($_POST) === false) {
    $required_fields = array('firstname', 'email', 'password', 'password_again');

    foreach ($_POST as $key => $value) {
        if(empty($value) && in_array($key, $required_fields)) {
            $errors[] = 'Fields marked with an asterisks are required!';
            break 1;

        }

    }

    if(empty($errors)) {
        if(emailExists($_POST['email'])) {
            $errors[] = 'This email \'' . $_POST['email'] . '\' is already exists. Please use another valid one!';

        }

        if(strlen($_POST['password']) < 8) {
            $errors[] = 'Password must be atleast 8 characters!';

        }

        if($_POST['password'] !== $_POST['password_again']) {
            $errors[] = 'Your passwords do not match!';

        }

        if(validateEmail($email)) {
            $errors[] = 'A valid email address is required!';

        }

    }

}

if(isset($_GET['success']) && empty($_GET['success'])) {
    header('Location: login.php?success');

}else {
    if(empty($_POST) === false && empty($errors) === true) {
        registerUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], md5($_POST['email'] + microtime()), $_POST['password']);
        header('Location: register.php?success');
        exit();

    }

}

include 'includes/overall/header.php';

?>

<main style="background-color: #eee">
    
    <div class="container-fluid register-landing">
        
        <div class="container">
            
            <div class="row">
                
                <div class="col-md-4 col-sm-2 col-0"></div>

                <div class="col-md-4 col-sm-8 col-12">

                    <?php

                    if(!empty($errors)) {
                        echo outputErrors($errors);

                    }

                    ?> 

                    <div class="card">
                        <div class="card-header bg-red">
                            <h3 class="sub-header">Register</h3>
                        </div>
                        <div class="card-block">

                            <form action="" method="post" class="register-form regular-form">

                                <div class="form-group">

                                    <label for="firstname">First Name: *</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'register')" />
                                    <span class="errDisplay"></span>
                                    
                                </div>

                                <div class="form-group">

                                    <label for="lastname">Last Name:</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" />
                                    
                                </div>

                                <div class="form-group ">

                                    <label for="email">Email: *</label>
                                    <input type="email" name="email" id="email" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'register')" />
                                    <span class="errDisplay"></span>
                                    
                                </div>

                                <div class="form-group">
                                    
                                    <label for="password">Password: *</label>
                                    <input type="password" name="password" id="password" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'register')" />
                                    <span class="errDisplay"></span>
                                    
                                </div>

                                <div class="form-group">
                                    
                                    <label for="password_again">Password Again: *</label>
                                    <input type="password" name="password_again" id="password_again" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'register')" />
                                    <span class="errDisplay"></span>
                                    
                                </div>

                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-danger btn-md ml-0">Register</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

                <div class="col-md-4 col-sm-2 col-0"></div>

            </div>

        </div>

    </div>

</main>

<?php include 'includes/overall/footer.php'; ?>