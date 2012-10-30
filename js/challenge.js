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



