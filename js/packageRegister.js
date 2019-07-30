// Authors: Nicolas Tambellini
// Date: July 31,2019
// Version: 2.5
// Functionality: Form validation for package register page

$(document).ready(function () {
    setTimeout('$("#container").css("opacity", 1)', 1000);
    // Sets up form validation
    setFormValidation();
})

// On submit function
function submitClick() {
    if (confirm("Would you like to submit?")) {
        // Ensures image is selected for upload
        var image_name = $('#Image').val();
        if (image_name == '') {
            alert("Please select Image");
            return false;
        } else {
            // Ensures selected image has valid extension
            var extension = $("#Image").val().split(".").pop().toLowerCase();
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

// Semantic UI form validation
function setFormValidation() {
    // Added rule so that start date must be before end date when adding package
    $.fn.form.settings.rules.startBeforeEnd = function (value, startBeforeEnd) {
        var startDate = new Date($("#PkgStartDate").val());
        var endDate = new Date($("#PkgEndDate").val());
        return startDate.getTime() < endDate.getTime();
    };

    $('#vacationForm')
        .form({
            on: 'blur',
            inline: true,
            fields: {
                PkgName: {
                    identifier: 'PkgName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter the package name.',
                    }]
                },
                Partner: {
                    identifier: 'Partner',
                    rules: [{
                        type: 'url',
                        prompt: 'Please enter the partner url.',
                    }]
                },
                PkgDesc: {
                    identifier: 'PkgDesc',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter a description for this package.',
                    }]
                },
                PkgStartDate: {
                    identifier: 'PkgStartDate',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please choose a start date for this package.',
                        },
                        {
                            type: 'startBeforeEnd[0]',
                            prompt: 'Please ensure your package start date is before your end date.'
                        }
                    ]
                },
                PkgEndDate: {
                    identifier: 'PkgEndDate',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please choose an end date for this package.',
                        },
                        {
                            type: 'startBeforeEnd[0]',
                            prompt: 'Please ensure your package start date is before your end date.'
                        }
                    ]
                },
                PkgBasePrice: {
                    identifier: 'PkgBasePrice',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter a price for this package.',
                        },
                        {
                            type: 'number',
                            prompt: 'Please enter a price for this package (no symbols except period).',
                        }
                    ]
                },
                PkgDesc: {
                    identifier: 'PkgDesc',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter a description for this package.',
                    }]
                }
            }
        });
}