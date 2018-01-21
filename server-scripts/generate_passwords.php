<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/

if($_GET) exit;
if($_POST) exit;

$pass = array('cs545','fall2017','sdsu');

#### Using SHA256 #######
$salt='$5$R$4%^gj9@9j45f27';
# 12 character salt starting with $1$
for($i=0; $i<count($pass); $i++){
    echo crypt($pass[$i],$salt)."\n";
}
?>