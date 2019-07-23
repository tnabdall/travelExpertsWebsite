$(document).ready(function() {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    
    //following code will need to be duplicated for each card,modal, and rating
    //grab from db all agents get the required values set them
    
    
    for (var i=1; i<16; i++)
    {
        var cardId = '#contactCard'+i;
        
        $(cardId).click(function(){
            var modalId = $(this).attr('id').replace('contactCard','#modal'); //get the id of 'cardId' variable  $(this).attr('id'); replace the word contactCard with #modal so the outer function loop counter is applied to our inner function with the required name!
            $(modalId).modal('show');
        });

        $('#rating'+i)
        .rating();

        $('#rating'+i).rating('disable');
    }
    
});