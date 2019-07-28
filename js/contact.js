$(document).ready(function() {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    
    //following code will need to be duplicated for each card,modal, and rating
    //grab from db all agents get the required values set them
    
    
    for (var i=1; i<$('.ui.card').length+1; i++)
    {
        var cardId = '#contactCard'+i;
        
        $(cardId).click(function(){
            //get the id of 'cardId' element from the $(document).ready(function.. scope; variable  $(this).attr('id'); 
            //replace the word contactCard with #modal so the outer 
            //function loop counter is applied to our inner function with the required name!
            var modalId = $(this).attr('id').replace('contactCard','#modal'); 
            console.log(modalId);
            $(modalId).modal('show');
        });

        $(".contactButton").click(function(){
            $('#submit').val($(this).val());
        })

        $('#rating'+i)
        .rating();

        $('#rating'+i).rating('disable');
    }
    
});