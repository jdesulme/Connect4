<?php
require_once("settings.php");

//start the session
session_start();

new dBug($_COOKIE);
new dBug($_SESSION);

/*
//if not logged in, re-direct to login.php
if (empty($_SESSION['username']) ) {
    header("location: index.php");
}
*/

$page = new Page();
$page->html_header();


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

$page->html_footer();

?>