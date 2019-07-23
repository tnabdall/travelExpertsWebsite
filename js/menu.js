$(document).ready(function () {
    // Purpose is to add active class to respective nav link for css formatting on nav bar
    // Get the current page name
    var fileName = location.href.split("/").slice(-1);
    // Get array of nav bar a link elements
    var links = document.getElementsByClassName("item");
    for (var i = 1; i < links.length; i++) {
        // Check if the page name is same as nav elements href
        // Separate case for opening page that may not have a filename (but opens index)
        try{
            if(fileName[0]==''){
                if(links[i].href.indexOf("index.php")!=-1){
                links[i].className += ' active';
                }
            }
            // General case
            else if (links[i].href.indexOf(fileName[0]) != -1) {
                links[i].className += ' active';
            }
        }
        catch(e){
            console.log(e);
        }
    }
    
    // Sets mobile or desktop nav bar based on window width
    // Also, makes menu sticky to top of view
    var windowWidth = $(window).width();
    if(windowWidth<=752){
        $('#mobileNavBar').css('visibility','visible');
        $('#desktopNavBar').remove();
        // $('#menuButton').sticky();
    }
    else{
        $('#mobileNavBar').remove();
        // $('desktopNavBar').sticky();
    }

    // Sidebar functionality
    $('#menuButton').click(function () {
        $("#sidebar").sidebar('toggle');
        $(body).css("background", "linear-gradient(to right, #636FA4, #E8CBC0);");
    })

    
});