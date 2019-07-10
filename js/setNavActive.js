$(document).ready(function () {
    // Purpose is to add active class to respective nav link for css formatting on nav bar
    // Get the current page name
    var fileName = location.href.split("/").slice(-1);
    // Get array of nav bar a link elements
    var links = document.getElementsByClassName("nav-link");
    for (var i = 0; i < links.length; i++) {
        // Check if the page name is same as nav elements href
        // Separate case for opening page that may not have a filename (but opens index)
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
});