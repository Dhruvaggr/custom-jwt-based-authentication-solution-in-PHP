<?php 
function getToken()
{
            header('Access-Control-Allow-Origin:*');
            header('Content-Type:application/json');
            header('Access-Control-Allow-Method:GET,POST');
            header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
            require '../inc/dbconfig.php'; 
            global $db;
            //$headers = getallheaders();
           // error_reporting(0);
            //require '../inc/dbconfig.php'; 
            include('data.php');
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $headers = apache_request_headers();
            //print_r($headers);
            //die;

            $key = $headers['secret'];
            

            /************************************Json Web Tokens ************************/

            $mySecretKey = 'abc';





            if($key===$mySecretKey)
            { 
                function base64url_encode($str)
                {
                    return rtrim(strtr(base64_encode($str),'/+','-_'), '=');
                }
 
                    if($requestMethod=='GET' || $requestMethod=='POST')
                    {   

                        // HEADERS 
                        $head = [ 'alg'=>'SHA256','typ'=>'JWT'];
                       // print_r($head);
                        $headers_encoded = base64url_encode(json_encode($head));
                        //echo $headers_encoded;
                       
                   
                        
                        $smart_goal_records= getRecords();
                       // echo $smart_goal_records;

                        $payload_encoded = base64url_encode($smart_goal_records);
                        //echo $payload;

                        $signature = hash_hmac('SHA256',"$headers_encoded.$payload_encoded", $key,true);
                        
                        
                     
                        
                        $signature_encoded = base64url_encode($signature);
                       
                        $jwttoken = "$headers_encoded.$payload_encoded.$signature_encoded";

                        //echo $jwttoken;
                       
                        return   $jwttoken;
                        
     
                    }
                    else{
                        $data = [
                            'status'=>405,
                            'message'=>$requestMethod.' Method not allowed'
                        ];
                        header("HTTP/1.0 405 Method Not allowed");
                        //echo json_encode($data);
                        return json_encode($data);
                    }


            }


            else{


                //  echo json_encode($authorizationHeader);
                //echo json_encode($secretKey);

                return " You are not authorized to use data of this api";
            }

          


 }
?>
