<?php
//start the session
session_start();

require_once("settings.php");

//if not logged in, re-direct to login page
if ( empty($_SESSION['username']) || empty($_COOKIE['token']) ) {
    header("location: index.php");
}

Page::html_header(null,'Connect 4 - Game');

new dBug($_COOKIE);
new dBug($_SESSION);

?>

    <header>
        <nav>
            <p>Connect 4</p>
            <p>Profile Pic</p>
            <p>Username</p>
            <p><a id="logout">Logout</a></p>
        </nav>
    </header>

    <section class="game-outside-container">


    </section>

<?php


Page::html_footer();

?>