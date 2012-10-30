<?php

require_once('./BizDataLayer/chatData.php');
require_once('./svcLayer/security.php');

//go to the data layer and actually get the data I want
function getChat($d,$ip,$token){
    if (verify_token($ip, $token)) {
        echo getChatData();
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}


function setChat($d,$ip,$token){
    if (verify_token($ip, $token)) {
        sendChatData($d['id_user'],$d['message'],$d['room']);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }
}

?>