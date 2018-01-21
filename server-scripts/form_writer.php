<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/

$bad_chars = array('$', '%', '?', '<', '>', 'php');

/**
 * To check for method type
 */
function check_post_only()
{
    if (!$_POST) {
        write_error_page("This scripts can only be called from a form.", false);
        exit;
    }
}

/**
 * @param $errors
 * @param $isForm
 */
function write_error_page($errors, $isForm)
{
    write_header();
    if (!empty($errors)) {
        echo "<div id=\"error-block\">";
        echo "<ul>\n";
        foreach ($errors as $field => $msg) {
            echo "<li>";
            echo "<h4>";
            echo $msg;
            echo "</h4>";
            echo "</li>\n";
        }
        echo "</ul>";
        echo "</div>";
    }
    if ($isForm) {
        write_form();
    }
    write_footer();
}

/**
 * Add Header to the html page.
 */
function write_header()
{
    print <<<ENDBLOCK
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../styles/signup-form.css" type="text/css"/>
    <script src="http://jadran.sdsu.edu/jquery/jquery.js"></script>
    <script src="../scripts/form-validation.js"></script>
    <title>SDSU Marathon</title>
</head>
<body>    
ENDBLOCK;
}

function write_footer()
{


    print"<fieldset>
	<legend>Personal Information</legend>
        <form  
        name=\"customer\"
        method=\"post\" 
        action=\"process_request.php\"
		enctype=\"multipart/form-data\">
				
				
			<table>
				<h5> Personal Information</h5>
				
                <tr>
                    <td><label for=\"fname\">First Name<span>*</span></label></td>
                    <td ><input type=\"text\" name=\"fname\" id=\"fname\" size=\"20\"  value=\"$_POST[fname]\"/></td></tr><tr>
					<td><label for=\"mname\">Middle Name</label></td>
                    <td><input type=\"text\" name=\"mname\" id=\"mname\" size=\"20\"  value=\"$_POST[mname]\"/></td></tr><tr>
					
                    <td><label for=\"lname\">Last Name<span>*</span></label></td>
                    <td><input type=\"text\" name=\"lname\" id=\"lname\" size=\"20\" value=\"$_POST[lname]\" /></td>                    
                </tr>
                <tr>		
                    <td><label for=\"address1\">Address<span>*</span></label></td>
                    <td colspan=\"5\"><input type=\"text\" name=\"address1\" id=\"address1\" size=\"50\" value=\"$_POST[address1]\" /></td>
                </tr> 
                <tr>		
                    <td><label for=\"address2\">Address</label></td>
                    <td colspan=\"5\"><input type=\"text\" name=\"address2\" id=\"address2\" size=\"50\" value=\"$_POST[address2]\"/></td>
                </tr>                  
                <tr>		
                    <td><label for=\"city\">City<span>*</span></label></td>
                    <td><input type=\"text\" name=\"city\" id=\"city\" size=\"30\" placeholder=\"San Diego\" value=\"$_POST[city]\"/></td></tr>
                  <tr>  <td><label for=\"state\">State<span>*</span></label></td>
                    <td><input type=\"text\" name=\"state\" id=\"state\" size=\"2\"  maxlength=\"2\" placeholder=\"CA\" value=\"$_POST[state]\"/></td></tr>
                 <tr>   <td><label for=\"zip\">Zipcode<span>*</span></label></td>
                    <td><input type=\"text\" name=\"zip\" id=\"zip\" size=\"5\" maxlength=\"5\" value=\"$_POST[zip]\"/></td>                                        
                </tr>        
				
				
				<tr><td><label>Phone<span>*</span></label></td>
                <td>(<input type=\"text\" name=\"area_phone\" size=\"3\" maxlength=\"3\" value=\"$_POST[area_phone]\"/>)
                <input type=\"text\" name=\"prefix_phone\" size=\"3\" maxlength=\"3\"  value=\"$_POST[prefix_phone]\"/>
                <input type=\"text\" name=\"phone\" size=\"4\" maxlength=\"4\" value=\"$_POST[phone]\"/></td>
							
				</tr>
				<tr>
				<td><label for=\"email\">Email:<span>*</span></label></td>
            <td><input type=\"text\" name=\"email\" size=\"20\" id=\"email\" value=\"$_POST[email]\"/><br /> </td>
				
				</tr>
				
				
				
				</table>
			
				<div>
					Date Of Birth<span>*</span>
					Month <input type=\"text\"  id=\"m\" size=\"2\" name=\"month\"  maxlength=\"2\" value=\"$_POST[month]\"/>
					Day <input type=\"text\"  id=\"d\" size=\"2\" name=\"day\" maxlength=\"2\" value=\"$_POST[day]\"/>
					Year <input type=\"text\" id=\"y\" size=\"4\"  name=\"year\"  maxlength=\"4\" value=\"$_POST[year]\"/> 

					(Hint Example: 04 22 1995)
				</div>
				<table>
				
				
				
				<tr>
				<td> Gender<span>*</span></td>
					<td><label for=\"male\">male</label>
					<input type=\"radio\" name=\"gender\" id=\"male\" value=\"$_POST[gender]\"; 
				

			
				
				PRINT"
        <tr>
				<td>Medicalcondition</td>
			<td><textarea name=\"medicalcondition\" rows=\"3\" cols=\"30\"  value=\"$_POST[medicalcondition]\"></textarea>	<br />	(Hint Example: Sinusitis)</td>

				</tr>
				<tr>
				<td>File:<span>*</span></td>
            <td><input type=\"file\" id=\"file\" name=\"file\" accept=\"image/* value=\"$_FILES[file][name]\"/><br /></td>
			</tr>

            </table>

            <div class=\"buttons\">
            <input type=\"reset\" />
            <input type=\"submit\" value=\"Submit\" />
            </div>
        </form>
	</fieldset>";
    //echo "</body></html>";
}


/**
 * Displaying Form page
 */
function write_form()
{
    print "<div class=\"form-style\">
    <form id=\"account-creation\" method=\"post\" enctype=\"multipart/form-data\"
          action=\"../server-scripts/process_request.php\" name=\"account-creation\"
          autocomplete=\"off\">
        <fieldset>
            <legend>Participant Details</legend>
            <label for=\"firstname\">First Name</label>
            <input type=\"text\" name=\"firstname\" id=\"firstname\" value=\"$_POST[firstname]\" autofocus>

            <label for=\"middlename\">Middle Name</label>
            <input type=\"text\" name=\"middlename\" value=\"$_POST[middlename]\" id=\"middlename\">

            <label for=\"lastname\">Last Name</label>
            <input type=\"text\" name=\"lastname\" id=\"lastname\" value=\"$_POST[lastname]\">

            <label for=\"addressone\">Address 1</label>
            <input type=\"text\" name=\"address1\" id=\"addressone\" value=\"$_POST[address1]\">

            <label for=\"addresstwo\">Address 2</label>
            <input type=\"text\" name=\"address2\" id=\"addresstwo\" value=\"$_POST[address2]\" >

            <label for=\"city\">City</label>
            <input type=\"text\" name=\"city\" id=\"city\" size=\"25\" value=\"$_POST[city]\">

            <label for=\"state\">State</label>
            <input type=\"text\" name=\"state\" id=\"state\" maxlength=\"2\"  value=\"$_POST[state]\">

            <label for=\"zip\">Zip</label>
            <input type=\"text\" pattern=\"[0-9]{5}\" name=\"zip\" id=\"zip\" maxlength=\"5\" placeholder=\"#####\" value=\"$_POST[zip]\">

            <label>Primary Phone</label> (
            <input class=\"telephone\" type=\"tel\" name=\"area_code\" maxlength=\"3\" value=\"$_POST[area_code]\">)
            <input class=\"telephone\" type=\"tel\" name=\"digit_exchange\" maxlength=\"3\" value=\"$_POST[digit_exchange]\"> -
            <input class=\"telephone\" type=\"tel\" name=\"subscriber_no\" maxlength=\"4\" value=\"$_POST[subscriber_no]\">

            <label for=\"email\">Email</label>
            <input type=\"email\" name=\"email\" id=\"email\" size=\"15\" value=\"$_POST[email]\">";

            echo "<label for=\"gender-type\">Gender</label>";
    echo " <fieldset class=\"fieldset-style\" id=\"gender-type\">";
    echo "<input id=\"male\" name=\"gender\" type=\"radio\" value=\"male\"";
    echo((isset($_POST['gender']) && $_POST['gender'] == "male") ? "checked" : "");
    echo ">\n";
    echo "<label for=\"male\">Male</label>";
    echo "<input id=\"female\" name=\"gender\" type=\"radio\" value=\"female\"";
    echo((isset($_POST['gender']) && $_POST['gender'] == "female") ? "checked" : "");
    echo ">\n";
    echo "<label for=\"female\">Female</label>";
    echo "<input id=\"other\" name=\"gender\" type=\"radio\" value=\"other\"";
    echo((isset($_POST['gender']) && $_POST['gender'] == "other") ? "checked" : "");
    echo ">\n";
    echo "<label for=\"other\">Other</label>";
    echo "</fieldset>";

    print "<label for=\"dob\">Date of Birth</label>
            <fieldset class=\"fieldset-style\" id=\"dob\">
                <label for=\"mm\">mm</label>
                <input id=\"mm\" name=\"month\" type=\"text\" maxlength=\"2\" pattern=\"(0[1-9]|1[012])\" value=\"$_POST[month]\">
                <label for=\"dd\">dd</label>
                <input id=\"dd\" name=\"day\" type=\"text\" maxlength=\"2\" pattern=\"(0[1-9]|[12][0-9]|3[01])\" value=\"$_POST[day]\">
                <label for=\"yyyy\">yyyy</label>
                <input id=\"yyyy\" name=\"year\" type=\"text\" maxlength=\"4\" pattern=\"(19|20)\\d\\d\" value=\"$_POST[year]\">
            </fieldset>

            <label for=\"medical-conditions\">Medical Conditions</label>
            <textarea rows=\"4\" name=\"medicalconditions\" id=\"medical-conditions\"
                      placeholder=\"Enter medical conditions, if any\" value=\"$_POST[medicalconditions]\" ></textarea>";

            echo "<label for=\"experience-level\">Experience Level</label>";
            echo "<fieldset id=\"experience-level\" class=\"fieldset-style\">";
            echo "<input id=\"expert\" name=\"experiencelevel\" type=\"radio\" value=\"expert\"";
            echo((isset($_POST['experiencelevel']) && $_POST['experiencelevel'] == "expert") ? "checked" : "");
            echo ">\n";
            echo "<label for=\"expert\">Expert</label>";
            echo "<input id=\"experienced\" name=\"experiencelevel\" type=\"radio\" value=\"experienced\"";
            echo((isset($_POST['experiencelevel']) && $_POST['experiencelevel'] == "experienced") ? "checked" : "");
            echo ">\n";
            echo "<label for=\"experienced\">Experienced</label>";
            echo "<input id=\"novice\" name=\"experiencelevel\" type=\"radio\" value=\"novice\"";
            echo((isset($_POST['experiencelevel']) && $_POST['experiencelevel'] == "novice") ? "checked" : "");
            echo ">\n";
            echo " <label for=\"novice\">Novice</label>";
            echo "</fieldset>";

            echo "<label for=\"category\">Category</label>";
            echo "<fieldset id=\"category\" class=\"fieldset-style\">";
            echo "<input id=\"teen\" name=\"age\" type=\"radio\" value=\"teen\"";
            echo((isset($_POST['age']) && $_POST['age'] == "teen") ? "checked" : "");
            echo ">\n";
            echo "<label for=\"teen\">Teen</label>";
            echo "<input id=\"adult\" name=\"age\" type=\"radio\" value=\"adult\"";
            echo((isset($_POST['age']) && $_POST['age'] == "adult") ? "checked" : "");
            echo ">\n";
            echo "<label for=\"adult\">Adult</label>";
            echo "<input id=\"senior\" name=\"age\" type=\"radio\" value=\"senior\"";
            echo((isset($_POST['age']) && $_POST['age'] == "senior") ? "checked" : "");
            echo ">\n";
            echo "<label for=\"senior\">Senior</label>";
            echo "</fieldset>";
           
            print"<label for=\"user_pic\">Upload Image</label>
            <input type=\"file\" name=\"user_pic\" id=\"user_pic\" accept=\"image/*\" value=\"$_POST[user_pic]\">

        </fieldset>

        <input type=\"reset\" id=\"reset-btn\" value=\"Reset\"/>
        <input id=\"submit-btn\" type=\"submit\" value=\"Register\"/>

    </form>
    <h2 id=\"error_line\">&nbsp;</h2>
</div> ";
}

?>