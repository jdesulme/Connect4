<?php
//start the session
session_name("JeanGame");
session_start();

require_once("settings.php");
//for working on local host
$ip = ($_SERVER['SERVER_NAME'] == 'localhost') ? '129.21.118.201' : $_SERVER['REMOTE_ADDR'];

if (!Authentication::checkToken($ip,$_COOKIE['token']) && $_SESSION['auth'] !== TRUE){
    header("Location: index.php");
} else if (!isset($_GET['gameID'])){
    header("Location: lobby.php");
}

$email = $_SESSION['data'][0]->email;
$userID = $_SESSION['data'][0]->id_user;
$username = $_SESSION['data'][0]->username;

Page::html_header(null,'Connect 4 - Game');
?>

    <header>
        <nav>
            <p>Connect 4</p>
            <p><span id="profilePic"></span></p>
            <p><?=$username?></p>
            <p><a id="logout">Logout</a></p>
        </nav>
    </header>

    <section class="game-board-outside-container">
        <svg xmlns="http://www.w3.org/2000/svg"
             version="1.1"  width="900px" height="700px">
            <!-- Make the background -> 800x600 -->
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
            <text x="650px" y="150px" id="output">
                cell id
            </text>
            <text x="650px" y="190px" id="output2">
                piece id
            </text>
        </svg>


        <section class="game-board-chat-container">
            <div id="game-board-chat-entry">
                <input type="text" id="send-message" maxlength="140" />
            </div>
        </section>
    </section>

    <script src="js/Objects/Cell.js" type="text/javascript"></script>
    <script src="js/Objects/Piece.js" type="text/javascript"></script>
    <script src="js/gameFunctions.js" type="text/javascript"></script>
    <script src="js/ajaxFunctions.js" type="text/javascript"></script>

    <script type="text/javascript">
        var gameId = <?=$_GET['gameID']?>;
        var player = "<?=$userID?>";
        //alert(playerId);
        initGameAjax('start', gameId);
    </script>

<?php


new dBug($ip);
new dBug($_SESSION);
new dBug($_COOKIE);
new dBug($_GET);

$js = array('chat');
Page::html_footer($js);



?>