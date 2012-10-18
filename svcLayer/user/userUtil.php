<?php

require_once('./BizDataLayer/userData.php');
require_once('./svcLayer/security.php');

/**
 * Logs a registered user into the system
 * @param $d
 * @param $ip
 * @param $token
 */
function loginUser($d,$ip,$token){
    $result = array();
    $data = parseDataFromRequest($d);
    $loginResponse = login($data['username'],$data['password']);

    if ($loginResponse){
        //generate_cookie()
        //redirect them to the lobby
        $result['status'] = 'success';
        $result['message'] = 'You are now logged into the game';
    } else {
        //tell them it didn't work
        $result['status'] = 'error';
        $result['message'] = 'There was an error with your credentials. Please try again!';

    }

    echo json_encode($result);
}

/**
 * Creates a new user account but also checks alot of stuff
 * @param $d
 * @param $ip
 * @param $token
 */
function registerUser($d,$ip,$token){
    $result = array();
    $data = parseDataFromRequest(urldecode($d));
    $cleanData = cleanRegisterFormData($data);

    //checks to make sure the username doesn't already exist, the passes match, and none of the fields are empty
    $userCheck = check_username($cleanData['username']);
    $passCheck = ($cleanData['password'] === $cleanData['password-confirm']) ? true : false;
    $paramCheck = (!empty($cleanData['password']) && !empty($cleanData['username']) && !empty($cleanData['email'])) ? true : false;

    //make sure the passwords are exactly the same
    if (!$passCheck){
        $result['message'] = 'Passwords do not match. Please try again!';
        $result['status'] = 'error';
    }

    //make sure the account doesn't already exist
    if (!$userCheck){
        $result['message'] = 'This user account already exists. Please try another username!';
        $result['status'] = 'error';
    }

    //your missing some parameters
    if (!$paramCheck){
        $result['message'] = 'Your missing some fields please fill in everything!';
        $result['status'] = 'error';
    }

    //once they pass validation create the account
    if ($userCheck && $passCheck && $paramCheck) {
        $registerResponse = generate_account($cleanData['username'], $cleanData['email'], $cleanData['password']);

        if ($registerResponse) {
            //if it works generate the token (cookies) and automatically go to the main room
            generate_cookie($cleanData['username'],$ip, $cleanData['email']);
            $result['status'] = 'success';
        } else {
            $result['status'] = 'error';
        }
    }

    echo json_encode($result);
}


function getAvatar($email, $ip, $token) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    echo json_encode(get_avatar($email));
}

/**
 * Cleans the login form data
 * @param $data
 * @return mixed
 */
function cleanLoginFormData($data){
    $args = array (
        'username' => FILTER_SANITIZE_STRING,
        'password' => FILTER_SANITIZE_STRING
    );
    $sanitizedData = filter_var_array($data, $args);
    return $sanitizedData;
}

/**
 * Cleans the registration form data
 * @param $data
 * @return array
 */
function cleanRegisterFormData($data){
    $args = array (
        'email' => FILTER_SANITIZE_EMAIL,
        'username' => FILTER_SANITIZE_STRING,
        'password' => FILTER_SANITIZE_STRING,
        'password-confirm' => FILTER_SANITIZE_STRING
    );

    $sanitizedData = filter_var_array($data, $args);
    $filteredData = array_filter(array_map('trim', $sanitizedData));

    return $filteredData;
}

/**
 * Converts a data string from the client into an array
 * ex --> username=xxx&password=xxx
 * @param $queryString
 * @return array
 */
function parseDataFromRequest($queryString){
    $result = array();

    foreach (explode('&', $queryString) as $pair) {
        list ($key, $val) = explode('=', $pair);
        $result[$key] = $val;
    }

    return $result;
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param bool $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_avatar( $email, $s = '80', $d = 'mm', $r = 'g', $img = true, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}



function logout(){
    session_destroy();
    header("Location: /index.php");

}

?>