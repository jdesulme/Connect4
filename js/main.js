$(document).ready(function(){
    //handles the login submission
    $('#login_form').submit(function(){
        var d = $('#login_form').serialize();
        ajaxCall('post',{a:'user',method:'loginUser',data:d},getLoginRegistrationCallback);
        return false;
    });

    //handles the registration submission
    $('#register_form').submit(function(e){
        var d = $(e.target).serialize();
        ajaxCall('post',{a:'user',method:'registerUser',data:d},getLoginRegistrationCallback);
        return false;
    });

    //sends a request to gravatar.com asking for the user's image
    $('#email').on('change',function(e){
        var d = e.target.value;
        ajaxCall('post',{a:'user',method:'getAvatar',data:d},loadProfileImage);
    });

    $('button').button();

    //SAMPLE!!!!!
    getChat();
});


///////////////chat//////////////
function getChat(){
    ajaxCall('get',{a:'chat',method:'getChat'},getChatCallback);

    var $chat = $('#lobby-chat-box');
    $chat.scrollTop($chat[0].scrollHeight);
}


function getChatCallback(users){
    var names = users.map(function(u){ return u.name; });
    var strNames = "Users " + users.map(prop("name")).join(", ");
    console.log(strNames);

    var h='';
    for(var i=0, l=users.length; i<l; i++){
        h+=users[i].name+' says: '+users[i].message+'<span style="color:gray"> at the time '+users[i].timeStamp+'</span><br/>';
    }

    $('#lobby-chat-box').html(h);
    setTimeout(getChat,1500);
}


function prop(name){
    return function(object){
        return object[name];
    };
}










/**
 * A generic ajax function for SOA
 *
 * @param getPost http method get or post
 * @param d the data being passed in
 * @param callback the data being returned
 */
function ajaxCall(getPost, d, callback){
    $.ajax({
        type:getPost,
        async:true,
        cache:false,
        data:d,
        url:"./mid.php",
        dataType:'json',
        success:callback
    });
}


//http://www.jblotus.com/2011/05/24/keeping-your-handlebars-js-templates-organized/


/**
 * Loads a preview image
 * @param img
 */
function loadProfileImage(img){
    $(".gravatar-text")
        .html('')
        .append(img);
}

/**
 * Information retrieved from the svc layer
 * @param msg
 */
function getLoginRegistrationCallback(msg){
    var $message = $('#message');

    $message
        .attr('class', msg.status)
        .html(msg.message);

    //notify the user of failure
    if (msg.status === 'error') {
        $('#login_form, #register_form').effect("shake", {times:2}, 100);
    }

    //redirect to the lobby page
    if (msg.status === 'success') {
        $message
            .html('Logging in.....')
            .fadeTo(900,1, function(){
                document.location='lobby.php';
            });
    }
}

/**
 * Validates the password fields making sure they are the same
 * @param input
 */
function checkPasswordMatch(input){
    var pass = document.getElementById('password').value;
    if (input.value === pass) {
        input.setCustomValidity('');
    } else {
        input.setCustomValidity("The two passwords must match!");
    }
}