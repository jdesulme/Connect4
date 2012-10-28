<?php
//ALL game goes in this folder

	function checkTurn($d,$ip,$token){
		//a VERY good idea to check the token make sure they should be here - then...

		//we should be here (security checked!)
		//prepare data "num|num"
		$h=explode('|',$d);
		$gameId=$h[0];
		$userId=$h[1];
		
		//go to game layer and run this function
		require_once('./BizDataLayer/checkTurn.php');

			echo(checkTurnData($gameId,$userId));
		
	}



?>