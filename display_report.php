<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/

$passwordInput = $_POST['password'];
$valid = false;
$raw = file_get_contents('passwords.dat');
$data = explode("\n", $raw);
foreach ($data as $item) {
    if (crypt($passwordInput, $item) === $item)
        $valid = true;
}  #end foreach
if ($valid)
    display_report();
else
    display_invalid();


/**
 * To display report if the user is valid.
 */
function display_report()
{
    echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <title>Runners Report</title>
    <link rel=\"stylesheet\" href=\"styles/report.css\">
</head>
<body>
    <h1>Aztec Marathon - Runners Report</h1>";

    $server = 'opatija.sdsu.edu:3306';
    $user = 'jadrn033';
    $password = 'tile';
    $database = 'jadrn033';
    if (!($db = mysqli_connect($server, $user, $password, $database))){

        echo "ERROR in connection " . mysqli_error($db);
    }  else {

        $sql = "select lastname, firstname, age, experiencelevel, email, TIMESTAMPDIFF(YEAR, dateofbirth, CURDATE()),userpic from runner
                                                  ORDER BY age DESC ;";
        $result = mysqli_query($db, $sql);

        if (!$result){
            echo "ERROR in query" . mysqli_error($db);
        }

        echo "<table>";
        echo "<tr><td>Last Name</td><td>First Name</td><td>Category</td><td>Experience Level</td><td>Email</td><td>Age</td><td>Runner Image</td></tr>";
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";

            $columnValuesToDisplay = array_slice($row, 0);
            $fileName = end($columnValuesToDisplay);

            foreach ($columnValuesToDisplay as $item)

                // check if the item is Filename, then display it in the report.
                if($item == $fileName){
                    $photoSourcePath = "imageUploads/".$item;
                    echo"<td align=\"center\"><img src=\"$photoSourcePath\" width='75'></td>";
                }
                else{
                    echo "<td>$item</td>";
                }
            echo "</tr>\n";
        }
        mysqli_close($db);
    }
    echo "</table>";
    echo "</body></html>";
}

/**
 * Function to display Unauthorized/ Invalid user access.
 */
function display_invalid()
{
    echo "<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\" />
    <style type=\"text/css\">
        h1, h2 { text-align: center; }
        input { margin: 5px; }
        #message_line { color: red; }
    </style>
</head>
<body>
    <div>
    <form method=\"post\" action=\"display_report.php\" name=\"login\">
        <h3>Sign in</h3>
        <p>
            Password: <input type=\"password\" name=\"password\" placeholder=\"Enter password\"/><br />
        </p>
        <p>
            <input type=\"reset\" value=\"Clear\" />
            <input type=\"submit\" value=\"Log In\" />
        </p>";
        echo "<h3 id=\"message_line\">Unauthorized Access. Please enter a valid password</h3>";
    echo"</form></div></body></html>";
}