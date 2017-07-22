<?php
// require 'connect.php';

function sanitize($user_data) {
    $user_data = htmlspecialchars($user_data);
    $user_data = trim($user_data);
    $user_data = preg_replace('/\s+/', '', $user_data);

    return $user_data;

}

function setPageActive($path, $actual_page) {
    $current_page = basename($path, '.php');
    $active = 'active';

    if($current_page == $actual_page) {
        return $active;
    }
}
function setNavbarDark($path, $actual_page) {
    $current_page = basename($path, '.php');
    $dark = 'bg-blue-black';

    // if($current_page == $actual_page) {
    //     return $dark;
    // }

    if (array_search($current_page, $actual_page) !== false) {
        return $dark;
    }
}

function outputErrors($errors) {
    return '<ol class="errors"><li>' . implode('</li><li>', $errors) . '</li></ol>';

}