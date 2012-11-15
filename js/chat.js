///////////////chat//////////////
var chatBox = $('#lobby-chat-box');
var KEY = {
		ENTER : 13
	};

/**
 * Retrieves the chats for a given room
 * @param roomNum
 */
function getChat(roomNum){
    var chatRm = {
        room    : roomNum
    };

    ajaxCall('POST', {a:'chat',method:'getChat', data:chatRm}, getChatCallback);
}

/**
 * Displays all the chats in chat box
 * @param users
 */
function getChatCallback(users){
    if (users !== null) {
        var tmp = '';
        $.each(users, function(i,itm){
            tmp += '<li>';

            //don't display the message for the original player
            if(itm.username !== username){
                tmp += itm.username + ': ' ;
            }

            tmp += itm.message +' <span class="time_stamp"> ' + itm.time_stamp+'</span></li>';
        });

        chatBox.html(tmp);
        scrollChatBox();
    }
    setTimeout(function(){
        getChat(gameId);
    }, 2000);
}

/**
 * Sends the chat message to the database
 * @param player - the player currently logged in
 * @param txt - message written
 * @param roomNum - the lobby or game id
 */
function sendChat(player, txt, roomNum){
    var chatMsg = {
        id_user : player,
        message : txt,
        room    : roomNum
    };

	ajaxCall('POST', {a:'chat',method:'setChat', data:chatMsg}, null);
}


/**
 * Fixes the height of the chat box div to make it go to the bottom
 */
function scrollChatBox() {
    chatBox.scrollTop(chatBox[0].scrollHeight - chatBox[0].clientHeight);
}

