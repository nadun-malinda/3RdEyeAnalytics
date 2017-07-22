<?php

$host = 'localhost';
// $user = 'thrrdez5_root';
// $password = '3rdeyeanalytics';
// $db = 'thrrdez5_3rdeyeanalytics';
$user = 'root';
$password = '';
$db = '3rdeyeanalytics';
$con_error = 'Sorry! We are experiencing connection problem!' ;

$con = mysqli_connect($host, $user, $password, $db) or die($con_error) ;