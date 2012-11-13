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
    $sql="SELECT player_1, player_2, state, id_game FROM challenges c WHERE state = 'W' AND player_2 = ?";
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


function getStatusChallengeData($challengeID){
    global $mysqli;
    $sql="SELECT id_challenges, state, id_game  FROM challenges c WHERE id_challenges = ?";
    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('i',$challengeID);
            $data = returnJson($stmt);
            $stmt->close();
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
            $data['id_challenges'] = $stmt->insert_id;
            $stmt->close();

            $result[0] = $data;
            return json_encode($result);
        } else {
            throw new Exception("An error occurred while inserting record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - setChallengeData';
    }
}

/**
 * Updates the status of the challenge from the challengee
 * @param $player the challenged player
 * @param $state A-accepted OR D-declined
 * @return mixed
 * @throws Exception
 */
function updateDenyChallengeData($state, $player){
    global $mysqli;
    $sql = 'UPDATE challenges SET state = ? WHERE player_2 = ?';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('si',$state, $player);
            $stmt->execute();
            $data = $stmt->affected_rows;
            $stmt->close();
            return $data;
        } else {
            throw new Exception("An error occurred while inserting record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - updateDenyChallengeData';
    }
}


function updateAcceptChallengeData($state, $player, $gameID){
    global $mysqli;
    $sql = 'UPDATE challenges SET state = ?, id_game = ? WHERE player_2 = ?';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('sii',$state, $gameID, $player);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("An error occurred while updating challenge data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - updateAcceptChallengeData';
    }
}

function createNewGame($p1,$p2){
    global $mysqli;

    $sql = 'INSERT INTO game (player_1, player_2) VALUES (?,?)';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ii',$p1,$p2);
            $stmt->execute();
            $data = $stmt->insert_id;
            $stmt->close();
            return $data;
        } else {
            throw new Exception("An error occurred while inserting record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail - createNewGame';
    }


}

?>