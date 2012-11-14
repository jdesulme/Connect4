$(document).ready(function(){
	//variable declarations

	var chatMessageBox = $("#send-message");
    chatMessageBox.on("keydown",function(e){
		if (e.which === KEY.ENTER) {
            var message = e.target.value;

            if (message !== ''){
                chatMessageBox.val('');
                sendChat(userID,message,gameID);
            }
		}
	});

    $('#online-users-box').on('click','li.green',function(){
        challengePlayer(this.id);
        //?? Set a timer for 30 seconds
        //?? popup and notify the other user  (maybe look at the table)
        //??
        console.log(this.id + '  ' + $(this).text());
    });

	getChat(gameID);
    getOnlineUsers();
    getProfilePic();
    checkForChallenge(userID);
});


function getOnlineUsers(){
    ajaxCall('POST', {a:'user',method:'getAllUsers', data: null}, getOnlineUsersCallback);
}

function getOnlineUsersCallback(users){
    var tmp = [];

    $.each(users, function(i,itm){
        if (itm.username !== username){
            var status;
            
            switch (itm.status){
                case -1 :
                    status = 'red';
                    break;
                case 1 :
                    status = 'green';
                    break;
                default :
                    status = 'yellow';
                    break;
            }

            tmp.push('<li id="'+ itm.id_user + '" class="' + status + '" >' + itm.username +'</li>');
        }
    });

    $('#online-users-box').html(tmp.join(''));

    setTimeout(function(){
        getOnlineUsers();
    }, 1500);
}

function getProfilePic(){
    ajaxCall('POST', {a:'user',method:'getAvatar',data:email}, loadLobbyProfilePic);

}

function loadLobbyProfilePic(img){
    $('#profilePic').html(img);
}