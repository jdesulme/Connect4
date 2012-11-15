$(document).ready(function(){
    $('button').button();

    //logs the user out when clicked
    $('#logout').on('click', function(){
        ajaxCall('post', {a:'user',method:'logout',data:username}, null);
        window.location = 'logout.php';
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


$('.log').ajaxComplete(function(e, xhr, settings) {
    //console.log(xhr.responseText);
    //TODO: Do something with the token fail data

});
