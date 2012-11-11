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

}
