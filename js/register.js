$(document).ready(function () {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    $('.ui.form')
    .form({
        on: 'blur',
        inline: true,
        fields: {
            // empty: {
            //     identifier: 'empty',
            //     rules: [{
            //         type: 'empty',
            //         prompt: 'Please enter a value'
            //     }]
            // },
            firstName: {
                identifier: 'firstName',
                rules: [{
                    type: 'regexp',
                    prompt: 'Type Tim',
                    value: /Tim/i
                }]
            }
            // field2: {
            //     rules: [{
            //         type: 'exactly[dog]',
            //         prompt: '{name} is set to "{value}" that is totally wrong. It should be {ruleValue}'
            //     }]
            // },
            // field3: {
            //     rules: [{
            //         type: 'exactly[cat]',
            //         prompt: function (value) {
            //             if (value == 'dog') {
            //                 return 'I told you to put cat, not dog!';
            //             }
            //             return 'That is not cat';
            //         }
            //     }]
            // },
        }
    });
})



function validate() {
    errorInfo = "";
    if (document.getElementById("firstName").value == "") {
        errorInfo += "You have not entered a first name.\n"
    }
    if (document.getElementById("lastName").value == "") {
        errorInfo += "You have not entered a last name.\n"
    }
    if (document.getElementById("streetAddress").value == "") {
        errorInfo += "You have not entered a street address.\n"
    }
    if (document.getElementById("city").value == "") {
        errorInfo += "You have not entered a city.\n"
    }
    if (document.getElementById("postalCode").value == "") {
        errorInfo += "You have not entered a postal code.\n"
    } else if (!document.getElementById("postalCode").value.toUpperCase().match(/^[A-Z]\d[A-Z] ?\d[A-Z]\d$/)) {
        errorInfo += "You have entered an invalid postal code.\n"
    }
    if (document.getElementById("email").value == "") {
        errorInfo += "You have not entered an email address.\n"
    }
    if (document.getElementById("pWord").value == "") {
        errorInfo += "You have not entered a password.\n"
    }
    if (errorInfo == "") {
        return true;
    } else {
        alert(errorInfo);
        return false;
    }
}

function submitClick() {
    var submissionIntent = confirm("Are you sure you would like to submit?");
    if (submissionIntent == true) {
        return validate();
    } else {
        return false;
    }
}

function resetClick() {
    var resetIntent = confirm("Are you sure you would like to clear all?")
    return resetIntent;
}

function focusFunc(textId) {
    // Get the element of calling ID
    el = document.getElementById(textId);
    // Get the parent
    parentDiv = el.parentNode;
    // Create a p node to hold help text
    var pNode = document.createElement("p");
    var helpText = "";
    // Adds text depending on calling ID
    switch (textId) {
        case "firstName":
            helpText = "Please enter your first name.";
            break;
        case "middleName":
            helpText = "Please enter your middle name.";
            break;
        case "lastName":
            helpText = "Please enter your last name.";
            break;
        case "streetAddress":
            helpText = "Please enter street address including apt numbers, house number, and street name.";
            break;
        case "city":
            helpText = "Please enter your city.";
            break;
        case "postalCode":
            helpText = "Please enter your postal code in a valid format (with or without space).";
            break;
        case "email":
            helpText = "Please enter a valid email address.";
            break;
        case "pWord":
            helpText = "Please enter a strong password.";
            break;
        case "preferredDestinations":
            helpText = "Please enter your most desired destinations.";
            break;
        case "additionalInfo":
            helpText = "Please enter any additional information or concerns you would like us to know about.";
            break;
    }


    var textElement = document.createTextNode(helpText);
    // Adds text to p node and styles it
    pNode.appendChild(textElement);
    pNode.className += "col";
    // pNode.style.color = "#1D3557";
    pNode.style.fontSize = "12px";
    // Creates a div to hold the p node and center it
    var container = document.createElement("div");
    container.className += "container-fluid row centered";
    container.appendChild(pNode);
    container.id = "helpPar";
    // Adds div with id helpPar to parentDiv (appears under element)
    parentDiv.appendChild(container);
}

// Deletes element with id helpPar created by focusFunc()
function blurFunc() {
    el = document.getElementById("helpPar");
    parentDiv = el.parentNode;
    parentDiv.removeChild(el);
}