<?php
//include dbInfo
require_once("../../dbInfoPS.inc");
//include exceptions
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');


function getChatData(){
    global $mysqli;
    $sql="Select * from 546ArchChat";
    try {
        if ($stmt=$mysqli->prepare($sql)){
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


?>