<?php 
require 'core/init.php';

if(empty($_POST) === false) {
    $required_fields = array('name', 'email', 'phone', 'description');

    foreach ($_POST as $key => $value) {
        if(empty($value) && in_array($key, $required_fields)) {
            $errors[] = 'Fields marked with an asterisks are required!';
            break 1;

        }

    }

    if(empty($errors)) {

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email address is required!';

        }

    }

}

if(isset($_GET['success']) && empty($_GET['success'])) {
    // header('Location: get_in_touch_landing.php');

}else {
    if(empty($_POST) === false && empty($errors) === true) {
        addNewClientRequest($_POST['name'], $_POST['email'], $_POST['company'], $_POST['phone'], $_POST['project_info'], $_POST['website'], $_POST['description']);
        header('Location: get_in_touch.php?success');
        exit();

    }

}

include 'includes/overall/header.php'; 
?>

<main>

    <div class="container-fluid get-in-touch pd-2">

        <div class="container sm-w60">


            <?php

            if(isset($_GET['success']) && empty($_GET['success'])) {
                echo "<h1 class=\"main-header\">Thanks for contact us!</h1>";
                echo "<h3 class=\"sub-header\">We will get back to you within 48 hours to discuss about your needs.</h3>";

            }else {
                ?>

            <h1 class="main-header text-center">Get in touch</h1>

            <div class="row magic">
                
                <div class="col-md-6">

                    <h4 class="sub-header">Don’t know if this service is right for your business?</h4>
                    
                    <p>
                        Speak with the Principal Consultant directly to arrange a time for a chat. 
                    </p>

                    <ul class="iconic-list">
                        <li>
                            <i class="fa fa-phone"></i>
                            <span>+61 430 050 480</span>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <span>info@3rdeyeanalytics.com</span>
                        </li>
                    </ul>

                    <p>
                        We will listen and have an honest conversation with you. Then you can decide for yourself if 3RD Eye is right for you. We won’t engage if we don’t believe we can add value.
                    </p>

                    <p>
                        Alternatively, fill in the form below. The more information you can provide us with, the quicker we’ll be able to understand your project and how we can be of value to you. We look forward to talking with you soon!
                    </p>

                    <?php
                        if (!empty($errors)) {
                            echo outputErrors($errors);
                        }
                    ?>

                </div>

                <div class="col-md-6">

                    <div class="form-wrap">
                        
                        <form action="get_in_touch.php" method="post" class="regular-form">

                            <div class="row">
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" id="name" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'getintouch')" />
                                        <span class="errDisplay"></span>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" name="email" id="email" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'getintouch')" />
                                        <span class="errDisplay"></span>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                 
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label for="company">Company </label>
                                        <input type="text" name="company" id="company" class="form-control" />
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label for="phone">Phone *</label>
                                        <input type="text" name="phone" id="phone" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'getintouch')" />
                                        <span class="errDisplay"></span>
                                    </div>

                                </div>

                            </div>
                            
                            <div class="form-group">
                                <label for="project_info">Project Information: </label>
                                <textarea type="text" name="project_info" id="project_info" class="md-textarea"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="website">Website: </label>
                                <input type="text" name="website" id="website" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="description">Tell us a little about your business or organisation, for example, what do you do? *</label>
                                <textarea type="text" name="description" id="description" class="md-textarea" onblur="checkFieldEmpty(this.value, this.id, 'getintouch')"></textarea>
                                <span class="errDisplay"></span>
                            </div>
                            <div class="form-group text-left">
                                <button type="submit" class="btn btn-danger btn-md ml-0">Submit <i class="fa fa-long-arrow-right"></i></button>
                            </div>
                            
                        </form>

                    </div>
                    
                </div>

            </div>

                <?php
            }

            ?>

        </div>

    </div>

</main>

<?php include 'includes/overall/footer.php'; ?>