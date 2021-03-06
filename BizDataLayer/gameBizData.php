<?php
//include exceptions

require_once("../../dbInfoPS.inc");
require_once('./BizDataLayer/exception.php');
require_once('./BizDataLayer/genericFunctions.php');

//if we have gotten here - we know:
//-they have permissions to be here
//-we are ready to do something with the database
//-method calling these are in the svcLayer
//-method calling specific method has same name droping 'Data' at end checkTurnData() here is called by checkTurn() in svcLayer


/*************************
	startData
	
*/
function startData($gameId){
	global $mysqli;

    $board_state = '0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0';
	//return $gameId.'sdf';
	//simple test for THIS 'game' - resets the last move and such to empty
	$sql = "UPDATE game SET player0_pieceID=null, player0_boardI=null, player0_boardJ=null, player1_pieceID=null, player1_boardI=null, player1_boardJ=null, board_state=? WHERE gameId=?";

    try {
		if ($stmt=$mysqli->prepare($sql)){
			//bind parameters for the markers (s - string, i - int, d - double, b - blob)
			$stmt->bind_param("si",$board_state, $gameId);
			$stmt->execute();
			$stmt->close();
		} else {
        	throw new Exception("An error occurred while setting up data");
        }
	} catch (Exception $e) {
        log_error($e, $sql, null);
		return false;
    }


	//get the init of the game
	$sql2 = "SELECT * FROM game WHERE gameId=?";
	try {
		if ($stmt = $mysqli->prepare($sql2)){
			//bind parameters for the markers (s - string, i - int, d - double, b - blob)
			$stmt->bind_param("i",$gameId);
			$data = returnJson($stmt);
            $stmt->close();
			$mysqli->close();
			return $data;
		} else {
            throw new Exception("An error occurred while fetching record data");
        }
	} catch (Exception $e) {
        log_error($e, $sql, null);
		return false;
    }
}
/*************************
	checkTurnData
*/
function checkTurnData($gameId){
	global $mysqli;
	$sql="SELECT whoseTurn FROM game WHERE gameId=?";
	try{
		if($stmt=$mysqli->prepare($sql)){
			$stmt->bind_param("i",$gameId);
			$data=returnJson($stmt);
			$mysqli->close();
			return $data;
		}else{
        	throw new Exception("An error occurred while checking turn");
        }
    }catch (Exception $e) {
        log_error($e, $sql, null);
		return false;
    }
}
/*************************
	changeTurnData
*/
function changeTurnData($gameId){
	global $mysqli;
	//ugly, but toggle the turn (if the turn was 0, then make it 1, else make it 0)
	try{
		if($stmt=$mysqli->prepare("UPDATE game SET whoseTurn='2' WHERE gameId=? AND whoseTurn='0'")){
			$stmt->bind_param("i",$gameId);
			$stmt->execute();
			$stmt->close();
		}else{
        	throw new Exception("An error occurred while changing turn, step 1");
        }
		if($stmt=$mysqli->prepare("UPDATE game SET whoseTurn='0' WHERE gameId=? AND whoseTurn='1'")){
			$stmt->bind_param("i",$gameId);
			$stmt->execute();
			$stmt->close();
		}else{
        	throw new Exception("An error occurred while changing turn, step 2");
        }
		if($stmt=$mysqli->prepare("UPDATE game SET whoseTurn='1' WHERE gameId=? AND whoseTurn='2'")){
			$stmt->bind_param("i",$gameId);
			$stmt->execute();
			$stmt->close();
		}else{
        	throw new Exception("An error occurred while changing turn, step 3");
        }
	}catch (Exception $e) {
        log_error($e, $sql, null);
		return false;
    }
	$mysqli->close();
}
/*************************
	changeBoardData
*/
function changeBoardData($gameId,$pieceId,$boardI,$boardJ,$playerId){
    global $mysqli;

    $queryBoardData = '';
    //get the board state from the db
    $sql="SELECT board_state FROM game WHERE gameId=?";
    try{
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i",$gameId);
            $stmt->execute();
            $stmt->bind_result($queryBoardData);
            $stmt->close();
        }else{
            throw new Exception("An error occurred while getMoveData");
        }
    }catch (Exception $e) {
        log_error($e, $sql, null);
        return false;
    }

    $updatedBoard = updateBoardString($queryBoardData,$boardI,$boardJ,$playerId);

	$sql="UPDATE game SET player".$playerId."_pieceId=?, player".$playerId."_boardI=?, player".$playerId."_boardJ=?, board_state=? WHERE gameId=?";
	try{
		if($stmt=$mysqli->prepare($sql)){
			$stmt->bind_param("siisi",$pieceId,$boardI,$boardJ,$updatedBoard,$gameId);
			$stmt->execute();
			$stmt->close();
		}else{
        	throw new Exception("An error occurred while changeBoard");
        }
	}catch (Exception $e) {
        log_error($e, $sql, null);
		return false;
    }
	$mysqli->close();
}
/*************************
	getMoveData
*/
function getMoveData($gameId){
	global $mysqli;
	$sql="SELECT * FROM game WHERE gameId=?";
	try{
		if($stmt=$mysqli->prepare($sql)){
			$stmt->bind_param("i",$gameId);
			$data=returnJson($stmt);
			$mysqli->close();
			return $data;
		}else{
			throw new Exception("An error occurred while getMoveData");
		}
	}catch (Exception $e) {
        log_error($e, $sql, null);
		return false;
    }
}


/**
 * Generates an updated 2D string that displays all the positions taken within a game
 * @param $originalString ('0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0|0~0~0~0~0~0~0~0)
 * @param $playerCol the column of the board
 * @param $playerRow the row of the board
 * @param $playerId the id of the player
 * @return string
 */
function updateBoardString($originalString, $playerRow, $playerCol, $playerId){
    foreach ( explode('|', $originalString) as $row => $col ) {
        $result[$row] = explode('~', $col);
    }

    $result[$playerRow][$playerCol] = $playerId;

    $newString = '';

    foreach ($result as $row){
        $newString .= implode('~',$row) . '|';
    }

    return substr($newString, 0, -1);
}


?>