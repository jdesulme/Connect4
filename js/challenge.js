/**
 * Created with JetBrains PhpStorm.
 * User: student
 * Date: 10/27/12
 * Time: 6:48 PM
 * To change this template use File | Settings | File Templates.
 */

function getOnlineUsers(){
    ajaxCall('POST', {a:'user',method:'getAllUsers'}, getOnlineUsersCallback);
}

function getOnlineUsersCallback(users){
    var tmp = '';

    $.each(users, function(i,itm){
        var status = (itm.status > 0) ? 'green' : 'red';
        tmp += '<li id="'+ itm.id_user + '" class="' + status + '" >' + itm.username +'</li>';
    });

    $('#online-users-box').html('').append(tmp);
    setTimeout(getOnlineUsers,1500);
}

/**
 * Polls the database looking to see if one is available
 */
function checkForChallenge(username){
    ajaxCall('POST', {a:'challenge',method:'getChallengeByID', data:username}, getOnlineUsersCallback);
}

function checkForChallengeCallback(){
    //popup a dialog screen
    //make it last only for 30 seconds
        //after 30 seconds go away and remove the challenge

}

