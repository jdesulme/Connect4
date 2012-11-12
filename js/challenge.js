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
 * @param data
 */
function checkForChallengeCallback(data){
    if (data){
        console.log(data);
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
                    var challengeData = userID + '|' + 'A';
                    ajaxCall('POST', {a:'challenge',method:'updateChallenge', data:challengeData}, acceptedChallengeCallback);

                    $(this).dialog("close");
                },
                "No": function() {
                    var challengeData = userID + '|' + 'D';
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
    console.log(data)
    window.location = 'game.php';
    //needs the game id
    //along with the associated players

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
                ajaxCall('POST', {a:'challenge',method:'setChallenge', data:challengeData}, challengePlayerCallback);

                $(this).dialog( "close" );

            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}



function rejectedChallengeCallback(data){
    console.log(data)
}

/**
 *
 * @param data
 */
function challengePlayerCallback(data){

    setTimeout(function(){
        //look for the status of my sent challenge
    }, 2000);

    //getChallengeCallback
    //if the challenge is accepted
    //redirect them to the game itself
    //else
    //cancel the challenge and wait for the user
}


function checkSentChallenge(userID){
    ajaxCall('POST', {a:'challenge',method:'getChallengeStatus', data:userID}, challengePlayerCallback);
}