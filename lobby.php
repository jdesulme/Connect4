<?php
//start the session
session_name("JeanGame");
session_start();

require_once("settings.php");
//for working on local host
$ip = ($_SERVER['SERVER_NAME'] == 'localhost') ? '129.21.118.201' : $_SERVER['REMOTE_ADDR'];

if (!Authentication::checkToken($ip,$_COOKIE['token']) && $_SESSION['auth'] !== TRUE){
    header("Location: index.php");
}

$email = $_SESSION['data'][0]->email;
$userID = $_SESSION['data'][0]->id_user;
$username = $_SESSION['data'][0]->username;

Page::html_header(null,'Connect 4 - Lobby');
?>

    <header>
        <nav>
            <p>Connect 4</p>
            <p><span id="profilePic"></span></p>
            <p><?=$username?></p>
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

    <div class="log"></div>

    <div id="dialog-send-challenge" title="Challenge Player?">
        <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Do you want to challenge this player to a game?</p>
    </div>


    <div id="dialog-new-challenge" title="New Challenge">
        <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>You have been challenged to a game. Would you like to play?</p>
    </div>

    <div id="dialog-reject-challenge" title="Challenge Rejected">
        <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Your challenge request has been rejected.</p>
    </div>


    <script type="text/javascript">
        var userID = <?=intval($userID)?>;
        var username = "<?=$username?>";
        var email = "<?=$email?>";
        var gameId = 0;
    </script>


<?php
$js = array('chat','challenge','lobby');
Page::html_footer($js);
?>
