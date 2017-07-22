<?php 
require 'core/init.php';
include 'includes/overall/header.php'; 
?>

    <header>
        <!-- hero -->
        <div class="container-fluid top-hero resources-hero">
            <div class="mask">
                <div class="container animated fadeInUp">

                    <h1 class="main-header">Free Resources</h1>
                    <h4>Access any time to your resources freely!</h4>

                </div>
            </div>
        </div>
        <!-- /hero -->
    </header>

    <main>

    <div class="container-fluid resources pd-2 bg-softgrey">

        <div class="container">

            <div class="row">
                
                <div class="col-sm-3">

                    <?php
                        if(loggedIn()) {
                            include 'includes/resource_count.php';

                        }else {
                            include 'includes/resource_login_form.php';

                        }
                    ?>

                </div>

                <div class="col-sm-9">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Resource name
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>ABS Census 2017</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"http://www.abs.gov.au/AUSSTATS/abs@.nsf/webpages/Release Advice for ABS Publications for the Next Six Months\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Population Projections for SA</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"http://www.saplanningportal.sa.gov.au/population_projections_and_demographics\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Workforce planning and profiling Data</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"http://data.sa.gov.au/data/storage/f/2013-05-21T02%3A01%3A16.299Z/dfeest-workforce-wizard-data.xlsx\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Future Urban Growth Areas</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"http://livingadelaide.sa.gov.au/\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Revealed: The top ten most burgled areas</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"https://data.sa.gov.au/data/dataset/revealed-the-top-ten-most-burgled-areas\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Climate Projections for South Australia</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"https://data.sa.gov.au/data/dataset/climate-projections-for-south-australia\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>State History Collection</td>
                                <td>
                                    <?php
                                        if(loggedIn()) {
                                            echo "<a href=\"https://data.sa.gov.au/data/dataset/state-history-collection\" class=\"btn btn-success btn-sm ml-0\" style=\"margin:0;\">View</a>";

                                        }else {
                                            echo "<a href=\"#login_card\" class=\"btn btn-primary btn-sm ml-0 smooth-scroll\" style=\"margin:0;\">Please login</a>";

                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
    
        </div>
        
    </div>

    </main>

<?php include 'includes/overall/footer.php'; ?>