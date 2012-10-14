<?php


function registerUser($d,$ip,$token){
    //a VERY good idea to check the token make sure they should be here - then...

    echo var_dump($d);
    //we should be here (security checked!)
    //prepare data "num|num"
    $h=explode('|',$d);
    $gameId=$h[0];
    $userId=$h[1];

    //go to game layer and run this function
    require_once('BizDataLayer/userData.php');

    //echo generate_account()

}

function getAvatar($email){
    require_once('BizDataLayer/userData.php');
    echo "WTF";
    echo get_gravatar($email);
}