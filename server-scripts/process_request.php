<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/

include('form_writer.php');
include('database.php');
include('formvalidator.php');
include('validationrule.php');


$states = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC",
    "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA",
    "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE",
    "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR", "PA", "RI", "SC",
    "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");

$months = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
$days = array(
    '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12',
    '13', '14', '15', '16', '17', '18', '19', '20', '21', '22',
    '23', '24', '25', '26', '27', '28', '29', '30', '31'
);
$daysRange = array('1', '31');
$monthsRange = array('1', '12');

//check_post_only();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Instantiate the validator object
    $validator = new FormValidator();

    /*
     * Add validation rules (fieldname, error msg, rule type, criteria)
     * A field can have multiple rules and will validate them in the order they
     * are provided
     */
    $validator->addRule('firstname', 'First Name is a required field', 'required');
    $validator->addRule('lastname', 'Last Name is a required field', 'required');
    $validator->addRule('address1', 'Address is a required field', 'required');
    $validator->addRule('city', 'City is a required field', 'required');
    $validator->addRule('state', 'State is a required field', 'required');
    $validator->addRule('state', 'Please enter a valid state', 'in-array', $states);
    $validator->addRule('zip', 'Zip code is a required field', 'required');
    $validator->addRule('zip', 'Please enter a valid zip code', 'zip');
    $validator->addRule('area_code', 'Area code is required', 'required');
    $validator->addRule('area_code', 'Please enter valid Area code', 'numeric');
    $validator->addRule('area_code', 'Please enter valid Area code', 'minlength', 3);
    $validator->addRule('digit_exchange', 'Digit Exchange field is required', 'required');
    $validator->addRule('digit_exchange', 'Please enter valid Digit Exchange', 'numeric');
    $validator->addRule('digit_exchange', 'Please enter valid Digit Exchange', 'minlength', 3);
    $validator->addRule('subscriber_no', 'Subscriber Number is required', 'required');
    $validator->addRule('subscriber_no', 'Please enter valid Subscriber Number', 'numeric');
    $validator->addRule('subscriber_no', 'Please enter valid Subscriber Number', 'minlength', 4);
    $validator->addRule('email', 'Email ID is a required field', 'required');
    $validator->addRule('email', 'Email ID entered is not valid', 'email');
    $validator->addRule('gender', 'Gender is a required field', 'required');
    $validator->addRule('month', 'Month is a required field', 'required');
    $validator->addRule('month', 'Month is a not valid', 'numeric-range', $monthsRange);
    $validator->addRule('day', 'Day is a required field', 'required');
    $validator->addRule('day', 'Day is a not valid', 'numeric-range', $daysRange);
    $validator->addRule('year', 'Year is a required field', 'required');
    $validator->addRule('year', 'Year is a not valid', 'callback', 'is_valid_year');
    $validator->addRule('medicalconditions', '', '');
    $validator->addRule('experiencelevel', 'Experience Level is a required field', 'required');
    $validator->addRule('age', 'Category is a required field', 'required');
    /*$validator->addRule('user_pic', '', 'callback', 'is_file_uploaded');*/


    function is_valid_year($validator)
    {
        if ($validator->numberBetween($_POST['year'], array(1900, 2017))) {
            return true;
        }
        return false;
    }

    function validate_image($validator)
    {
        $fname = $_FILES["user_pic"]["name"];
        $target_dir = "/home/jadrn033/public_html/proj3/imageUploads/";
        $target_file = $target_dir . basename($fname);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (empty($fname)) {
            $validator->appendErrors("Runner Image is a required field");
            return false;
        }
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {

            $check = getimagesize($_FILES["user_pic"]["tmp_name"]);
            if ($check !== false) {
                $validator->appendErrors("File is an image - " . $check["mime"] . ".");
                return false;
            } else {
                $validator->appendErrors("File is not an image.");
                return false;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $validator->appendErrors("Sorry, file already exists.");
            return false;
        }
        // Check file size
        if ($_FILES["user_pic"]["size"] > 1000000) {

            $validator->appendErrors("Sorry, uploaded File is too large.");
            return false;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $validator->appendErrors("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            return false;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == -1) {
            return false;
        }
        return true;
    }


    function upload_image()
    {
        $fname = $_FILES["user_pic"]["name"];
        $target_dir = "/home/jadrn033/public_html/proj3/imageUploads/";
        $target_file = $target_dir . basename($fname);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $res = move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target_file);

        if(!$res){
            echo"Sorry, there was an error while uploading the file!!!";
        }
        return $res;
    }

    /*Input the POST data and check it*/
    $validator->addEntries($_POST);
    $validator->validate();
    validate_image($validator);
    // Retrieve an associative array of "sanitized" form inputs (HTML tags stripped, etc.)
    $params = $validator->getEntries();
    /*
     * Conditional logic can be used based on whether errors were found
     * e.g. redirecting to a different page on success
     */
    if ($validator->foundErrors()) {
        $errors = $validator->getErrors();
        write_error_page($errors, true);

    } else {

        $res = store_data_in_database($params);
        if($res){
            $res = upload_image();
            if($res)
            include('registration_confirmation.php');
        } else {
            echo "Sorry, Data was not uploaded to the browser";
        }


    }
}
?>