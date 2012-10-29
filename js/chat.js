///////////////chat//////////////
var KEY = {
		ENTER : 13
	};


function getChat(){
    ajaxCall('POST', {a:'chat',method:'getChat'}, getChatCallback);
    scrollChatBox();
}

function getChatCallback(users){
   // var names = users.map(function(u){ return u.name; });
    //var strNames = "Users " + users.map(prop("name")).join(", ");

   var names = users.map(prop("name"));
   // var users = data[0];


    console.dir(users);


    var h='';
    for(var i=0, l=users.length; i<l; i++){
        h+=users[i].name+' says: '+users[i].message+'<span style="color:gray"> at the time '+users[i].time_stamp+'</span><br/>';
    }

    $('#lobby-chat-box').html(h);
    setTimeout(getChat,1500);
}

function sendChat(player, txt, roomNum){
    var chatMsg = {
        id_user : player,
        message : txt,
        room    : roomNum
    };

	ajaxCall('POST', {a:'chat',method:'setChat', data:chatMsg}, setChatCallback);
}

function setChatCallback(data){
	console.log(data);
}





function prop(name){
    return function(object){
        return object[name];
    };
}


function scrollChatBox() {
    var $chat = $('#lobby-chat-box');
    $chat.scrollTop($chat[0].scrollHeight - $chat[0].clientHeight);
}