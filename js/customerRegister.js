// Authors: Nicolas Tambellini
// Date: July 31,2019
// Version: 2.5
// Functionality: Form validation for customer register page

$(document).ready(function () {
    setTimeout('$("#container").css("opacity", 1)', 1000);

    var postalRegex = 'regExp[/^[A-Za-z]\\d[A-Za-z] ?\\d[A-Za-z]\\d$/]';
    // Sets up form validation with canadian postal code regex
    setFormValidation(postalRegex);
    $('#states').hide();
    $('#provinces').hide();
    $('#CustCountry').click(function () {
        // Shows states or provinces depending on country selection
        if ($(this).children("option:selected").val() == "Canada") {
            postalRegex = 'regExp[/^[A-Za-z]\\d[A-Za-z] ?\\d[A-Za-z]\\d$/]';
            $('#states').hide();
            $('#provinces').show();
            $('#blankSelectProvince').html("Province");
            $('#CustProvince').val("");
        } else if ($(this).children("option:selected").val() == "USA") {
            postalRegex = 'regExp[/^\\d{5}$/]';
            $('#provinces').hide();
            $('#states').show();
            $('#blankSelectProvince').html("State");
            $('#CustProvince').val("");
        }
        // Resets form validation with new country postal or zip code regex
        setFormValidation(postalRegex);
    });
})

// Semantic UI Form Validation
function setFormValidation(postalRegex) {
    $('.ui.form')
        .form({
            on: 'blur',
            inline: true,
            fields: {
                CustFirstName: {
                    identifier: 'CustFirstName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your first name.',
                    }]
                },
                CustLastName: {
                    identifier: 'CustLastName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your last name.',
                    }]
                },
                CustAddress: {
                    identifier: 'CustAddress',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your street address.',
                    }]
                },
                CustCity: {
                    identifier: 'CustCity',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your city.',
                    }]
                },
                CustPostal: {
                    identifier: 'CustPostal',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your postal/zip code.',
                        },
                        {
                            type: postalRegex,
                            prompt: 'Please enter a proper postal (T1A 1A1) or \nzip code (90210) format.'
                        }
                    ]
                },
                CustCountry: {
                    identifier: 'CustCountry',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please choose your country.',
                    }]
                },
                CustEmail: {
                    identifier: 'CustEmail',
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
                CustProv: {
                    identifier: 'CustProv',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please choose your province/state.',
                    }]
                },
                CustHomePhone: {
                    identifier: 'CustHomePhone',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your home phone number.',
                        },
                        {
                            type: 'regExp[/^\\d{10}$/]',
                            prompt: 'Please enter your phone number as 10 digits (no spaces or special characters) '
                        }
                    ]
                },
                CustBusinessPhone: {
                    identifier: 'CustBusPhone',
                    rules: [{
                        type: 'regExp[/(^$|^\\d{10}$)/]',
                        prompt: 'Please enter your phone number as 10 digits (no spaces or special characters) '
                    }]
                }
            }
        });
}

// On click reset confirm
function resetClick() {
    var resetIntent = confirm("Are you sure you would like to clear all?")
    return resetIntent;
}