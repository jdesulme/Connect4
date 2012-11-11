<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jdesulme
 * Date: 10/30/12
 * Time: 2:04 AM
 * To change this template use File | Settings | File Templates.
 */
class Authentication
{
    /**
     * Checks to make sure the token is actually valid
     * @param $ip
     * @param $token
     * @return bool
     */
    public static function checkToken($ip, $token){
        require_once './svcLayer/security.php';
        return verify_token($ip,$token);
    }

    public static function getUserInformation($ip, $token){
        if (checkToken($ip, $token)){
            require_once './svcLayer/user/userSvc.php';

        }


        return getAllUsers(null,$ip,$token);

        /*
        //decodes the users's information
        $userData = json_decode(getUserData($loginData['username']));

        //sets the session variables
        $_SESSION['username'] = $userData['username'];
        $_SESSION['id_user'] = $userData['id_user'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['win'] = $userData['win'];
        $_SESSION['loss'] = $userData['loss'];
        $_SESSION['last_login'] = $userData['last_login'];
        $_SESSION['auth'] = true;
        */

    }
}
