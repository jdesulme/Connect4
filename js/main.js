$(document).ready(function(){
    var username;

    $('button').button();

    $('#logout').on('click', function(){
        ajaxCall('post', {a:'user',method:'logout',data:username}, null);
        document.location = 'logout.php';
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
    $(this).text('Triggered ajaxComplete handler.');
});

//http://www.jblotus.com/2011/05/24/keeping-your-handlebars-js-templates-organized/
