<?php
// error_reporting(0);
session_start();
require_once('connect.php');
require_once('global.php');
require_once('users.php');

if(loggedIn()) {
    $session_user_id = $_SESSION['user_id'];
    userData($session_user_id, 'user_id', 'firstname', 'lastname', 'password', 'email');
}

$errors = array();