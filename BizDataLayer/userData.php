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
            return returnJson($stmt);

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
    $result = array();
    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('sss',$username, $email, $hash);
            $stmt->execute();

            //$result = ($stmt->affected_rows() == 1) ? true : false;

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail';
    }

    //check to make sure the username doesn't already exist

    return json_encode($result);
}

?>