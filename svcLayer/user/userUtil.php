<?php

require_once('./BizDataLayer/userData.php');

function loginUser($d,$ip,$token){
    $data = json_decode($d, true);

    echo var_dump($data);

    return $d;
}

function registerUser($d,$ip,$token){
    //a VERY good idea to check the token make sure they should be here - then...

    echo var_dump($d);
    //we should be here (security checked!)
    //prepare data "num|num"
    $h=explode('|',$d);
    $gameId=$h[0];
    $userId=$h[1];

    //go to game layer and run this function

    //echo generate_account()

}

/**
 * Gets the url for the image validates the email
 * @param $email
 */
function getAvatar($email, $ip, $token){
    error_reporting(E_ALL);

    $result = '';

    if ( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $result .= get_gravatar($email);
    }

    echo $result;
}

function cleanRegisterForm($data){
    $filteredData = array_filter(array_map('trim', $data));

    //validate the email
    //filter_var($filteredData['email'], FILTER_VALIDATE_EMAIL)

    //make sure the passwords are the same
    //$filteredData['password-confirm']
    //$filteredData['password']



}