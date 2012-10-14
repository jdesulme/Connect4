<?php

class Token {
    const SALT = "cf83e1357eefb8bdf1542850d66d8007d620921d31bd47417a81a538327af927da3e";

    /**
     *
     * @param $userID
     * @return string
     */
    function generate_token($userID = null){
        $tokenStr = "";
        //the user name
        if( empty($userID) ) { $userID = 'efsfds'; }

        $_SERVER['REMOTE_ADDR'] = "129.540.680";

        //gets the current users ip address and than converts it
        $ip = preg_replace("/[^a-zA-Z0-9_-]/", "", $_SERVER['REMOTE_ADDR']);
        $convert_ip = base_convert($ip, 10, 24);
        echo "IP: " . $ip ." <br />";
        echo "Converted IP: <span style='color:orange'>" . $convert_ip. "</span><br />";
        echo "Converted IP Count: " . strlen($convert_ip) . "<br />";

        echo "<p></p><p></p>";

        //gets the current date and converts it
        $current_date = time();
        $convert_date = base_convert($current_date, 10, 24);
        echo "Current Date: " . $current_date . " <br />";
        echo "Converted Date: <span style='color:purple'>" . $convert_date . "</span><br />";
        echo "Converted Date Count: " .  strlen($convert_date) . "<br />";

        echo "<p></p><p></p>";


        //hashes the string and returns
        $string =  $convert_date;
        $string .= $convert_ip;
        $string .= $userID;

        $hashed_string = sha1($string);
        $tokenStr = $hashed_string . $string;

        echo "Hashed String: <span style='color:red'>" .  $hashed_string . "</span><br />";
        echo "Regular String: <span style='color:green'>" . $string . "</span> -> ". strlen($string) ." <br />";

        echo "Token String Count: <span style='color:blue'>" . strlen($tokenStr) . " </span><br /><br />";

        return $tokenStr;
    }

    /**
     *
     * @param $token
     * @param $user_ip
     * @return bool
     */
    function verify_token($token, $user_ip){
        $result = false;

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

        echo "<p></p><p></p>";

        $timestamp = substr($original_string, 0, 7);
        $orig_timestamp = base_convert($timestamp, 24, 10);

        echo "Current Date: " . time($orig_timestamp) . " <br />";
        echo "Converted Date: <span style='color:purple'>" . $timestamp . "</span><br />";
        echo "Converted Date Count: " .  strlen($timestamp) . "<br />";

        //verifies that the timestamp hasn't expired

        $token_age = time() - time($orig_timestamp);
        echo "Token Age: $token_age";

        if ($token_age <= 3600) {
            echo "<span style='color:green'>OK!</span> The time is still fine<br /><br /><br />";
        }


        echo "<p></p><p></p>";

        //pull out the ip (and decode)
        $ip = substr($original_string, 7, 13);
        $token_ip = base_convert($ip, 24, 10);

        echo "IP: " . $token_ip ." <br />";
        echo "Converted IP: <span style='color:orange'>" . $ip. "</span><br />";
        echo "Converted IP Count: " . strlen($ip) . "<br />";

        //verifies that the ip matches what was sent in
        if($user_ip == $token_ip ){
            echo "<span style='color:green'>OK!</span> The ip address has not been modified <br /><br />";
        }


        //pull out the userId (and decode)
        echo substr($original_string, 13);

        //verifies that the user actually exists


        return $result;

    }





}






?>