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
        echo getChallengeData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}


function setChallenge($d,$ip,$token){
    if (verify_token($ip, $token)) {
        $h = explode('|', $d);
        $player1 = $h[0];
        $player2 = $h[1];
        var_dump($h);
        echo setChallengeData($player1, $player2);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}