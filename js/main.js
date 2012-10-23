//SAMPLE!!!!!
$(document).ready(function(){
    //getChat();
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
