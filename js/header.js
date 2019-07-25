var initialLineHeight;

$(document).ready(function(){
    if($(window).width()>752){
        $('header').css("position","sticky");
        $('header').css("top",0);
        $('header').css("z-index",1);
        window.onscroll=function(){scrollFunction()};
    }
    initialLineHeight=$("#headerRow").css("line-height").substr(0,5);
});

function scrollFunction(){
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("headerRow").style.height = "100px";
        $("#headerRow").css("line-height",initialLineHeight/2.2+"px");
      } else {
        document.getElementById("headerRow").style.height = "200px";
        $("#headerRow").css("line-height",initialLineHeight+"px");
      }
}