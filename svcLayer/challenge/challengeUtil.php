<?php
require_once('./BizDataLayer/challengeData.php');
require_once('./svcLayer/security.php');

/**
 * Gets all the challenges for a user
 * @param $d
 * @param $ip
 * @param $token
 */
function getChallenge($d,$ip,$token){
    if (verify_token($ip, $token)) {
        echo getNewChallengeData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}

/**
 * Gets the status of a challenge for the player that sent it
 * @param $d -> the userid of the current player
 * @param $ip
 * @param $token
 */
function getChallengeStatus($d, $ip, $token){
    if (verify_token($ip, $token)) {
        echo getStatusChallengeData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}

/**
 * Create a new challenge
 * @param $d -> player1 and player2
 * @param $ip
 * @param $token
 */
function setChallenge($d,$ip,$token){
    if (verify_token($ip, $token)) {
        $h = explode('|', $d);
        $player1 = $h[0];
        $player2 = $h[1];

        echo setChallengeData($player1, $player2);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}

/**
 * The challengee updates the status of the challenege
 * @param $d -> the userid and state (accept or decline)
 * @param $ip
 * @param $token
 */
function updateChallenge($d,$ip,$token){
    if (verify_token($ip, $token)) {
        $h = explode('|', $d);
        $userID = $h[0];
        $state = $h[1];

        echo updateChallengeData($userID, $state);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}
