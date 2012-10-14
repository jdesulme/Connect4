<?php
require_once("../dbInfoPS.inc");

//TODO: Change to the actual path --> ../../../dbInfoPS.inc
//include exceptions
require_once('../BizDataLayer/exception.php');

function login($user, $password){
    global $mysqli;

    $sql = "SELECT (password = ?) AS password_matches FROM user WHERE username = ?";

    $hash = hash('sha256', $password);

    try {
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param('ss',$hash, $user);
            $stmt->execute();
            $row = $stmt->fetch();

            if ($row === false) {
                // user does not exist
                $password_matches = $row[0];

                if (!$password_matches) {
                    // password given was incorrect
                }
            }

            //if it works generate the token (cookies) and automatically go to the main room
            //set their name in the session
            $stmt->close();
            $mysqli->close();
        } else {
            throw new Exception("An error occurred while fetching record data");
        }
    } catch(Exception $e){
        log_error($e, $sql, null);
        echo 'fail';
    }
}


function generate_account($username, $email, $pass, $samePass){
    //check to make sure the username doesn't already exist


}

function logout(){
    session_destroy();
    header("Location: /index.php");

}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}