<!DOCTYPE html>
<html>

<!--
     Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017
-->


<head>
    <meta http-equiv="Content-Type" content="text/html;
    charset=iso-8859-1" />
    <title>Registration Confirmation</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
</head>


<body>
<?php
$fileName = $_FILES['user_pic']['name'];
echo <<<ENDBLOCK
    <h1>Thank you for registering. Please find your details below.</h1>
    <table>
        <tr>
            <td>First Name</td>
            <td>$params[0]</td>
        </tr>
        <tr>
            <td>Middle Name</td>
            <td>$params[1]</td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>$params[2]</td>
        </tr>
        <tr>
            <td>Address One</td>
            <td>$params[3]</td>
        </tr>
        <tr>
            <td>Address two</td>
            <td>$params[4]</td>
        </tr>  
         <tr>
            <td>City</td>
            <td>$params[5]</td>
        </tr>
        <tr>
            <td>State</td>
            <td>$params[6]</td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td>$params[7]</td>
        </tr>
        <tr>
            <td>Primary Phone</td>
            <td>$params[8]-$params[9]-$params[10]</td>
        </tr>
        <tr>
            <td>email</td>
            <td>$params[11]</td>
        </tr>   
         <tr>
            <td>Gender</td>
            <td>$params[12]</td>
        </tr>
        <tr>
            <td>Date Of Birth</td>
            <td>$params[13]-$params[14]-$params[15]</td>
        </tr>
        <tr>
            <td>Medical Conditions</td>
            <td>$params[16]</td>
        </tr>
        <tr>
            <td>Experience Level</td>
            <td>$params[17]</td>
        </tr>
        <tr>
            <td>Category</td>
            <td>$params[18]</td>
        </tr>
        <tr>
            <td>Image Name</td>
            <td>$fileName</td>
        </tr>            
    </table>                          
ENDBLOCK;

?>
</body></html>