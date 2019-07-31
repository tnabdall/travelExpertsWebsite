// Authors: Owiny Ayorech
// Date: July 31,2019
// Version: 2.5
// Functionality: Sets up modals and card ratings

$(document).ready(function () {
    setTimeout('$("#container").css("opacity", 1)', 1000);

    // Loop through cards
    for (var i = 1; i < $('.ui.card').length + 1; i++) {
        var cardId = '#contactCard' + i;

        // Onclick show modal
        $(cardId).click(function () {
            //get the id of 'cardId' element from the $(document).ready(function.. scope; variable  $(this).attr('id'); 
            //replace the word contactCard with #modal so the outer 
            //function loop counter is applied to our inner function with the required name!
            var modalId = $(this).attr('id').replace('contactCard', '#modal');
            $(modalId).modal('show');
        });

        // On click create cookie with agent ID 
        $(".contactButton").click(function () {
            // console.log($(this).attr("value"));
            document.cookie = "varAgent=" + $(this).attr("value");
        })

        // Stores the user contact email in a cookie
        $('.emailContact').on('change', function () {
            document.cookie = "emailAgent=" + this.value;
        });

        // Semantic UI rating settings to show rating and disable clicking to rate
        $('#rating' + i)
            .rating();

        $('#rating' + i).rating('disable');
    }

    // Ensures no blank fields before contact is submitted
    $('.contactButton').click(function(){
        // Get input and textarea nodes
        var modalParent = $(this).parent().parent();
        var input = modalParent.find('input');
        var textArea = modalParent.find('textarea');

        // Build error msg based on if values are blank
        var errorMsg='';
        if (input.val()==''){
            errorMsg+='No email was inputted.\n';
        }
        if (textArea.val()==''){
            errorMsg+='No message was inputted.\n';
        }

        // If error is blank, we are good
        if(errorMsg==''){
            return true;
        }
        else{
            alert(errorMsg);
            return false;
        }
    });

});


