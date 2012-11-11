<?php
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');



function getChallengeData($userID){
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
 * @param $p1 the user currently logged in
 * @param $p2 the player that's challenged
 * @param $state (waiting-W), accepted-A, or declined-D
 * @return mixed
 * @throws Exception
 */
function setChallengeData($p1, $p2){
    global $mysqli;
    $sql = 'INSERT INTO challenges (player_1, player_2, state) VALUES (?,?,?)';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('iis',$p1, $p2, 'W');
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
        echo 'fail - send_challenge';
    }
}


?>