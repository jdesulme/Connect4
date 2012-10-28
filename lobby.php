<?php
//start the session
session_start();

//if not logged in, re-direct to login
/*
if ( !isset($_SESSION['username']) || !isset($_COOKIE['token']) ) {
    header("location: index.php");
}
*/

require_once("settings.php");

$page = new Page();
$page->html_header(null,'Connect 4 - Lobby');
?>

    <header>
        <p>Profile Pic</p>
        <p>Username</p>
        <button id="logout">Logout</button>
    </header>

    <section class="game-outside-container">

            <aside id="online-users">
                <nav>Online Users</nav>
                <div id="online-users-box"></div>
            </aside>

            <aside id="main-lobby-chat">
                <nav>Chat Room</nav>
                <div id="lobby-chat-box"></div>
                <div class="lobby-send-box">
                    <label for="send-message">Chat Message</label>
                    <input id="send-message" type="text">
                </div>
            </aside>

    </section>

    <div class="log"></div>

    <script type="text/javascript">
        var player="<?php ?>";
    </script>


<?php

new dBug($_SESSION);
new dBug($_COOKIE);

$js = array('chat','challenge','lobby');
$page->html_footer($js);

?>