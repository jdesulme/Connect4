<?php
//start the session
session_name("JeanGame");
session_start();

require_once("settings.php");
//for working on local host
$ip = ($_SERVER['SERVER_NAME'] == 'localhost') ? '129.21.118.201' : $_SERVER['REMOTE_ADDR'];

if (!Authentication::checkToken($ip,$_COOKIE['token']) && $_SESSION['auth'] !== TRUE){
    header("Location: index.php");
} else if (!isset($_GET['gameId'])){
    header("Location: lobby.php");
}

$email = $_SESSION['data'][0]->email;
$userID = $_SESSION['data'][0]->id_user;


Page::html_header(null,'Connect 4 - Game');
?>

    <header>
        <nav>
            <p>Connect 4</p>
            <p><span id="profilePic"></span></p>
            <p><?=$_GET['player']?></p>
            <p><a id="logout">Logout</a></p>
        </nav>
    </header>

    <section class="game-board-outside-container">
        <section class="game-board-chat-container">
            <ul id="lobby-chat-box"></ul>
            <input type="text" id="send-message" maxlength="140" />
        </section>

        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"  width="700px" height="580px">
            <rect x="0px" y="0px" width="100%" height="100%" id="background" />
            <text x="20px" y="20px" id="youPlayer">
                You are:
            </text>
            <text x="270px" y="20px" id="nyt" fill="red" display="none">
                NOT YOUR TURN!
            </text>
            <text x="270px" y="20px" id="nyp" fill="red" display="none">
                NOT YOUR PIECE!
            </text>
            <text x="520px" y="20px" id="opponentPlayer">
                Opponent is:
            </text>
            <text x="550px" y="150px" id="output">
                cell id
            </text>
            <text x="550px" y="190px" id="output2">
                piece id
            </text>
        </svg>
    </section>

    <script src="js/ajaxFunctions.js" type="text/javascript"></script>
    <script src="js/gameFunctions.js" type="text/javascript"></script>
    <script src="js/Objects/Cell.js" type="text/javascript"></script>
    <script src="js/Objects/Piece.js" type="text/javascript"></script>
    <script src="js/chat.js" type="text/javascript"></script>
    <script src="js/game.js" type="text/javascript"></script>

    <script type="text/javascript">
        var gameId = <?=$_GET['gameId']?>;
        var player = "<?=$_GET['player']?>";
        var username = "<?=$_GET['player']?>";
        var userID = <?=$userID?>;

        //alert(playerId);
        initGameAjax('start', gameId);


    </script>

<?php

Page::html_footer();

?>