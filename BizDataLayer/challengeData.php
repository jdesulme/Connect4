<?php
//include dbInfo
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');

/**
 * @param $userID The user that's currently logged in
 * @return json|string
 * @throws Exception
 */
function getNewChallengeData($userID){
    global $mysqli;
    $sql="SELECT player_1, player_2, state FROM challenges c WHERE state = 'W' AND player_2 = ?";
    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('i',$userID);
            $data = returnJson($stmt);
            $stmt->close();
            $mysqli->close();
            return $data;
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - get_challenge';
    }
}


/**
 * Gets the status of the sent challenge for the originator
 * @param $userID
 * @return json|string
 * @throws Exception
 */
function getStatusChallengeData($userID){
    global $mysqli;
    $sql="SELECT state FROM challenges c WHERE player_1 = ?";
    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('i',$userID);
            $data = returnJson($stmt);
            $stmt->close();
            $mysqli->close();
            return $data;
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - get_challenge';
    }
}

/**
 * Creates a new challenge request that initially has waiting stored
 * @param $p1 the user currently logged in
 * @param $p2 the player that's challenged
 * @return mixed
 * @throws Exception
 */
function setChallengeData($p1, $p2){
    global $mysqli;
    $sql = 'INSERT INTO challenges (player_1, player_2) VALUES (?,?)';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ii',$p1,$p2);
            $stmt->execute();
            $data = $stmt->insert_id;
            $stmt->close();
            $mysqli->close();
            return $data;
        } else {
            throw new Exception("An error occurred while inserting record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - send_challenge';
    }
}

/**
 * Updates the status of the challenge from the challengee
 * @param $player the challenged player
 * @param $state A-accepted OR D-declined
 * @return mixed
 * @throws Exception
 */
function updateChallengeData($player, $state){
    global $mysqli;
    $sql = 'UPDATE challenges SET state = ? WHERE player_2 = ?';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('si',$state, $player);
            $stmt->execute();
            $data = $stmt->affected_rows;
            $stmt->close();
            $mysqli->close();
            return $data;
        } else {
            throw new Exception("An error occurred while inserting record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - updateChallengeData';
    }
}

?>