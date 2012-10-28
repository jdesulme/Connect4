<?php

require_once('./BizDataLayer/chatData.php');
require_once('./svcLayer/security.php');

//go to the data layer and actually get the data I want
function getChat($d,$ip,$token){
    $result['d'] = $d;
    $result['$ip'] = $ip;
    $result['$token'] = $token;

    if (verify_token($ip, $token)) {
        echo getChatData();
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
    }

}


function setChat($d,$ip,$token){
    $result['$d'] = $d;
	$result = array();
    $data = parseDataFromRequest(urldecode($d));

	$result['Security-Check'] = verify_token($ip, $token);
	$result['data'] = $data;
	//verify security????
    sendChatData($data['id_user'],$data['message'],$data['room']);
	echo json_encode($result);
		
}

?>