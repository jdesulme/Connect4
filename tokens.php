<?php

define('SEPARATOR','32c8bf');

$token = generate_token('50', '129.540.680');

echo "<p>---------------------------------------</p><p></p>";
echo "<p>---------------------------------------</p><p></p>";


verify_token($token, '129.540.680');

function generate_token($userID=null, $ip=null){

    $gTokenArr = array();
    //the user name
    if (empty($userID)) { $userID = '789'; }
    if (empty($ip)) { $ip = '129.540.680'; }

    //gets the current users ip address and than converts it
    $gTokenArr['ip'] = (string) preg_replace("/[^a-zA-Z0-9_-]/", "", $ip);
    $gTokenArr['time'] = (string) time();
    $gTokenArr['userid'] = $userID;

    $maxLen = max(array_map('strlen', $gTokenArr));

    print_r($gTokenArr);
    echo "<br />";

    foreach ( $gTokenArr as $key => $value ) {
        $gTokenArr[$key] = str_pad($value, $maxLen, "0", STR_PAD_LEFT);
        $gTokenArr[$key] = base_convert($value,16,32);
    }
    print_r($gTokenArr);
    echo "<br />";

    $string = implode(SEPARATOR, $gTokenArr);

    $hashed_string = sha1($string);
    $tokenStr = $hashed_string . $string;

    echo "<br />";
    echo "Regular String: <span style='color:green'>" . $string . "</span><br />";
    echo "Hashed String: <span style='color:red'>" . $hashed_string . "</span><br />";
    echo "Token String : <span style='color:blue'>" . $tokenStr . " </span><br /><br />";

    return $tokenStr;

}

/**
 *
 * @param $token
 * @param $user_ip
 * @return bool
 */
function verify_token($token, $user_ip){

    //strip the periods from the usersip
    $user_ip = (string) preg_replace("/[^a-zA-Z0-9_-]/", "", $user_ip);


    //pulls apart the token getting the checksum
    $checksum = substr($token, 0, 40);
    echo "Hashed String: <span style='color:red'>" .  $checksum . "</span><br />";

    //pulls apart and get the original string
    $original_string = substr($token, 40);
    echo "Regular String: <span style='color:green'>" . $original_string . "</span> -> ". strlen($original_string) ." <br />";

    //verifies the checksum and original string to make sure its valid
    if($checksum == sha1($original_string)){
        echo "<span style='color:green'>OK!</span> The message has not been modified <br /><br />";
    }



    list($xIP, $xTime, $xUserID) = explode(SEPARATOR, $original_string);
    $vTokenArr = array('ip'=>$xIP, 'time'=>$xTime, 'userid'=>$xUserID);

    print_r($vTokenArr);
    echo "<br />";

    foreach ($vTokenArr as $key => $value) {
        $vTokenArr[$key] = base_convert($value,32,16);
    }

    foreach ($vTokenArr as $key => $value) {
        $vTokenArr[$key] = preg_replace ('/^(0*)/', '', $value);
    }

    print_r($vTokenArr);
    echo "<br />";


    //verifies that the timestamp hasn't expired
    $token_age = time() - time($vTokenArr['time']);
    echo "Token Age: $token_age <br />";

    if ($token_age <= 3600) {
        echo "<span style='color:green'>OK!</span> The time is still fine<br />";
    }

    //verifies that the ip matches what was sent in
    if ($user_ip == $vTokenArr['ip']) {
        echo "<span style='color:green'>OK!</span> The ip address has not been modified <br /><br />";
    }


    //verifies that the user actually exists
    return $result;

}

?>