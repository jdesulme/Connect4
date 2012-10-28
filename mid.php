<?php

    //all calls to our SOA are going to go through here...
	if (isset($_REQUEST['method'])){
		//include all of the files in area 'a'
		foreach(glob("./svcLayer/".$_REQUEST['a']."/*.php") as $filename){
			include $filename;
		}

		$serviceMethod = $_REQUEST['method'];
		$data = $_REQUEST['data'];

        //captures local host
       // $ip = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') ? '129.21.118.201': $_SERVER['REMOTE_ADDR'];

		//make the call to the function $serviceMethod
		$result = @call_user_func($serviceMethod, $data, $_SERVER['REMOTE_ADDR'], $_COOKIE['token']);
		
		//might not be sending anything out
		if ($result){
			header("Content-type:application/json");
			echo $result;
		}
	}
?>