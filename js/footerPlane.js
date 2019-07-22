$(document).ready(function () {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    // Prevents running this script more than once
    
    var plane = document.getElementById("planeImg");

    // Plane object so that the click event can change the speed that the plane is rendered at
    var planeObj={node:plane, speed:500};
    plane.addEventListener("mouseover",function(){hoverPlane(planeObj)});
    animatePlane(planeObj,0,0);
})

// Defines arrays that specifies plane height and angle of rotation in certain sections of flight path
var heightArray=[1.01, 1.05, 1.09, 1.13, 1.18, 1.23, 1.27, 1.32, 1.38, 1.43, 1.49, 1.55, 1.61, 1.67, 1.74, 1.81, 1.88, 1.95, 2.03, 2.11, 2.19, 2.28, 2.37, 2.46, 2.56, 2.66, 2.76, 2.87, 2.98, 3.09, 3.21, 3.33, 3.46, 3.59, 3.73, 3.87, 4.02, 4.17, 4.33, 4.49, 4.66, 4.83, 5.01, 5.2, 5.39, 5.59, 5.79, 6, 6.22, 6.44, 6.68, 6.91, 7.16, 7.41, 7.67, 7.94, 8.22, 8.5, 8.8, 9.1, 9.41, 9.72, 10.05, 10.38, 10.73, 11.08, 11.44, 11.81, 12.18, 12.57, 12.96, 13.37, 13.78, 14.2, 14.62, 15.06, 15.51, 15.96, 16.42, 16.89, 17.36, 17.84, 18.33, 18.83, 19.33, 19.84, 20.36, 20.88, 21.41, 21.94, 22.47, 23.01, 23.56, 24.11, 24.66, 25.21, 25.76, 26.32, 26.88, 27.44, 28, 28.56, 29.12, 29.68, 30.24, 30.79, 31.34, 31.89, 32.44, 32.99, 33.53, 34.06, 34.59, 35.12, 35.64, 36.16, 36.67, 37.17, 37.67, 38.16, 38.64, 39.11, 39.58, 40.04, 40.49, 40.94, 41.38, 41.8, 42.22, 42.63, 43.04, 43.43, 43.82, 44.19, 44.56, 44.92, 45.27, 45.62, 45.95, 46.28, 46.59, 46.9, 47.2, 47.5, 47.78, 48.06, 48.33, 48.59, 48.84, 49.09, 49.32, 49.56, 49.78, 50, 50.21, 50.41, 50.61, 50.8, 50.99, 51.17, 51.34, 51.51, 51.67, 51.83, 51.98, 52.13, 52.27, 52.41, 52.54, 52.67, 52.79, 52.91, 53.02, 53.13, 53.24, 53.34, 53.44, 53.54, 53.63, 53.72, 53.81, 53.89, 53.97, 54.05, 54.12, 54.19, 54.26, 54.33, 54.39, 54.45, 54.51, 54.57, 54.62, 54.68, 54.73, 54.77, 54.82, 54.87, 54.91, 54.95, 54.99 ];
var degreeArray=[0, -7.69, -7.96, -8.24, -8.52, -8.82, -9.12, -9.42, -9.73, -10.05, -10.38, -10.7, -11.04, -11.38, -11.72, -12.07, -12.43, -12.78, -13.14, -13.5, -13.86, -14.23, -14.59, -14.96, -15.32, -15.69, -16.05, -16.41, -16.77, -17.13, -17.48, -17.83, -18.17, -18.51, -18.85, -19.18, -19.5, -19.82, -20.13, -20.43, -20.73, -21.02, -21.31, -21.59, -21.86, -22.12, -22.38, -22.62, -22.87, -23.1, -23.33, -23.55, -23.76, -23.97, -24.17, -24.36, -24.54, -24.72, -24.9, -25.06, -25.22, -25.38, -25.53, -25.67, -25.8, -25.94, -26.06, -26.18, -26.3, -26.41, -26.52, -26.62, -26.72, -26.81, -26.9, -26.98, -27.06, -27.14, -27.21, -27.28, -27.34, -27.4, -27.46, -27.52, -27.57, -27.61, -27.66, -27.7, -27.74, -27.77, -27.8, -27.83, -27.86, -27.88, -27.9, -27.91, -27.93, -27.94, -27.95, -27.95, -27.96, -27.96, -27.95, -27.95, -27.94, -27.93, -27.91, -27.9, -27.88, -27.86, -27.83, -27.8, -27.77, -27.74, -27.7, -27.66, -27.61, -27.57, -27.52, -27.46, -27.4, -27.34, -27.28, -27.21, -27.14, -27.06, -26.98, -26.9, -26.81, -26.72, -26.62, -26.52, -26.41, -26.3, -26.18, -26.06, -25.94, -25.8, -25.67, -25.53, -25.38, -25.22, -25.06, -24.9, -24.72, -24.54, -24.36, -24.17, -23.97, -23.76, -23.55, -23.33, -23.1, -22.87, -22.62, -22.38, -22.12, -21.86, -21.59, -21.31, -21.02, -20.73, -20.43, -20.13, -19.82, -19.5, -19.18, -18.85, -18.51, -18.17, -17.83, -17.48, -17.13, -16.77, -16.41, -16.05, -15.69, -15.32, -14.96, -14.59, -14.23, -13.86, -13.5, -13.14, -12.78, -12.43, -12.07, -11.72, -11.38, -11.04, -10.7, -10.38, -10.05, -9.73, -9.42, -9.12, -8.82, -8.52, -8.24, -7.96, -7.69];

// Changes plane type and speed
function hoverPlane(planeObj){
    var plane = planeObj.node;
    if(plane.className.match("space shuttle icon")){
        plane.className="plane icon";
        planeObj.speed = 50;
    }
    else if(plane.className.match("plane icon")){
        plane.className="fighter jet icon";
        planeObj.speed = 100;
    }
    else{
        plane.className="space shuttle icon";
        planeObj.speed = 500;
    }
}

// Recursive function to animate plane
function animatePlane(planeObj,percent,prevHeight){
    var plane = planeObj.node;
    var xDelta = 0.1; // Interval of horizontal width percentage movement. If you change this, you must recalculate the other arrays.
    percent+=xDelta;

    var height;
    var degree;

    // Determines height based on planes x position (percentage horizontal width)
    if(percent<15){
        height = 0;
    }
    else if (percent<35){
        height = heightArray[parseInt((percent-15)/xDelta)];
    }
    else if (percent<65){
        height = prevHeight;
    }
    else if (percent<85){
        height = heightArray[heightArray.length-parseInt((percent-65)/xDelta)];
    }
    else{
        height=0;
    }

    if(percent>100){
        percent=0;
    }

    // Determines angle of rotation based on planes position (percentage horizontal width)
    if(percent<15 || percent>85){
        degree=0;
    }
    else if(percent<35){
        degree = degreeArray[parseInt((percent-15)/xDelta)];
    }
    else if (percent<65){
        degree = 0;
    }
    else{
        degree = (-1)* degreeArray[degreeArray.length-parseInt((percent-65)/xDelta)];
    }

    // Sets plane position and rotation
    plane.style.left = ""+percent+"%";
    plane.style.bottom=""+height+"px";
    plane.style.transform = "rotate("+degree+'deg)';


    setTimeout(function(){animatePlane(planeObj,percent,height)},parseInt(xDelta/planeObj.speed*10000));
}