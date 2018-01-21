function isEmpty(fieldValue) {
    return $.trim(fieldValue).length == 0;
}

function isValidState(state) {
    var stateList = ["AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC",
        "DE", "FL", "GA", "GU", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA",
        "MD", "ME", "MH", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ",
        "NM", "NV", "NY", "OH", "OK", "OR", "PA", "PR", "RI", "SC", "SD", "TN", "TX",
        "UT", "VA", "VT", "WA", "WI", "WV", "WY"];
    for (var i = 0; i < stateList.length; i++)
        if (stateList[i] == $.trim(state))
            return true;
    return false;
}

function isValidEmail(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

$(document).ready(function () {

    var errorStatusHandle = $('#error_line');
    var elementHandle = new Array(17);
    elementHandle[0] = $('[name="firstname"]');
    elementHandle[1] = $('[name="lastname"]');
    elementHandle[2] = $('[name="address1"]');
    elementHandle[3] = $('[name="city"]');
    elementHandle[4] = $('[name="state"]');
    elementHandle[5] = $('[name="zip"]');
    elementHandle[6] = $('[name="area_code"]');
    elementHandle[7] = $('[name="digit_exchange"]');
    elementHandle[8] = $('[name="subscriber_no"]');
    elementHandle[9] = $('[name="email"]');
    elementHandle[10] = $('[name="gender"]');
    elementHandle[11] = $('[name="month"]');
    elementHandle[12] = $('[name="day"]');
    elementHandle[13] = $('[name="year"]');
    elementHandle[14] = $('[name="experiencelevel"]');
    elementHandle[15] = $('[name="age"]');
    elementHandle[16] = $('[name="user_pic"]');

    /* Validate all the required inputs*/
    function isValidData() {

        if (isEmpty(elementHandle[0].val())) {
            errorStatusHandle.text("Please enter your first name");
            elementHandle[0].focus();
            return false;
        }
        if (isEmpty(elementHandle[1].val())) {
            errorStatusHandle.text("Please enter your last name");
            elementHandle[1].focus();
            return false;
        }
        if (isEmpty(elementHandle[2].val())) {
            errorStatusHandle.text("Please enter your address");
            elementHandle[2].focus();
            return false;
        }
        if (isEmpty(elementHandle[3].val())) {
            errorStatusHandle.text("Please enter your city");
            elementHandle[3].focus();
            return false;
        }
        if ($.isNumeric(elementHandle[3].val())) {
            errorStatusHandle.text("The city appears to be invalid.");
            elementHandle[3].focus();
            return false;
        }
        if (isEmpty(elementHandle[4].val())) {
            errorStatusHandle.text("Please enter your state");
            elementHandle[4].focus();
            return false;
        }
        if (!isValidState(elementHandle[4].val())) {
            errorStatusHandle.text("The state appears to be invalid, " +
                "please use the two letter state abbreviation");
            elementHandle[4].focus();
            return false;
        }
        if (isEmpty(elementHandle[5].val())) {
            errorStatusHandle.text("Please enter your zip code");
            elementHandle[5].focus();
            return false;
        }
        if (!$.isNumeric(elementHandle[5].val())) {
            errorStatusHandle.text("The zip code appears to be invalid, " +
                "numbers only please. ");
            elementHandle[5].focus();
            return false;
        }
        if (elementHandle[5].val().length != 5) {
            errorStatusHandle.text("The zip code must have exactly five digits");
            elementHandle[5].focus();
            return false;
        }
        if (isEmpty(elementHandle[6].val())) {
            errorStatusHandle.text("Please enter your area code");
            elementHandle[6].focus();
            return false;
        }
        if (!$.isNumeric(elementHandle[6].val())) {
            errorStatusHandle.text("The area code appears to be invalid, " +
                "numbers only please. ");
            elementHandle[6].focus();
            return false;
        }
        if (elementHandle[6].val().length != 3) {
            errorStatusHandle.text("The area code must have exactly three digits");
            elementHandle[6].focus();
            return false;
        }
        if (isEmpty(elementHandle[7].val())) {
            errorStatusHandle.text("Please enter your phone number prefix");
            elementHandle[7].focus();
            return false;
        }
        if (!$.isNumeric(elementHandle[7].val())) {
            errorStatusHandle.text("The phone number prefix appears to be invalid, " +
                "numbers only please. ");
            elementHandle[7].focus();
            return false;
        }
        if (elementHandle[7].val().length != 3) {
            errorStatusHandle.text("The phone number prefix must have exactly three digits");
            elementHandle[7].focus();
            return false;
        }
        if (isEmpty(elementHandle[8].val())) {
            errorStatusHandle.text("Please enter your phone number");
            elementHandle[8].focus();
            return false;
        }
        if (!$.isNumeric(elementHandle[8].val())) {
            errorStatusHandle.text("The phone number appears to be invalid, " +
                "numbers only please. ");
            elementHandle[8].focus();
            return false;
        }
        if (elementHandle[8].val().length != 4) {
            errorStatusHandle.text("The phone number must have exactly four digits");
            elementHandle[8].focus();
            return false;
        }
        if (isEmpty(elementHandle[9].val())) {
            errorStatusHandle.text("Please enter your email address");
            elementHandle[9].focus();
            return false;
        }
        if (!isValidEmail(elementHandle[9].val())) {
            errorStatusHandle.text("The email address appears to be invalid,");
            elementHandle[9].focus();
            return false;
        }
        if (isEmpty(elementHandle[10].val()) || !isValidGender()) {
            errorStatusHandle.text("Please enter your gender");
            elementHandle[10].focus();
            return false;
        }

        if (isEmpty(elementHandle[11].val())) {
            errorStatusHandle.text("Please enter month");
            elementHandle[11].focus();
            return false;
        }
        if (elementHandle[11].val().length != 2) {
            errorStatusHandle.text("The Month value should have exactly two numbers");
            elementHandle[11].focus();
            return false;
        }

        if (!$.isNumeric(elementHandle[11].val())) {
            errorStatusHandle.text("The month appears to be invalid, " +
                "numbers only please. ");
            elementHandle[11].focus();
            return false;
        }
        if (isEmpty(elementHandle[12].val())) {
            errorStatusHandle.text("Please enter day");
            elementHandle[12].focus();
            return false;
        }
        if (!$.isNumeric(elementHandle[12].val())) {
            errorStatusHandle.text("The day appears to be invalid, " +
                "numbers only please. ");
            elementHandle[12].focus();
            return false;
        }
        if (elementHandle[12].val().length != 2) {
            errorStatusHandle.text("The day must have exactly two digits");
            elementHandle[12].focus();
            return false;
        }
        if (isEmpty(elementHandle[13].val())) {
            errorStatusHandle.text("Please enter year");
            elementHandle[13].focus();
            return false;
        }
        if (!$.isNumeric(elementHandle[13].val())) {

            errorStatusHandle.text("The year appears to be invalid, " +
                "numbers only please. ");
            elementHandle[13].focus();
            return false;
        }
        if (elementHandle[13].val().length != 4) {

            errorStatusHandle.text("The year must have exactly four digits");
            elementHandle[13].focus();
            return false;

        }
        if (!validateDate()) {
            return false;
        }

        if (isEmpty(elementHandle[14].val()) || !isValidExperience()) {
            elementHandle[14].focus();
            return false;
        }
        if (isEmpty(elementHandle[15].val()) || !isValidCategory()) {
            elementHandle[15].focus();
            return false;
        }
        if (!isValidImage()) {
            elementHandle[16].focus();
            return false;
        }

        errorStatusHandle.text("");
        return true;
    }

    elementHandle[0].focus();
    /* Handling on submit and on reset interactions.*/

    $(':submit').on('click', function (e) {
        errorStatusHandle.text("");
        e.preventDefault();
        /*AJAX implementation */
        var params = "email="+$('#email').val();
        var url = "../server-scripts/check_dup.php?"+params;
        $.get(url, dup_handler);
    });

    $(':reset').on('click', function () {
        errorStatusHandle.text("");
        elementHandle[0].focus();
    });

    /*AJAX Implementation*/
    function dup_handler(response) {
        if(response == "dup")
            $('#error_line').text("You have already registered. Thank you!!!!");
        else if(response == "OK" && isValidData()) {
            $('form').serialize();
            $('form').submit();
        }
    }

    /////// HANDLERS
    // on blur, if the user has entered valid data, the error message
    // should no longer show.
    elementHandle[0].on('blur', function () {
        if (isEmpty(elementHandle[0].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[1].on('blur', function () {
        if (isEmpty(elementHandle[1].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[2].on('blur', function () {
        if (isEmpty(elementHandle[2].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[3].on('blur', function () {
        if (isEmpty(elementHandle[3].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[4].on('blur', function () {
        if (isEmpty(elementHandle[4].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[5].on('blur', function () {
        if (isEmpty(elementHandle[5].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[6].on('blur', function () {
        if (isEmpty(elementHandle[6].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[7].on('blur', function () {
        if (isEmpty(elementHandle[7].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[8].on('blur', function () {
        if (isEmpty(elementHandle[8].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[9].on('blur', function () {
        if (isEmpty(elementHandle[9].val()))
            return;
        if (isValidEmail(elementHandle[9].val())) {
            errorStatusHandle.text("");
        }
    });
    elementHandle[10].on('blur', function () {
        if (!isValidGender())
            return;
        errorStatusHandle.text("");
    });
    elementHandle[11].on('blur', function () {
        if (isEmpty(elementHandle[11].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[12].on('blur', function () {
        if (isEmpty(elementHandle[12].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[13].on('blur', function () {
        if (isEmpty(elementHandle[13].val()))
            return;
        errorStatusHandle.text("");
    });
    elementHandle[14].on('blur', function () {
        if (!isValidExperience())
            return;
        errorStatusHandle.text("");
    });
    elementHandle[15].on('blur', function () {
        if (!isValidCategory())
            return;
        errorStatusHandle.text("");
    });

    /////////////////////////////////////////////////////////////////

    elementHandle[4].on('keyup', function () {
        elementHandle[4].val(elementHandle[4].val().toUpperCase());
    });
    elementHandle[6].on('keyup', function () {
        if (elementHandle[6].val().length == 3)
            elementHandle[7].focus();
    });
    elementHandle[7].on('keyup', function () {
        if (elementHandle[7].val().length == 3)
            elementHandle[8].focus();
    });
    elementHandle[11].on('keyup', function () {
        if (elementHandle[11].val().length == 2)
            elementHandle[12].focus();
    });
    elementHandle[12].on('keyup', function () {
        if (elementHandle[12].val().length == 2)
            elementHandle[13].focus();
    });

    function isValidImage() {

        var files = $('input[name="user_pic"]')[0].files;

        if (files.length == 0 || files[0].size == 0) {

            errorStatusHandle.text("Please upload your image");
            return false;

        } else {

            if (files[0].size / 1000 > 1000) {

                errorStatusHandle.text("File size should be less than 1 MB ");
                return false;
            }
            errorStatusHandle.text("");
            return true;
        }
    }

    $('#user_pic').on('change', function () {
        if (isValidImage()) {
            errorStatusHandle.text("");
        }
    });

    function isValidCategory() {

        var choice = $('input[name="age"]');
        var selected;
        $.each(choice, function (k, v) {
            if (this.checked) selected = v.value;
        });
        if (selected) {
            return true;
        } else {
            errorStatusHandle.text("Please enter your category");
            elementHandle[15].focus();
            return false;
        }
    }

    function isValidGender() {

        var choice = $('input[name="gender"]');
        var selected;
        $.each(choice, function (k, v) {
            if (this.checked) selected = v.value;
        });
        if (selected) {
            return true;
        } else {
            errorStatusHandle.text("Please enter your gender");
            elementHandle[10].focus();
            return false;
        }
    }

    function validateDate() {

        var day = document.getElementById("dd").value;
        var month = document.getElementById("mm").value;
        var year = document.getElementById("yyyy").value;

        // now turn the three values into a Date object and check them
        var checkDate = new Date(year, month - 1, day);
        var checkDay = checkDate.getDate();
        var checkMonth = checkDate.getMonth() + 1;
        var checkYear = checkDate.getFullYear();

        if (day != checkDay ||
            month != checkMonth ||
            year != checkYear) {
            errorStatusHandle.text("Please enter a valid date ");
            return false;
        }
        return true;
    }

    function isValidExperience() {

        var choice = $('input[name="experiencelevel"]');
        var selected;
        $.each(choice, function (k, v) {
            if (this.checked) selected = v.value;
        });
        if (selected) {
            return true;
        } else {
            errorStatusHandle.text("Please indicate your Experience Level");
            elementHandle[14].focus();
            return false;
        }
    }
});