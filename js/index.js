// Authors: Tarik Abdalla
// Date: July 31,2019
// Version: 2.5
// Functionality: Sets up carousel, modals, and vacation package cards

$(document).ready(function () {
    // Shows 3 or 1 card based on window width (responsive design)
    if ($(window).width() > 530) {
        $('#cardCarousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnHover: true,
            arrows: false
        });
    } else {
        $('#cardCarousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnHover: true,
            arrows: false
        });
    }

    // Click event for accordion on cards
    $('.title').on('click', function () {
        // Changes margin based on if accordion is open
        if ($('#travelImageSection').css('margin-bottom') == '200px') {
            $('#travelImageSection').css('margin-bottom', '30px');
        } else {
            $('#travelImageSection').css('margin-bottom', '200px');
        }
        // Makes accordion show/hide content (by adding/removing active class)
        if ($(this).attr("class") == 'title') {
            $(this).attr("class", "active title");
            $(this).next().attr("class", "active content");
            $('#cardCarousel').slick('slickPause'); // Pauses carousel
        } else {
            $(this).attr("class", "title");
            $(this).next().attr("class", "content");
            $('#cardCarousel').slick('slickPlay'); // Resumes the carousel
        }
    });

    // Shows order modal on order button click
    $(".orderSubmit").click(function () {
        $("#modalConfirm").show();
    })

    // If agent is logged in, delete order buttons
    if(document.cookie.indexOf('user_type=')!=-1){
        console.log('removing buttons');
        $('button').remove();
        document.cookie = "user_type= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    }

});