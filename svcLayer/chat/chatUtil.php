<?php

require_once('./BizDataLayer/chatData.php');
require_once('./svcLayer/security.php');

//go to the data layer and actually get the data I want
function getChat($d,$ip,$token){
	//do we want to check security????
	echo getChatData();
}

function setChat($d,$ip,$token){
	$result = array();
    $data = parseDataFromRequest(urldecode($d));
	$result['Security-Check'] = verify_token($ip, $token);
	$result['data'] = $data;
	//verify security????

	echo json_encode($result);
		
}

?>