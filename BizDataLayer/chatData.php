<?php
//include dbInfo
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');


function getChatData($room){
    global $mysqli;
    $sql="SELECT username, message, email, time_stamp FROM chat c JOIN user u USING(id_user) WHERE c.room = ? ORDER BY time_stamp ASC";
    try {
        if ($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param('i',$room);
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
            $stmt->bind_param('isi',$id_user, $message, $room);
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