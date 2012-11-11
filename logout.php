<?php
session_name("JeanGame");
session_start();

require_once("settings.php");


// Unset all of the session variables.
$_SESSION = array();

// Finally, destroy the session.
session_destroy();

//destroy the cookies now
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    setcookie("token", '', time() - 42000, '/','');
} else {
    setcookie("token", '', time() - 42000, '/~jxd1827/Connect4','nova.it.rit.edu');
}

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

new dBug($_SESSION);

?>
