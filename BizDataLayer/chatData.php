<?php
//include dbInfo
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');

/*
function getChatData(){
    global $mysqli;
    $sql="Select * from 546ArchChat";
    try {
        if ($stmt = $mysqli->prepare($sql)){
            //would bind here if need be
            echo returnJson($stmt);
            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail';
    }
}
*/

function getChatData($room = 0){
    global $mysqli;
    $sql="SELECT * FROM chat WHERE room = ?";
    try {
        if ($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param('d',$room);
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
}


function sendChatData($id_user, $message, $room){
    global $mysqli;
    $sql = 'INSERT INTO chat (id_user, message, room) VALUES (?,?,?)';

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ssd',$id_user, $message, $room);
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
        echo 'fail - send_chat_data';
    }
}


?>