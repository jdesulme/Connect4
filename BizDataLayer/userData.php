<?php

require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');

function checkLoginData($username, $password){
    global $mysqli;

    $sql = "SELECT (password = ?) AS password_matches FROM user WHERE username = ?";
    $hash = hash('sha256', $password);

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ss',$hash, $username);
            $stmt->execute();
            $stmt->bind_result($pass);
            $stmt->fetch();
            $stmt->close();
            $mysqli->close();
            return $pass;
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - checkLoginData';
    }
}

/**
 * Updates a users status in the user table
 * @param string $username
 * @param bool $active sets the users status to active or inactive {0/1}
 * @throws Exception
 */
function setPlayerStatusData($active, $username){
    global $mysqli;

    $sql = "UPDATE user SET status = ? WHERE username = ?";
    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('is', intval($active), $username);
            $stmt->execute();
            $stmt->close();

        } else {
            throw new Exception("An error occurred while setting player status");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - setPlayerStatusData';
    }
    $mysqli->close();
}

/**
 * Checks to see if the supplied username already exists
 * @param $username
 * @return bool
 * @throws Exception
 */
function checkUsernameData($username){
    global $mysqli;
    $sql = "SELECT COUNT(1) AS user_matches FROM user WHERE username = ?";

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $stmt->bind_result($matches);
            $stmt->fetch();
            $stmt->close();
            $mysqli->close();
            return $matches;

        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - checkUsernameData';
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
function generateAccountData($username, $email, $password){
    global $mysqli;

    $sql = 'INSERT INTO user (username, email, password) VALUES (?,?,?)';
    $hash = hash('sha256', $password);

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('sss',$username, $email, $hash);
            $stmt->execute();
            $data = $stmt->affected_rows;
            $stmt->close();
            $mysqli->close();
            return $data;
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - generateAccountData';
    }
}

function getUserData($username = null){
    global $mysqli;

    $sql = "SELECT id_user, username, email, win, loss, status, last_login FROM user ";
    if ( isset($username) ){
        $sql .= "WHERE username = ? ";
    }
    $sql .= "ORDER BY status DESC";

    try {
        if ($stmt = $mysqli->prepare($sql)){
            if ( isset($username) ){
                $stmt->bind_param('s',$username);
            }
            echo returnJson($stmt);

            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching user record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - getUserData';
    }

}

?>