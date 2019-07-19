$(document).ready(function(){
    // addAccordionEvents();
    if($(window).width()>1000){
        $('#cardCarousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000
        });
    }
    else{
        $('#cardCarousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000
        });
    }
    $('.title').on('click', function(){
        if($(this).attr("class")=='title'){
            $(this).attr("class","active title");
            $(this).next().attr("class","active content");
        }
        else{
            $(this).attr("class","title");
            $(this).next().attr("class","content");
        }
    });
 });


 

// $(document).ready(function () {
//     setTimeout('$("#container").css("opacity", 1)', 1000);
//     // Prevents running this script more than once
//     if($('#descTable').length<1){
//         bodyLoad();
//     }
// })

// var imgArray = ["images/toronto.jpg",
// "images/colloseum.jpg",
// "images/sanFrancisco.jpg",
// "images/tajMahal.jpg",
// "images/japan.jpg"];
// var descArray = ["Toronto, ON, Canada",
// "Colloseum, Rome, Italy",
// "San Francisco, CA, USA",
// "Taj Mahal, Agra, India",
// "Golden Temple, Kyoto, Japan"];
// var urlArray = ["https://www.tripadvisor.ca/Home-g155019",
// "https://www.tripadvisor.ca/Attraction_Review-g187791-d192285-Reviews-Colosseum-Rome_Lazio.html",
// "https://www.tripadvisor.ca/Home-g60713?fid=8db55262-7f28-4147-933a-292323397350",
// "https://www.tripadvisor.ca/Attraction_Review-g297683-d317329-Reviews-Taj_Mahal-Agra_Agra_District_Uttar_Pradesh.html",
// "https://www.tripadvisor.ca/Attraction_Review-g298564-d321400-Reviews-Kinkakuji_Temple-Kyoto_Kyoto_Prefecture_Kinki.html"];



// // Check to see if image exists in file path
// function checkImage(imageSrc, loadedFunc, errorFunc) {
//     var img = new Image();
//     img.onload = loadedFunc; 
//     img.onerror = errorFunc;
//     img.src = imageSrc;
// }


// // Loads all the descriptions
// function populateDescTable() {
//     var section = document.getElementById("travelImageSection");
//     // Create empty table with 2 column formatting and header, give it an id we can reference
//     var table = document.createElement("table");
//     table.id = "descTable";
//     table.className += "col-2"
//     table.innerHTML = "<th class = \"pt-3 pl-1 pr-1\"><h2>Destinations</h2></th>";
//     // Create empty div to hold image, give it an id we can reference
//     var imageDiv = document.createElement("div");
//     imageDiv.id = "imageDiv";
//     imageDiv.className += "ten wide column";
//     // Add both table and div to section holding travel images
//     section.appendChild(table);
//     section.appendChild(imageDiv);
//     // Add random image as default image (so website doesnt look empty on open)
//     var randomInt = Math.floor(Math.random() * imgArray.length);
//     imageDiv.innerHTML = "<img src =" + imgArray[randomInt] + " class=\"col mx-auto index-image pointer-cursor\" onclick=\"openURL(" + randomInt + ")\")>";
//     // Build the table
//     for (i = 0; i < descArray.length; i++) {
//         populateDescTableItem(descArray[i], i);
//     }
// }

// // Loads each description individually and applies appropriate styling
// function populateDescTableItem(description, index) {
//     // Create all elements to populate table
//     var table = document.getElementById("descTable");
//     var trNode = document.createElement("tr");
//     var tdNode = document.createElement("td");
//     var textNode = document.createTextNode(description);
//     var pNode = document.createElement("p");
//     // Format paragraph element
//     pNode.style.padding = "5px";
//     pNode.style.backgroundColor = "#1d3557";
//     // pNode.style.border = "2px solid #1d3557";
//     pNode.style.borderRadius = "10px";
//     pNode.className += "centered";
//     pNode.style.verticalAlign = "middle";
//     pNode.style.fontSize = "20px";
//     pNode.style.fontWeight = "700";

//     // Add mouseover and mouseclick events
//     trNode.addEventListener("mouseover", function () {
//         showImg(index)
//     }, false);
//     trNode.addEventListener("click", function () {
//         openURL(index)
//     }, false);
//     // trNode.addEventListener("mouseout",function(){hideImg()},false);

//     // Style table row
//     // table.className+="four wide column";
//     tdNode.className += "m-xs-2 m-md-3 m-lg-4";
//     trNode.style.textAlign = "center";
//     trNode.className += "justify-center pointer-cursor";
//     trNode.style.verticalAlign = "middle";
//     trNode.style.display = "flex";
//     trNode.style.alignItems = "center";
//     trNode.style.borderTop = "3px solid #F1FAEE";
//     trNode.bgColor = "#1d3557";
//     // Adds desc to text node, text to p, p to cell, cell to row, and row to table
//     pNode.appendChild(textNode);
//     tdNode.append(pNode);
//     trNode.appendChild(tdNode);
//     table.appendChild(trNode);
// }

// // Mouseover event to show description for image
// function showImg(index) {
//     var divNode = document.getElementById("imageDiv");
//     var imgNode = divNode.firstChild;
//     if(imgNode.src.search(imgArray[index])==-1){
//         divNode.innerHTML = "<img src =" + imgArray[index] + " class=\"col mx-auto index-image pointer-cursor\" onclick=\"openURL(" + index + ")\")>";
//     }
// }

// // Mouseout event to delete description
// function hideImg() {
//     // Checks that the p element exists before deleting it
//     document.getElementById("imageDiv").innerHTML = "";
// }

// function openURL(index) {
//     var myWindow = window.open(urlArray[index], "myWindow");
//     // Close after 10 seconds
//     setTimeout(function () {
//         myWindow.close()
//     }, 10000);
// }

