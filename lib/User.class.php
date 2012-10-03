<?php

/**
 * PHP Class for USER access
 *
 * @author Jeanyhwh Desulme
 */


/*
 * Database should contain
 * user_id (PK)
 * first_name
 * last_name
 * username
 * password
 * email
 * last_login
 *
 *
 *
 */

class User {

    function login($user=false,$pass=false){
        self::_construct($user,$pass);
    }

    function _construct($user, $pass=false){
        if($user === false) return;

        if(!isset($_SESSION)){
            session_start();
        }



    }


    function log_login(){

    }

    function register($info){
        //should request full name
        //email
        //nickname

    }



    function logout(){


    }

    function verify_user($userID){


    }
}

?>