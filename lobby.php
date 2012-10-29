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
        var player="<?php ?>";
    </script>


<?php


$js = array('chat','challenge','lobby');
$page->html_footer($js);

new dBug($_SESSION);
new dBug($_COOKIE);

?>
