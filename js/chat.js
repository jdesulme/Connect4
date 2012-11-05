///////////////chat//////////////
var chatBox = $('#lobby-chat-box');
var KEY = {
		ENTER : 13
	};


function getChat(){
    ajaxCall('POST', {a:'chat',method:'getChat'}, getChatCallback);
}

function getChatCallback(users){
    var tmp = '';

    $.each(users, function(i,itm){
        tmp += '<li>';

        //don't display the message for the original player
        if(itm.username !== username){
            tmp += itm.username + ': ' ;
        }

        tmp += itm.message +' <span class="time_stamp"> ' + itm.time_stamp+'</span></li>';
    });

    chatBox.html('').append(tmp);
    scrollChatBox();
    setTimeout(getChat,1500);
}

function sendChat(player, txt, roomNum){
    var chatMsg = {
        id_user : player,
        message : txt,
        room    : roomNum
    };

	ajaxCall('POST', {a:'chat',method:'setChat', data:chatMsg}, null);
}





function prop(name){
    return function(object){
        return object[name];
    };
}


function scrollChatBox() {
    chatBox.scrollTop(chatBox[0].scrollHeight - chatBox[0].clientHeight);
}

