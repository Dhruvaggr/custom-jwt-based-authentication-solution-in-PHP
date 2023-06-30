<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');
 header('Access-Control-Allow-Method:GET,POST');
 header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
//  require '../inc/dbconfig.php'; 
//   include "../smartGoal/readapi.php";
  error_reporting(0);

 $reqMethod = $_SERVER['REQUEST_METHOD'];

 $headers = apache_request_headers();
 $token = $headers['Authorization'];
 $jwt = str_replace("Bearer ","",$token);

 $key = 'abc';
//  $servertoken = getToken();
//  echo $servertoken;
//  die;

 
 $token_parts = explode(".",$jwt);
 function base64url_encode($str)
 {
     return rtrim(strtr(base64_encode($str),'/+','-_'), '=');
 }

 if(count($token_parts)===3)
 {
      $head = base64_decode($token_parts[0]);
      $payload = base64_decode($token_parts[1]);
      $received_signature = $token_parts[2];
      //Create signature
      $expiration=  json_decode($payload)->exp;
      //print_r($expiration);
      //die;
      $is_token_expired = ($expiration-time())<0;
    
    
      $base64_url_header = base64url_encode($head);
      $base64_url_payload = base64url_encode($payload);
      

      $generated_signature = hash_hmac('sha256',$base64_url_header.'.'.$base64_url_payload,$key,true);
      $generated_signature_base64 =  base64url_encode($generated_signature);
      $is_valid_signature = $generated_signature_base64 ===  $received_signature;
      if ($is_token_expired)
      {   
        echo "Expired";
      }
      elseif(!$is_valid_signature ){
            echo "Not Valid Signature";
      }
      else{
        
          //  echo "valid";
          $decoded_payload =  base64_decode($base64_url_payload);
          echo $decoded_payload ;
      }
 }
 else{

    echo "Invalid";
 }
 //$signature = base64_encode(hash_hmac("SHA256",$token_parts[0].$token_parts[1],$key));



 //print_r($token);

 //print_r($_SERVER[]);

?>