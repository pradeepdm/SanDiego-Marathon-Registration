<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/


function get_db_handle()
{
    ########################################################
    # DO NOT USE jadrn000, DO NOT MODIFY jadnr000 DATABASE!
    ########################################################
    $server = 'opatija.sdsu.edu:3306';
    $user = 'jadrn033';
    $password = 'tile';
    $database = 'jadrn033';
    ########################################################

    if (!($db = mysqli_connect($server, $user, $password, $database))) {
        write_error_page('SQL ERROR: Connection failed: ' . mysqli_error($db), true);
    }
    return $db;
}

function close_connector($db)
{
    mysqli_close($db);
}

function store_data_in_database($params)
{

    # get a database connection
    $db = get_db_handle();  ## method in form_writer.php
    $date = $params[13] . '-' . $params[14] . '-' . $params[15];
    $phone = $params[8] . $params[9] . $params[10];
    $fileName = $_FILES['user_pic']['name'];

    ##############################################################
    $sql = "SELECT * FROM runner WHERE " .
        "firstname='$params[0]' AND " .
        "middlename ='$params[1]' AND " .
        "lastname = '$params[2]' AND " .
        "address1 = '$params[3]' AND " .
        "address2 = '$params[4]' AND " .
        "city = '$params[5]' AND " .
        "state = '$params[6]' AND " .
        "zip = '$params[7]' AND " .
        "phone = '$phone' AND " .
        "email = '$params[11]' AND " .
        "gender = '$params[12]' AND " .
        "dateofbirth = '$date' AND " .
        "medicalconditions = '$params[16]' AND " .
        "experiencelevel = '$params[17]' AND " .
        "age = '$params[18]' AND " .
        "userpic = '$fileName'";

    ##echo "The SQL statement is ",$sql;
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        write_error_page('This record appears to be a duplicate');
        exit;
    }
##OK, duplicate check passed, now insert
    $sql = "INSERT INTO runner(
id, firstname, middlename, lastname, address1, address2, city, state, zip,  
phone, email, gender, dateofbirth, medicalconditions, experiencelevel, age, userpic
)" . "VALUES(0,'$params[0]','$params[1]','$params[2]','$params[3]','$params[4]',
'$params[5]', '$params[6]','$params[7]','$phone','$params[11]','$params[12]', 
 STR_TO_DATE('$date','%m-%d-%Y'),'$params[16]','$params[17]','$params[18]', '$fileName'
);";

    mysqli_query($db, $sql);
    $how_many = mysqli_affected_rows($db);
    if ($how_many == -1) {
        echo(mysqli_error($db));
        return false;
    } else {
        return true;
    }
    echo("There were $how_many rows affected");
    close_connector($db);
}

?>