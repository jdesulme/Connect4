$(document).ready(function(){
	//variable declarations
	var chatMessageBox = $("#send-message");
    var onlineUsers = $('#online-users-box');

    chatMessageBox.on("keydown",function(e){
		if (e.which === KEY.ENTER) {
            var message = chatMessageBox.val();
            chatMessageBox.val('');

            console.log(message);
            //send the user id as well

            //sendChat(player, txt, roomNum)
			sendChat(12,message,0);
		}	
	});

    onlineUsers.find('li.green').css('cursor', 'pointer');
    onlineUsers.on('click','li.green',function(){
        //ask the user if they really want to play the currently picked person
            //send the challenge  .... getChallengeCallback
        //else
            //don't do anything

        //?? Set a timer for 30 seconds
        //?? popup and notify the other user  (maybe look at the table)
        //??
        confirm(this.id + '  ' + $(this).text());
    });

	getChat();
    getOnlineUsers();
});

function getChallengeCallback(data){
    //getChallengeCallback
    //if the challenge is accepted
        //redirect them to the game itself
    //else
        //cancel the challenge and wait for the user
}
