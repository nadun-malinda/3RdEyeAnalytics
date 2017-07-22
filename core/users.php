<?php

require_once('init.php');

function validateEmail($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;

}

function uploadCV($file_temp, $file_extn, $firstname, $lastname, $email, $position, $salary, $rate, $start_date) {
    global $con;
    $file_path = 'careers/cv/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
    move_uploaded_file($file_temp, $file_path);

    $sql = "INSERT INTO career (cv, firstname, lastname, email, position, expected_salary, rate, start_date) VALUES('$file_path', '$firstname', '$lastname', '$email', '$position', '$salary', '$rate', '$start_date')";
    $result = mysqli_query($con, $sql);

    return ($result) ? true : false;
}

function userData($user_id) {
    global $con;
    $data = array();
    $user_id = (int)$user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if($func_num_args > 1) {
        unset($func_get_args[0]);

        $fields = '`' . implode('`, `', $func_get_args) . '`';
        $sql = "SELECT $fields FROM `users` WHERE `user_id` = $user_id";
        $data = mysqli_fetch_assoc(mysqli_query($con, $sql));

        return $data;

    }
}

function registerUser($firstname, $lastname, $email, $email_code, $password) {
    global $con;
    $firstname = sanitize($firstname);
    $lastname = sanitize($lastname);
    $email = sanitize($email);
    $email_code = sanitize($email_code);
    $password = md5($password);
    
    $sql = "INSERT INTO users (firstname, lastname, email, email_code, password) VALUES('$firstname', '$lastname', '$email', '$email_code', '$password')";
    $result = mysqli_query($con, $sql);

    if($result) {
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = 'Activate your account';

        $body = "
            <html>
                <head>
                </head>
                <body>
                    <p>You need to activate your account, so use the link bellow:</p>
                    <a href=\"http://3rdeyeanalytics.com.au/activate.php?email= $email&email_code=$email_code\">click here to activate your account</a>
                </body>
            </html>
        ";

        email($email, $subject, $body, $headers);
        return true;

    }else {
        return false;

    }

}

function emailExists($email) {
    global $con;
    $email = sanitize($email);
    $sql = "SELECT user_id FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    return (mysqli_num_rows($result) == 1) ? true : false;

}

function userActive($email) {
    global $con;
    $email = sanitize($email);
    $sql = "SELECT user_id FROM users WHERE email='$email' AND active=1";
    $result = mysqli_query($con, $sql);

    return (mysqli_num_rows($result) == 1) ? true : false;

}

function userIdFromEmail($email) {
    global $con;
    $email = sanitize($email);
    $sql = "SELECT user_id FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    return ($row = mysqli_fetch_assoc($result)) ? $row['user_id'] : false;

}

function login($email, $password) {
    global $con;
    $email = sanitize($email);
    $password = md5($password);
    $user_id = userIdFromEmail($email);

    $sql = "SELECT user_id FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    return (mysqli_num_rows($result) == 1) ? $user_id : false;

}

function loggedIn() {
    return (isset($_SESSION['user_id'])) ? true : false;

}

function loggedin_redirect() {
    if(loggedIn()) {
        header('Location: index.php');
    }
}

function firstnameFromUserId() {
    global $con;
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT firstname FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql);

    return ($row = mysqli_fetch_assoc($result)) ? $row['firstname'] : false;
}

function addNewClientRequest($name, $email, $company, $phone, $project_info, $website, $description) {
    global $con;

    //special sanitization for names
    //otherwise space between user entered firstname and last name will be remove
    $name = htmlspecialchars($name);
    $name = preg_replace('/\s+/', '', $name);

    $email = sanitize($email);
    $company = sanitize($company);
    $phone = sanitize($phone);
    $project_info = sanitize($project_info);
    $website = sanitize($website);
    $description = sanitize($description);
    
    $sql = "INSERT INTO client (name, email, company, phone, project_info, website, description) VALUES('$name', '$email', '$company', '$phone', '$project_info', '$website', '$description')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = 'Incomming new client request';

        $body = "
            <html>
                <head>
                    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">
                </head>
                <body>
                    <h4>New 3Rd Eye Analytics client is requesting a service from you:</h4>
                    <table class=\"table\">

                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Project info</th>
                            <th>Website</th>
                            <th>More details</th>
                        </tr>

                        <tr>
                            <td>$name</td>
                            <td>$email</td>
                            <td>$company</td>
                            <td>$phone</td>
                            <td>$project_info</td>
                            <td>$website</td>
                            <td>$description</td>
                        </tr>

                    </table>
                </body>
            </html>
        ";

        email('info@3rdeyeanalytics.com', $subject, $body, $headers);
        return true;

    }else {
        return false;

    }
}

function email($to, $subject, $body, $headers) {
    mail($to, $subject, $body, $headers);
}

function activateUser($email, $email_code) {
    global $con;
    $email = mysqli_real_escape_string($con, $email);
    $email_code = mysqli_real_escape_string($con, $email_code);

    $sql = "SELECT COUNT(user_id) FROM users WHERE email = '$email' AND email_code = '$email_code' AND active = 0";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1) {
        mysqli_query($con, "UPDATE users SET active = 1 WHERE email = '$email'");
        return true;

    }else {
        return false;

    }

}