<?php

class Token {
    const SALT = "cf83e1357eefb8bdf1542850d66d8007d620921d31bd47417a81a538327af927da3e";

    function generate_token($userID){
        $tokenStr = "";
        if( empty($userID) ) { $userID = 1234; }

        //gets the current users ip address and than converts it
        $ip = $_SERVER['REMOTE_ADDR'];
        $convert_ip = base_convert($ip, 10, 24);
        echo "ip: $ip <br />";
        echo "convert_ip: $convert_ip -> " . strlen($convert_ip) ."<br /><br />";

        //gets the current date and converts it
        $current_date = date(DATE_RFC822);
        $convert_date = base_convert($current_date, 10, 24);
        echo "current_date: $current_date <br />";
        echo "convert_date: $convert_date -> " . strlen($convert_date) . "<br /><br />";


        $string = $convert_date . $userID . $convert_ip . 000;
        $hashed_string = sha1($string);

        $tokenStr = $hashed_string . $string;

        echo "Regular String: <span style='color:green'>" . $string . "</span> -> ". strlen($string) ." <br />";
        echo "Hashed String: <span style='color:red'>" .  $hashed_string . "</span><br />";
        echo "Check Summed String: <span style='color:red'>" . $hashed_string . " </span><span style='color:green'>" . $string . "</span><br />";
        echo "Total Check Summed String Count: <span style='color:blue'>" . strlen($tokenStr) . " </span><br /><br />";

        return $tokenStr;
    }

    function verify_token($token, $user_ip){
        $result = false;

        //pulls apart the token getting the checksum
        $checksum = substr($token, 0, 40);
        echo "<span style='color:red'>" . $checksum . "</span><br />";

        //pulls apart and get the original string
        $original_string = substr($token, -21);
        echo "<span style='color:green'>" . $original_string . "</span><br />";

        //verifies the checksum and original string to make sure its valid
        if($checksum == sha1($original_string)){
            echo "<span style='color:green'>OK!</span> The message has not been modified <br /><br /><br />";
        }

        //pull out the timestamp (and decode)
        $timestamp = substr($original_string, 0, 10);
        $orig_timestamp = base_convert($timestamp, 24, 10);
        echo "timestamp: $timestamp <br />";
        echo "orig_timestamp: $orig_timestamp <br />";

        //verifies that the timestamp hasn't expired





        //pull out the ip (and decode)
        $ip = substr($original_string, 11, 17);
        $orig_ip = base_convert($ip, 24, 10);

        echo "ip: $ip <br />";
        echo "orig_ip: $orig_ip <br />";

        //verifies that the ip matches what was sent in
        if($user_ip == $orig_ip ){


        }


        //pull out the userId (and decode)


        //verifies that the user actually exists


        return $result;

    }

}






?>