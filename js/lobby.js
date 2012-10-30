$(document).ready(function(){
	//variable declarations
	var $chatMessageBox = $("#send-message");

    $chatMessageBox.on("keydown",function(e){
		if (e.which === KEY.ENTER) {
            var message = $chatMessageBox.val();
            $chatMessageBox.val('');

            console.log(message);
            //send the user id as well

            //sendChat(player, txt, roomNum)
			sendChat(12,message,0);
		}	
	});
	
	
	getChat();
    getOnlineUsers();
});
