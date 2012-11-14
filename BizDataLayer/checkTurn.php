<?php
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');

	function checkTurnData($gid,$uid){
        global $mysqli;
        $sql="SELECT gameId, whoseTurn FROM game WHERE gameId=? ";
        try {
            if ($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param('ii',$gid,$uid);
                $data = returnJson($stmt);
                $stmt->close();
                $mysqli->close();
                return $data;
            } else {
                throw new Exception("An error occurred while fetching record data");
            }
        } catch(Exception $e){
            log_error($e, $sql, null);
            echo 'fail - getChatData';
        }



		//Select myTurn from gameTable where gameId=$gid and userId=$uid
		return '[{"gameId":55,"turn":true}]';
	}
?>