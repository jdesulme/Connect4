<?php
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');

	function checkTurnData($gid,$uid){
		//Select myTurn from gameTable where gameId=$gid and userId=$uid
		return '[{"gameId":55,"turn":true}]';
	}
?>