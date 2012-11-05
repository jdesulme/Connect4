<?php
/**
 * Created by JetBrains PhpStorm.
 * User: student
 * Date: 10/27/12
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
require_once("settings.php");

session_name("Connect 4 - Jean");
session_start();


// Unset all of the session variables.
$_SESSION = array();

// Finally, destroy the session.
session_destroy();

//destroy the cookies now
setcookie("token", '', time() - 42000, '/~jxd1827/Connect4','nova.it.rit.edu');

Page::html_header();
?>

    <section class="main-outside-container">
        <div class="container">
            <p>Thanks for playing the game. You are now logged out.</p>
            <p>We hope to see you soon.</p>
        </div>
    </section>


<?php
Page::html_footer();



?>
