$(document).ready(function() {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    
    //following code will need to be duplicated for each card,modal, and rating
    //grab from db all agents get the required values set them
    $('#contactCard1').click(function(){
        $('#modal1').modal('show');
    });

    $('#rating1')
    .rating({
        initialRating: 3,
        maxRating: 5,
    });
    
    $('#rating1').rating('disable');
    
});