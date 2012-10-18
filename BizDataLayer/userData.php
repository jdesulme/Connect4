<?php

require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');

function login($username, $password){
    global $mysqli;

    $sql = "SELECT (password = ?) AS password_matches FROM user WHERE username = ?";
    $hash = hash('sha256', $password);

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ss',$hash, $username);
            $stmt->execute();
            $stmt->bind_result($password_matches);
            $stmt->fetch();
            return $password_matches;

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail';
    }
}


function check_username($username){
    global $mysqli;
    $sql = "SELECT (username = ?) AS user_matches FROM user WHERE username = ?";

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $stmt->bind_result($username_matches);
            $stmt->fetch();
            return $username_matches;

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail';
    }

}

/**
 * Creates a new account for the new player
 *
 * @param $username
 * @param $email
 * @param $password
 * @throws Exception
 * @return string
 */
function generate_account($username, $email, $password){
    global $mysqli;

    $sql = 'INSERT INTO user (username, email, password) VALUES (?,?,?)';
    $hash = hash('sha256', $password);

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('sss',$username, $email, $hash);
            $stmt->execute();
            $result = ($stmt->affected_rows() == 1) ? true : false;
            return $result;

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail';
    }
}

?>