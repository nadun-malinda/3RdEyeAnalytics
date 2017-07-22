<?php 
require 'core/init.php';

if(empty($_POST) === false) {
    $required_fields = array('firstname', 'email', 'cv', 'position', 'start_date');

    foreach ($_POST as $key => $value) {
        if(empty($value) && in_array($key, $required_fields)) {
            $errors[] = 'Fields marked with an asterisks are required!';
            break 1;

        }

    }

    if(empty($errors)) {

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email address is required.';

        }

        if ($_POST['position'] == '') {
            $errors[] = 'Please select a valid job position.';
        }

    }

}

if(empty($_POST) === false && empty($errors) === true) {
    if(isset($_FILES['cv'])) {
        if(!empty($_FILES['cv']['name'])) {
            $allowed = array('pdf', 'docx');

            $file_name = $_FILES['cv']['name'];
            $extn = explode('.', $file_name);
            $file_extn = strtolower(end($extn));
            $file_temp = $_FILES['cv']['tmp_name'];

            if(in_array($file_extn, $allowed)) {
                //upload cv
                uploadCV($file_temp, $file_extn, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['position'], $_POST['salary'], $_POST['rate'], $_POST['start_date']);
                header('Location: career.php?success');
                exit();

            }else {
                $errors[] = 'Incorect file type! Allowed: ' . implode(', ', $allowed);

            }

        }

    }

}


include 'includes/overall/header.php'; 
?>

    <header>
        <!-- hero -->
        <div class="container-fluid top-hero career">
            <div class="mask">
                <div class="container animated fadeInUp">

                    <h1 class="main-header">Join the crusade</h1>
                    <h4>We do great work. We love what we do. We do it smartly and differently.</h4>
                    <a href="#apply_card" class="btn btn-primary btn-md ml-0 smooth-scroll">Apply now <i class="fa fa-long-arrow-right"></i></a>

                </div>
            </div>
        </div>
        <!-- /hero -->
    </header>

    <main>
        <div class="container-fluid jobs">

            <div class="container animated">

                <h2 class="sub-header text-center"><i class="fa fa-fire"></i> Following positions are available as <span class="underline">part-time contactors</span> or <span class="underline">freelancers</span>  </h2>

                <div class="row">
                    
                    <div class="col-sm-4">

                        <?php
                            if(isset($_GET['success']) && empty($_GET['success'])) {
                                ?>

                                <div class="alert alert-success">
                                    <strong>Thanks for apply!</strong>
                                    <p>We will get back to you soon.</p>
                                </div>

                                <?php
                            }
                        ?>
                        
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Join our Fabulous Team of difference makers</h4>
                                <hr>
                                <p>
                                    For more information,
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
                            </div>
                        </div>

                        <?php

                            if (!empty($errors)) {
                                echo outputErrors($errors);
                            }
                        ?>

                        <div class="card" id="apply_card">
                            <div class="card-header">
                                <h4>Apply now</h4>
                            </div>
                            <div class="card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="regular-form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>First name *</label>
                                                <input type="text" name="firstname" id="firstname" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'career')" />
                                                <span class="errDisplay"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" name="lastname" id="lastname" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" name="email" id="email" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'career')" />
                                        <span class="errDisplay"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Your CV *</label>
                                        <input type="file" name="cv">
                                    </div>

                                    <div class="form-group">
                                        <label>Select job position *</label>
                                        <select class="form-control" name="position" id="position">
                                            <option disabled selected value="">Select Position </option>
                                            <option value="Data Analytics Champion">Data Analytics Champion</option>
                                            <option value="Data Visualisation Champion">Data Visualisation Champion</option>
                                            <option value="AR Designer / App Developer">AR Designer / App Developer</option>
                                            <option value="3D / Graphic Designer">3D / Graphic Designer </option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label>Expected salary</label>
                                                <input type="number" name="salary" id="salary" placeholder="in USD" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Rate</label>
                                                <select class="form-control" name="rate" id="rate">
                                                    <option>Hourly</option>
                                                    <option>Daily</option>
                                                    <option>Monthly</option>
                                                    <option>Anually</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Start date *</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'career')" />
                                                <span class="errDisplay"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-left">
                                        <button type="submit" class="btn btn-danger btn-md ml-0">Submit <i class="fa fa-long-arrow-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-8">
                        
                        <div class="row">
                            
                            <div class="col-sm-12">
                                
                                <!-- Job #1 -->
                                <div class="card">
                                    <div class="card-block">
                                        <h2 class="card-title main-header">Data Analytics Champion</h2>
                                        <p class="card-head-p">Requirements</p>
                                        <ul>
                                            <li>
                                                3+ years of data analysis experience.
                                            </li>
                                            <li>
                                                3+ years of data analysis experience.
                                            </li>
                                            <li>
                                                Familiar with data scraping techniques 
                                            </li>
                                            <li>
                                                Minimum of 5 projects roll outs.
                                            </li>
                                            <li>
                                                Good Communication Skills
                                            </li>
                                            <li>
                                                Team Player
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What we Expect from you?</p>

                                        <ul>
                                            <li>
                                                Design and execute research projects independently.
                                            </li>
                                            <li>
                                                Taking complete ownership of the deliveries assigned.
                                            </li>
                                            <li>
                                                Collaborate with cross-functional teams to define, design, and execute new ideas.
                                            </li>
                                            <li>
                                                Work with outside data sources
                                            </li>
                                            <li>
                                                Adhere to code of ethics and timeline
                                            </li>
                                            <li>
                                                Deliver project within agreed timeline and budget
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What you've got?</p>

                                        <p class="card-text">
                                            You'll be familiar with freely available data sources as well as potential usability of them, comfortable discussing detailed technical aspects of data analysis, statistical modelling. In addition, you must take responsibility of what you are doing, we respect and accept mistakes for right reasons.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                                        <a href="#apply_card" class="btn btn-primary btn-md ml-0">Apply now <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!-- /Job #1 -->

                            </div>

                            <div class="col-sm-12">
                                
                                <!-- Job #2 -->
                                <div class="card">
                                    <div class="card-block">
                                        <h2 class="card-title main-header">Data Visualisation Champion</h2>
                                        <p class="card-head-p">Requirements</p>
                                        <ul>
                                            <li>
                                                3+ years of data visualisation / graphic design experience.
                                            </li>
                                            <li>
                                                Experience with third-party libraries and APIs.
                                            </li>
                                            <li>
                                                Minimum of 5 project roll outs.
                                            </li>
                                            <li>
                                                Good Communication Skills
                                            </li>
                                            <li>
                                                Team Player
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What we Expect from you?</p>

                                        <ul>
                                            <li>
                                                Design and execute research projects independently.
                                            </li>
                                            <li>
                                                Taking complete ownership of the deliveries assigned.
                                            </li>
                                            <li>
                                                Collaborate with cross-functional teams to define, design, and execute new ideas.
                                            </li>
                                            <li>
                                                Adhere to code of ethics and timeline
                                            </li>
                                            <li>
                                                Deliver project within agreed timeline and budget
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What you've got?</p>

                                        <p class="card-text">
                                            You'll be familiar with freely available data sources as well as potential usability of them. In addition, you must take responsibility of what you are doing, we respect and accept mistakes for right reasons.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#apply_card" class="btn btn-primary btn-md ml-0">Apply now <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!-- /Job #2 -->

                            </div>

                            <div class="col-sm-12">
                                
                                <!-- Job #3 -->
                                <div class="card">
                                    <div class="card-block">
                                        <h2 class="card-title main-header">AR Designer / App Developer</h2>
                                        <p class="card-head-p">Requirements</p>
                                        <ul>
                                            <li>
                                                Degree in Computer Science, Engineering or a related stream.
                                            </li>
                                            <li>
                                                2+ years of AR / App development experience.
                                            </li>
                                            <li>
                                                1+ years of software development experience. 
                                            </li>
                                            <li>
                                                Experience with third-party libraries and APIs.
                                            </li>
                                            <li>
                                                Minimum of 5 project roll outs.
                                            </li>
                                            <li>
                                                Good Communication Skills
                                            </li>
                                            <li>
                                                Team Player
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What we Expect from you?</p>

                                        <ul>
                                            <li>
                                                Design and execute development projects independently.
                                            </li>
                                            <li>
                                                Taking complete ownership of the deliveries assigned.
                                            </li>
                                            <li>
                                                Collaborate with cross-functional teams to define, design, and execute new ideas.
                                            </li>
                                            <li>
                                                Adhere to code of ethics and timeline
                                            </li>
                                            <li>
                                                Deliver project within agreed timeline and budget
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What you've got?</p>

                                        <p class="card-text">
                                            You'll be familiar with latest mobile app development technologies with an open and creative mind as well as potential usability of them. In addition, you must take responsibility for what you are doing, we respect and accept mistakes for the right reasons.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#apply_card" class="btn btn-primary btn-md ml-0">Apply now <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!-- /Job #3 -->

                            </div>

                            <div class="col-sm-12">
                                
                                <!-- Job #4 -->
                                <div class="card">
                                    <div class="card-block">
                                        <h2 class="card-title main-header">3D / Graphic Designer </h2>
                                        <p class="card-head-p">Requirements</p>

                                        <ul>
                                            <li>
                                                Degree or diploma in a related stream.
                                            </li>
                                            <li>
                                                2+ years of graphic designing experience.
                                            </li>
                                            <li>
                                                Content writing and proofreading skills
                                            </li>
                                            <li>
                                                Minimum of 5 project roll outs.
                                            </li>
                                            <li>
                                                Good Communication Skills
                                            </li>
                                            <li>
                                                Team Player
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What we Expect from you?</p>

                                        <ul>
                                            <li>
                                                Design and execute development projects independently.
                                            </li>
                                            <li>
                                                Taking complete ownership of the deliveries assigned.
                                            </li>
                                            <li>
                                                Collaborate with cross-functional teams to define, design, and execute new ideas.
                                            </li>
                                            <li>
                                                Adhere to code of ethics and timeline
                                            </li>
                                            <li>
                                                Deliver project within agreed timeline and budget
                                            </li>
                                        </ul>

                                        <p class="card-head-p">What you've got?</p>

                                        <p class="card-text">
                                            You'll be familiar with the latest designing software with open and creative mind as well as potential usability of them. In addition, you must take responsibility for what you are doing, we respect and accept mistakes for the right reasons. 
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#apply_card" class="btn btn-primary btn-md ml-0">Apply now <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!-- /Job #4 -->

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </main>

<?php include 'includes/overall/footer.php'; ?>