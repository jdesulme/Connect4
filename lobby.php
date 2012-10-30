<?php
require_once("settings.php");
//start the session
session_name("Connect 4 - Jean");
session_start();

$ip = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') ? '129.21.118.201' : $_SERVER['REMOTE_ADDR'];

if (!Authentication::checkToken($ip,$_COOKIE['token'])){
    header("Location: index.php");
}

Page::html_header(null,'Connect 4 - Lobby');
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
        <ul id="lobby-chat-box"></ul>
        <ul id="online-users-box"></ul>
        <div id="chat-entry">
            <input type="text" id="send-message" maxlength="140" />
        </div>
    </section>

    <div class="line"></div>

    <script type="text/javascript">
        var username="<?=$_COOKIE['username']?>";
    </script>


<?php


$js = array('chat','challenge','lobby');
Page::html_footer($js);

new dBug($_SESSION);
new dBug($_COOKIE);


?>
