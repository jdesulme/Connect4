<?php
//start the session
session_start();

//if not logged in, re-direct to login.php
if ( empty($_SESSION['user_name']) || empty($_COOKIE['token']) ) {
    header("location: index.php");
}

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

    <script type="text/javascript">
        var player="<?php ?>";
    </script>

<?php

$js = array('chat','challenge','lobby');
$page->html_footer($js);

?>