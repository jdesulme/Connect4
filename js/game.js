$(document).ready(function(){
    //variable declarations

    var chatMessageBox = $("#send-message");
    chatMessageBox.on("keydown",function(e){
        if (e.which === KEY.ENTER) {
            var message = e.target.value;

            if (message !== ''){
                chatMessageBox.val('');
                sendChat(userID,message,gameId);
            }
        }
    });


    getChat(gameId);
});