<?php
//  header('Access-Control-Allow-Origin:*');
//  header('Content-Type:application/json');
//  header('Access-Control-Allow-Method:GET,POST');
//  header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
 require '../inc/dbconfig.php'; 
 include "readapi.php";
  $jwttoken = getToken();

  echo $jwttoken;
 ?>