// Authors: Nicolas Tambellini
// Date: July 31,2019
// Version: 2.5
// Functionality: Form validation for add agent


$(document).ready(function () {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    // Sets up form validation
    setFormValidation();
})

// Semantic UI parameters for form validation
function setFormValidation() {
    $('#agentForm')
        .form({
            on: 'blur',
            inline: true,
            fields: {
                firstName: {
                    identifier: 'firstName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your first name.',
                    }]
                },
                middleName: {
                    identifier: 'middleName',
                    rules: [{
                        type: 'regExp[/(^$|^[A-Za-z]{1}\\.?$)/]',
                        prompt: 'Please enter a 1 letter initial.',
                    }]
                },
                lastName: {
                    identifier: 'lastName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your last name.',
                    }]
                },
                phone: {
                    identifier: 'phone',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your phone number.',
                        },
                        {
                            type: 'regExp[/^\\(\\d{3}\\) \\d{3}[\\-]\\d{4}$/]',
                            prompt: 'Please enter the phone number in the correct format eg. (403) 200-0000.',

                        },

                    ]
                },
                email: {
                    identifier: 'email',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your email address.',
                        },
                        {
                            type: 'email',
                            prompt: 'Please enter a proper email eg. john@gmail.com'
                        }

                    ]
                },
                agencyId: {
                    identifier: 'agencyId',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please choose your agency.',
                    }]
                },
                position: {
                    identifier: 'position',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please choose your position.',
                    }]
                },
                Username: {
                    identifier: 'Username',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your username.',
                    }]
                },
                Password: {
                    identifier: 'Password',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your password.',
                    }]
                },
                Title: {
                    identifier: 'Title',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter an epithet to describe the new agent.',
                    }]
                },
                Description: {
                    identifier: 'Description',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter a quote from the agent.',
                    }]
                },
                AgtMessage: {
                    identifier: 'AgtMessage',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter an auto-reply message for when this agent is unavailable.',
                    }]
                },
            }
        });
}

// onclick function for submit
function submitClick() {
    if (confirm("Would you like to submit?")) {
        // check to see if image file to be uploaded was selected
        var image_name = $('#Image').val();
        if (image_name == '') {
            alert("Please select Image");
            return false;
        } else {
            var extension = $("#Image").val().split(".").pop().toLowerCase();
            // Check to see if its a valid extension
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid image file extension");
                $('#Image').val('');
                return false;
            }
        }
        return true;
    } else {
        return false;
    }
}