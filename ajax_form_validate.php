<?php
require_once 'core/init.php';

$field = $_POST['field'];
$value = $_POST['value'];
$form = $_POST['form'];

if ($field == 'email') {
    if (!validateEmail($value)) {
        echo 'A valid email address is required.';
        return;
    }
}

// if($field == 'phone') {
//     if (!is_int($value)) {
//         echo "Please enter only numbers.";
//     }
// }

if ($form == 'login') {
    if ($field == 'email') {
        if (!emailExists($value)) {
            echo "Can't find this email.";
        }
    }
}

if ($form == 'register') {
    if ($field == 'email') {
        if (emailExists($value)) {
            echo "Email already exists.";
        }
    }

    if ($field == 'password') {
        $pass = $value;
        if(strlen($value) < 8) {
            echo "Password must have atleast 8 characters";
        }
    }

    // if ($field == 'password_again') {
    //     $pass = $value;
    //     if($field == 'password_again') {
    //         if ($pass != $value) {
    //             echo "Passwords arn't match";
    //         }
    //     }
    // }
}