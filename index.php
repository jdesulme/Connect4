<?php

error_reporting(E_ALL);

function get_gravatar( $email, $s = 50, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
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

$image_url = get_gravatar('jdesulme@gmail.com');


echo '<img src="' . $image_url . '" alt="name">';

print "<br /><br /><br /><br />";

require_once('lib/Token.class.php');


$tokens = new Token();
$result = $tokens->generate_token();
	
print "<br /><br /><br /><br />";

$tokens->verify_token($result, $_SERVER['REMOTE_ADDR']);

?>

