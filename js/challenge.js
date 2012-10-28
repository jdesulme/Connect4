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

    var h='';
    for(var i=0, l=users.length; i<l; i++){
        h += users[i].username+ ' '+users[i].id_user+'  '+users[i].status + '<br/>';
    }

    $('#online-users-box').html(h);

    setTimeout(getOnlineUsers,1500);
}
