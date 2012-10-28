$(document).ready(function(){
	//variable declarations
	var $chatMessageBox = $("#send-message");
	
	$chatMessageBox.on("keydown",function(e){
		if (e.which == KEY.ENTER) {
			//send the user id as well

            //sendChat(player, txt, roomNum)
			sendChat(1,$chatMessageBox.val(),0);
		}	
	});
	
	
	getChat();
	
});
