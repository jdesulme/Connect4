/***************POV from the Challengee ***************/


/**
 * Polls the database looking to see if a challenge is available
 * @param userID
 */
function checkForChallenge(userID){
    ajaxCall('POST', {a:'challenge',method:'getChallenge', data:userID}, checkForChallengeCallback);
}

/**
 * The callback that keeps checking until something arrives
 * @param jsonObj
 */
function checkForChallengeCallback(jsonObj){
    if (jsonObj){

        var player1 = jsonObj[0].player_0;
        var player2 = jsonObj[0].player_1;

        //popup a dialog screen
        //make it last only for 30 seconds
        //after 30 seconds go away and remove the challenge
        //tag.html(data.html).dialog({modal: options.modal, title: data.title}).dialog('open');
        $("#dialog-new-challenge").dialog({
            autoOpen: open,
            resizable: false,
            modal: true,
            buttons: {
                "Yes": function() {
                    //accepts the challenge to the player
                    var challengeData = player1 + '|' + player2  + '|' + 'A';
                    ajaxCall('POST', {a:'challenge',method:'updateChallenge', data:challengeData}, acceptedChallengeCallback);
                    $(this).dialog("close");
                },
                "No": function() {
                    //denies the challenge and updates the database
                    var challengeData = player1 + '|' + player2  + '|' + 'D';
                    ajaxCall('POST', {a:'challenge',method:'updateChallenge', data:challengeData}, null);
                     $(this).dialog("close");
                }
            }
        });
    } else {
        setTimeout(function(){
            checkForChallenge(userID);
        }, 2000);
    }
}

/**
 * Redirects the player to the game board
 * @param data
 */
function acceptedChallengeCallback(data){
    //create the game board now and update the challenge record with the gameid
    //needs the game id
    //along with the associated players

    window.location = 'game.php?gameId=' + data.gameId + '&player=' + username;
}


/***************POV from the Initiator ***************/

/**
 * The logged in player selects an active player to challenge
 * @param challengeId
 */
function challengePlayer(challengeId ) {
    //ask the user if they really want to play the currently picked person
        //send the challenge  .... getChallengeCallback
    //else
        //don't do anything
    $("#dialog-send-challenge").dialog({
        autoOpen: open,
        resizable: false,
        modal: true,
        buttons: {
            "Yes": function() {
                //sends the challenge to the player
                var challengeData = userID + '|' + challengeId ;
                ajaxCall('POST', {a:'challenge',method:'setChallenge', data:challengeData}, checkSentChallenge);
                $(this).dialog( "close" );

            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}

/**
 * Checks the database to see if there has been response
 * @param data
 */
function checkSentChallenge(data){
    console.log("checkSentChallenge: " + data[0].id_challenges);
    ajaxCall('POST', {a:'challenge',method:'getChallengeStatus', data: data[0].id_challenges}, challengePlayerCallback);
}


/**
 * Retrieves the response for the sent challenge
 * @param data
 */
function challengePlayerCallback(data){
    //getChallengeCallback
    //if the challenge is accepted
        //redirect them to the game itself
    //else
        //cancel the challenge and wait for the user
    console.dir(data);

    if (data[0].state === 'A'){
        console.log('Challenge Accepted -> Go to the game');
        //redirects and updates their status
        var playerInfo = data[0].id_challenges + '|' + userID;
        ajaxCall('POST', {a:'user',method:'updatePlayerStatus', data: playerInfo}, null);
        window.location = 'game.php?gameId=' + data[0].gameId  + '&player=' + username;

   } else if (data[0].state === 'D') {
        console.log('Challenge Denied -> Display a message');
        alert('Challenge Denied');

    } else {
        setTimeout(function(){
            //look for the status of my sent challenge
            checkSentChallenge(data);
        }, 2000);
    }
}

function rejectedChallengeCallback(data){
    console.log(data);
}


