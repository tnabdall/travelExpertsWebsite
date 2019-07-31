// Authors: Tarik Abdalla
// Date: July 31,2019
// Version: 2.5
// Functionality: Sticky shrinking header

var initialLineHeight;

$(document).ready(function () {
  // Sets sticky header on laptop/desktop mode. On mobile, just make sidebar menu sticky.
  if ($(window).width() > 752) {
    $('header').css("position", "sticky");
    $('header').css("top", 0);
    $('header').css("z-index", 1);
    window.onscroll = function () {
      scrollFunction()
    };
  } else {
    $('#menuButton').sticky();
  }
  // Initializes line height in px based on style.css value
  initialLineHeight = $("#headerRow").css("line-height").substr(0, 5);
});

// Shrinks/expands header based on scroll position
function scrollFunction() {
  if (document.documentElement.scrollTop > 100) {
    document.getElementById("headerRow").style.height = "100px";
    $("#headerRow").css("line-height", initialLineHeight / 2.2 + "px");
  } else if ((document.documentElement.scrollTop < 1)) {
    document.getElementById("headerRow").style.height = "200px";
    $("#headerRow").css("line-height", initialLineHeight + "px");
  }
}