<?php
//What do we do here?
//Check if they should be here!
//if so - prepare data and make call to data/biz layer

//error_reporting(E_ALL);
require_once('./BizDataLayer/gameBizData.php');
//Why include the database stuff here?  (not doing any db stuff in the service layer!)
//because it forces all to go through the service layer in order to get to the bizLayer
//if someone tries to access the bizLayer on it's own the code will fail since there isn't a connection!
//require_once("../../dbInfoPS.inc");//to use we need to put in: global $mysqli;


/**
 * Start!!
 * @param $d -> gameId
 * @param $ip
 * @param $token
 * @return bool|json gameInfo
[{"game_id":38,"whoseTurn":1,"player0_name":"Dan","player0_pieceID":null,"player0_boardI":null,"player0_boardJ":null,"player1_name":"Fred","player1_pieceID":null,"player1_boardI":null,"player1_boardJ":null,"last_updated":"0000-00-00 00:00:00"}]

 */

function start($d, $ip, $token){
	//Should they be here?  (check)
	//if true:
    if (verify_token($ip, $token)) {
        return startData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
        //logout();
    }

}
/*************************
	changeTurn
	takes: gameId
	uses in bizLayer: gameBiz.php->changeTurnData
	returns:	Nothing
*/
function changeTurn($d, $ip, $token){
	//can they change the turn?
	//if true:
    if (verify_token($ip, $token)) {
	    changeTurnData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
        //logout();
    }
}
/*************************
	checkTurn
	takes: gameId
	uses in bizLayer: gameBiz.php->checkTurnData
	returns:	whoseTurn
				[{"whoseTurn":1}]
*/
function checkTurn($d, $ip, $token){
	//Can they check is it my turn yet?
	//if true:
    if (verify_token($ip, $token)) {
	    return checkTurnData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
        //logout();
    }
	
}
/*************************
	changeBoard
	takes: gameId~pieceId~boardI~boardJ~playerId
	uses in bizLayer: gameBiz.php->changeBoardData
	returns:	Nothing
*/
function changeBoard($d, $ip, $token){
	//can they change the board?
	//if true:
	//split the data  //data: gameId~pieceId~boardI~boardJ~playerId
							//38~piece_1|10~4~6~1

	//changeBoardData($gameId,$pieceId,$boardI,$boardJ,$playerId);
    if (verify_token($ip, $token)) {
        $h = explode('~',$d);
	    changeBoardData($h[0],$h[1],$h[2],$h[3],$h[4]);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
        //logout();
    }
}
/*************************
	getMove
	takes: gameId
	uses in bizLayer: gameBiz.php->getMoveData
	returns:	gameInfo
				[{"game_id":38,"whoseTurn":1,"player0_name":"Dan","player0_pieceID":"piece_0|10","player0_boardI":"6","player0_boardJ":"2","player1_name":"Fred","player1_pieceID":"piece_1|3","player1_boardI":"0","player1_boardJ":"2","last_updated":"0000-00-00 00:00:00"}]
*/
function getMove($d, $ip, $token){
	//if it is my turn and I should be here, get the other players move
    if (verify_token($ip, $token)) {
	    return getMoveData($d);
    } else {
        $result['token'] = 'fail';
        echo json_encode($result);
        //logout();
    }
}
?>