$(document).ready(function(){
	//variable declarations
	var $chatMessageBox = $("#send-message");

    $chatMessageBox.on("keydown",function(e){
		if (e.which === KEY.ENTER) {
            var chatMsg = $chatMessageBox.val();
            $chatMessageBox.val('');

            //send the user id as well

            //sendChat(player, txt, roomNum)
			sendChat(12,chatMsg,0);
		}	
	});
	
	
	getChat();
    getOnlineUsers();

});
