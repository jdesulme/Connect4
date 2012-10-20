<?php
class Authentication
{


    /**
     * Logs the user out
     * - destroys the sessions
     * - expires the cookie
     * - redirects
     */
    public function logout(){
        session_start();
        session_destroy();
        setcookie('token', '', time() - 1*24*60*60);
        header("location: index.php");
    }

}
