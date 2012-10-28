/**
 * Created with JetBrains PhpStorm.
 * User: jdesulme
 * Date: 10/21/12
 * Time: 8:15 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function() {    //handles the login submission
    $('#login_form').submit(function(e){
        var formData = $(e.target).serialize();
        ajaxCall('POST', {a:'user',method:'loginUser',data:formData}, getLoginRegistrationCallback);
        return false;
    });

    //handles the registration submission
    $('#register_form').submit(function(e){
        var formData = $(e.target).serialize();
        ajaxCall('POST', {a:'user',method:'registerUser',data:formData}, getLoginRegistrationCallback);
        return false;
    });

    //sends a request to gravatar.com asking for the user's image
    $('#email').on('change',function(e){
        var formData = e.target.value;
        ajaxCall('POST', {a:'user',method:'getAvatar',data:formData}, loadProfileImage);
    });
});


/**
 * Loads a preview image
 * @param img
 */
function loadProfileImage(img){
    $('.gravatar-text')
        .html('')
        .append(img);
}

/**
 * Information retrieved from the svc layer
 * @param msg
 */
function getLoginRegistrationCallback(msg){
    var $messageBox = $('#message');

    $messageBox
        .attr('class', msg.status)
        .html(msg.message);

    //notify the user of failure
    if (msg.status === 'error') {
        $('#login_form, #register_form').effect("shake", {times:2}, 100);
    }

    //redirect to the lobby page
    if (msg.status === 'success') {
        $messageBox
            .html('Logging in.....')
            .fadeTo(900,1, function(){
                document.location='lobby.php';
            });
    }
}

/**
 * Validates the password fields making sure they are the same
 * @param input
 */
function checkPasswordMatch(input){
    var pass = document.getElementById('password').value;
    if (pass === input.value) {
        input.setCustomValidity('');
    } else {
        input.setCustomValidity("The two passwords must match!");
    }
}
