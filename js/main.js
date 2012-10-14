/**
 * A generic ajax function for SOA
 *
 * @param getPost http method get or post
 * @param d the data being passed in
 * @param callback the data being returned
 */
function ajaxCall(getPost, d, callback){
    $.ajax({
        type:getPost,
        async:true,
        cache:false,
        data:d,
        url:"mid.php",
        dataType:'json',
        success:callback
    });
}

$('#login').submit(function(e){
    var d = $(e.target).serializeArray();
    ajaxCall('post',{a:'user',method:'registerUser',data:d},getNewUserCallback);
    return false;
});


$('#register').submit(function(e){
    var d = $(e.target).serializeArray();
    ajaxCall('post',{a:'user',method:'registerUser',data:d},getNewUserCallback);
    return false;
});

$('#email').on('change',function(e){
    var d = e.target.value;
    ajaxCall('post',{a:'user',method:'getAvatar',data:d},loadGravatar);
});

function loadGravatar(url){
    console.log(url);
    var img = $("<img />").attr('src', url)
        .load(function() {
            if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                alert('broken image!');
            } else {
                $("#message").append(img);
            }
        });
}



function getNewUserCallback(data){
    console.log(data);
    $('#register').slideUp('slow', function(){
        $("#message").html("<p class='success'>You now have an account!</p>");
    })
}



function checkPasswordMatch(input){
    var pass = document.getElementById('password').value;
    if (input.value == pass) {
        input.setCustomValidity('');
    } else {
        input.setCustomValidity("The two passwords must match!");
    }
}