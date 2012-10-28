/**
 * Created with JetBrains PhpStorm.
 * User: student
 * Date: 10/27/12
 * Time: 6:48 PM
 * To change this template use File | Settings | File Templates.
 */

function getOnlineUsers(){
    ajaxCall('GET', {a:'user',method:'getAllUsers'}, getOnlineUsersCallback);


}

function getOnlineUsersCallback(data){
    console.log(data);
    //#online-users-box
    setTimeout(getOnlineUsers,1500);
}
