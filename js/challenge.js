
/**
 * Polls the database looking to see if one is available
 */
function checkForChallenge(username){
    ajaxCall('POST', {a:'challenge',method:'getChallengeByID', data:username}, getChallengesCallback);
}

function checkForChallengeCallback(){
    //popup a dialog screen
    //make it last only for 30 seconds
        //after 30 seconds go away and remove the challenge

}


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
                $( this ).dialog( "close" );

                //sends the challenge to the player
                var challengeData = challengeId + '|' + userID;
                ajaxCall('POST', {a:'challenge',method:'sendChallenge', data:challengeData}, challengePlayerCallback);

            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}

function challengePlayerCallback(data){
    //getChallengeCallback
    //if the challenge is accepted
    //redirect them to the game itself
    //else
    //cancel the challenge and wait for the user

}