<?php
$dbhost = "localhost";
$dbpass = "";
$dbname = "exceltodb";
$dbusername = "root";

$db = new mysqli($dbhost,$dbusername, $dbpass ,$dbname);

if($db->connect_error)
{
    die("Connection error:". $db->connect_error);   

}
// else{

//     echo "Successful Connection";
 
// }

