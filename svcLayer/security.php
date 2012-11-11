<?php

define('SEPARATOR','32c8bf');


/**
 * Generates a unique token for each user
 * @param $user
 * @param $ip
 * @return string
 */
function generate_token($user, $ip){
    //the user name & ip
    if (empty($userID)) { $user = '0'; }
    if (empty($ip)) { $ip = '0'; }

    //gets the current users ip address and than converts it
    $gTokenArr = array();
    $gTokenArr["ip"] = (string) preg_replace("/[^a-zA-Z0-9_-]/", "", $ip);
    $gTokenArr["time"] = (string) time();
    $gTokenArr["user"] = $user;

    //gets the longest string in the array
    $maxLen = max(array_map('strlen', $gTokenArr));

    //pads and converts base
    foreach ($gTokenArr as $key => $value ) {
        $gTokenArr[$key] = str_pad($value, $maxLen, "0", STR_PAD_LEFT);
        $gTokenArr[$key] = base_convert($value,16,32);
    }

    //puts everything together
    $string = implode(SEPARATOR, $gTokenArr);
    $hashed_string = sha1($string);
    $tokenStr = $hashed_string . $string;

    return $tokenStr;
}

/**
 * Decodes a given token making sure that it's valid
 * @param $user_ip
 * @param $token
 * @return bool
 */
function verify_token($user_ip, $token){
    //strip the periods from the users ip address
    $user_ip = (string) preg_replace("/[^a-zA-Z0-9_-]/", "", $user_ip);

    //pulls apart the token getting the checksum
    $checksum = substr($token, 0, 40);

    //pulls apart and get the original string
    $original_string = substr($token, 40);

    //verifies the checksum and original string to make sure its valid
    $bCheckSum = ($checksum == sha1($original_string)) ? true : false;

    //pulls apart the original string into an array
    list($xIP, $xTime, $xUserID) = explode(SEPARATOR, $original_string);
    $vTokenArr = array('ip'=>$xIP, 'time'=>$xTime, 'userid'=>$xUserID);

    //converts it back to the original base
    foreach ($vTokenArr as $key => $value) {
        $vTokenArr[$key] = base_convert($value,32,16);
    }

    //removes all the zeros
    foreach ($vTokenArr as $key => $value) {
        $vTokenArr[$key] = preg_replace ('/^(0*)/', '', $value);
    }

    //verifies that the timestamp hasn't expired within the last hour
    $token_age = time() - time($vTokenArr['time']);
    $bTokenAge = ($token_age <= 3600) ? true : false;

    //verifies that the ip passed in is the same one being used
    $bIP = ($user_ip == $vTokenArr['ip']) ? true : false;

    //checks everything now
    $result = ($bCheckSum && $bIP && $bTokenAge ) ? true : false;

    return $result;
}


function generate_cookie($username, $ip){
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        setcookie("token", generate_token($username,$ip), time()+3600, '/','');
    } else {
        setcookie("token", generate_token($username,$ip), time()+3600, '/~jxd1827/Connect4','nova.it.rit.edu');
    }
}

?>