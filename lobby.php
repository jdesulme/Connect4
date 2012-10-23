<?php
//start the session
session_start();

//if not logged in, re-direct to login.php
/*
if ( empty($_SESSION['user_name']) && empty($_COOKIE['token']) ) {
    header("location: index.php");
}
*/
require_once("settings.php");

$page = new Page();
$page->html_header(null,'Connect 4 - Lobby');
?>

<section>
    <aside id="main-lobby-chat">
        <nav>Chat Room</nav>
        <div id="lobby-chat-box"></div>
        <hr />
        <label for="send-message">Chat Message</label>
        <input id="send-message" type="text">
        <button>Send</button>
    </aside>
</section>

<?php

$js = array();
$page->html_footer($js);

?>