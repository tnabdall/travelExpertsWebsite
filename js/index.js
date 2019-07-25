$(document).ready(function(){
    // addAccordionEvents();
    if($(window).width()>1000){
        $('#cardCarousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnHover: true,
            arrows: false
        });
    }
    else{
        $('#cardCarousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnHover: true,
            arrows: false
        });
    }
    $('.title').on('click', function(){
        if($('#travelImageSection').css('margin-bottom')=='200px'){
            $('#travelImageSection').css('margin-bottom','30px');
        }
        else{
            $('#travelImageSection').css('margin-bottom','200px');
        }
        if($(this).attr("class")=='title'){
            $(this).attr("class","active title");
            $(this).next().attr("class","active content");
        }
        else{
            $(this).attr("class","title");
            $(this).next().attr("class","content");
            $('#cardCarousel').slick('slickPlay');
        }
    });
    // resizeCardHeight();
   
 });


 function resizeCardHeight(){
    var maxHeight=0;    
    $('.item.card').each(function(){
        // $('.title').each(function(){$(this).attr("class","active title");});
        // $('.content').each(function(){$(this).attr("class","active content");});
        var img = $(this).children(".image");
        var imgHeight = img.height();
        // console.log(imgHeight);
        var cardHeight = $(this).height()-imgHeight+500;
        console.log(cardHeight);
        if(cardHeight>maxHeight){
            maxHeight=cardHeight;
        }
    })
    console.log(maxHeight);
    $('.item.card').css("min-height",maxHeight);
    $('.title').each(function(){$(this).attr("class","title");});
    $('.content').each(function(){$(this).attr("class","content");});
 }


