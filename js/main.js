$(document).ready(function(){
    $('#login_form').submit(function(e){
        var d = $('#login_form').serialize();
        ajaxCall('post',{a:'user',method:'loginUser',data:d},getLoginCallback);
        return false;
    });

    $('#register').submit(function(e){
        var d = $(e.target).serialize();
        ajaxCall('post',{a:'user',method:'registerUser',data:d},getNewUserCallback);
        return false;
    });

    $('#email').on('change',function(e){
        var d = e.target.value;
        ajaxCall('post',{a:'user',method:'getAvatar',data:d},loadGravatar);
    });

});



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
        url:"./mid.php",
        dataType:'json',
        success:callback
    });
}


//http://www.jblotus.com/2011/05/24/keeping-your-handlebars-js-templates-organized/



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

function getLoginCallback(data){
    alert(data);
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