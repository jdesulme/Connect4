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
            $stmt->bind_result($pass);
            $stmt->fetch();
            return $pass;

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - login';
    }
}

/**
 * Updates a users status in the user table
 * @param string $username
 * @param bool $active sets the users status to active or inactive {0/1}
 * @throws Exception
 */
function set_player_status($username, $active){
    global $mysqli;

    $sql = "UPDATE user SET status = ?, last_login = NOW() WHERE username = ?";
    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ds',intval($active), $username);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - set_player_status';
    }
}

/**
 * Checks to see if the supplied username already exists
 * @param $username
 * @return bool
 * @throws Exception
 */
function check_username($username){
    global $mysqli;
    $sql = "SELECT COUNT(1) AS user_matches FROM user WHERE username = ?";

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
        echo 'fail - check_username';
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
            $result = $stmt->affected_rows;
            return $result;

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - generate_account';
    }
}

?>