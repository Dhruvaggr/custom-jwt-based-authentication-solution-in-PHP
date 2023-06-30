
<?php
require '../inc/dbconfig.php'; 
function getRecords()
{

  
  global $db;

  $data = json_decode(file_get_contents("php://input"),true); // These two lines can be done writing llb_id in RAW data in POSTMAN in JSON
  $llb_id= $data['llb_id'];
  //print_r( $llb_id);

  $id = implode(',',$llb_id);

  $query2 = "SELECT * from  mdl_smart_goals_with_timing where llb_id IN ($id)";

  $query_run = mysqli_query($db, $query2);
  //echo "A";die;
  if($query_run)
  {
    //echo "B";die;
  
      $single_array = mysqli_fetch_all($query_run,MYSQLI_ASSOC);

    
      //print_r($single_array);die;
      
      
      $data=[
        'admin'=>true,
        'status'=>200,
        'message'=>'Fetched Succesful',
        'data'=>$single_array,
        'exp' => (time() + 60)
      ];
   
      //echo json_encode($data);
      return json_encode($data);
  

  }

  else{
        echo "Dg";
        $data=[
          'admin'=>true,
          'status'=>500,
          'message'=>'Internal Server Error'
        ];
        return json_encode($data);
      }




  

  /**********************************USING FOR LOOP *****************************************88 */



  //$data = json_decode(file_get_contents("php://input"),true); // These two lines can be done writing llb_id in RAW data in POSTMAN in JSON
  //$llb_id= $data['llb_id'];
//   $res=array();
//   for ($i=0;$i<count($llb_id);$i++)
//   {
//             $id_llb= $llb_id[$i];
//             //echo $id_llb;
   
//             $query2 = "SELECT * from  mdl_smart_goals_with_timing where llb_id ='".mysqli_real_escape_string($db, $id_llb)."' ";
//             $query_run = mysqli_query($db, $query2);

//             if($query_run)
//             {
            
//             $single_array = mysqli_fetch_all($query_run,MYSQL_ASSOC);
//           //  print_r($single_array);
//             array_push($res,$single_array);
//             }

//             else{
//                 $data=[
//                   'status'=>500,
//                   'message'=>'Internal Server Error'
//                 ];
//                 return json_encode($data);
//                 //echo "Dhruv";
                
//             }




//   }
//  // print_r($res);
// //die;
//  if(!empty($res))
//   {
//     $data=[
//       'status'=>200,
//       'message'=>'Fetched Succesfully',
//       'data'=>$res
//     ];
//    //echo json_encode($data);
//   return json_encode($data);

//   }
//   else{
//     $data=[
//       'status'=>200,
//       'message'=>'Fetched Failed',
      
//     ];
//    //echo json_encode($data);
//    return json_encode($data);
//   }









 /**********************************************SINGLE LLB_ID PASSING  *****************************************************************/
 // $llb_id = $_GET['llb_id']; //This can be done by passing llb_id in url.


// $llb_id = $_POST['llb_id']; // THIS CAN BE DONE IN BODY- FORM-DATA of POSTMAN.


//$data = json_decode(file_get_contents("php://input"),true);  These two lines can be done writing llb_id in RAW data in POSTMAN in JSON
//$llb_id= $data['llb_id'];


//$query2 = "SELECT * from  mdl_smart_goals_with_timing where llb_id ='".mysqli_real_escape_string($db, $llb_id)."' ";
//$query_run = mysqli_query($db, $query2);


  // if($query_run)
  // {
  //        $res = mysqli_fetch_all( $query_run, MYSQLI_ASSOC  );
    
  //        print_r($res);
  //       if (!empty($res))
  //       {
  //        $data = [

  //           'status'=>200,
  //           'message'=>'Fetched Succesfully at llb_id: '.$llb_id.'',
  //           'data'=>$res
      
            
  //        ];
     
  //       // echo json_encode($data);
  //        //print_r($data);
  //        header('HTTP/1.0 200 OK');
  //       // return json_encode($data);
  //       }
  //       else{
  //         $data = [
  //           'status'=>200,
  //           'message'=>'No data at llb_id: '.$llb_id.''
  //         ];
  //         header('HTTP /1.0 200 OK');
  //         return json_encode($data);
  //       }


  // } 

  // else{
  //   $data = [
  //       'status'=>500,
  //       'message'=>'Internal Server Error'
  //   ];
  //   header("HTTP/1.0 500 Internal Server error");
  //   return  json_encode($data);
  // }
}


function updateRecords()
{
  global $db;

  /***************** GET METHOD : WRITING PARAMETERS IN URL  
  //$llb_id = $_GET['llb_id'];
  *****************************************************/

  /********************************POST METHOD: WRITING IN  RAW IN POSTMAN ********************** 
   $data = json_decode(file_get_contents("php://input"),true);  This can be done in RAW data in POSTMAN; in JSON is formatted in array and its key is passed of llb_id
  and passed in $data array which then passed in mysql to fetch those data only.
  $llb_id= $data['llb_id'];
  ********************************************************************************************** */


  /*******************************************POST METHOD :WRITING IN FORM DATA ****************** */
  $llb_id = $_POST['llb_id'];  //  If you want to pass parameter in form-data or in raw in POSTMAN. 
  $message = $_POST['msg'];    
  $query = "UPDATE mdl_smart_goals_with_timing SET first_month_goal='$message' WHERE llb_id=$llb_id";
  $query_run = mysqli_query($db,$query);
  if($query_run)
  {
    
    $data =[

      'status'=>200,
      'message'=>'Updated Successfully at llb_id: '.$llb_id.''
    ];
    header('HTTP/1.0 200 ok');
    return json_encode($data);
  }
  else{

    $data =[

      'status'=>500,
      'message'=>'Failed to Update'
    ];
    header('HTTP/1.0 500 Internal Server Error');
    return json_encode($data);
  }

  //$res = mysqli_fetch_all($query_run,MYSQL_ASSOC);
}


function deleteRecords()
{
 /***************** GET METHOD : WRITING PARAMETERS IN URL  
  $llb_id = $_GET['llb_id'];
  *****************************************************/

  /********************************POST METHOD: WRITING IN  RAW IN POSTMAN ********************** 
   $data = json_decode(file_get_contents("php://input"),true);  This can be done in RAW data in POSTMAN; in JSON is formatted in array and its key is passed of llb_id
  and passed in $data array which then passed in mysql to fetch those data only.
  $llb_id= $data['llb_id'];
  ********************************************************************************************** */
 global $db;
  $llb_id = $_POST['llb_id'];
  $query = "DELETE from mdl_smart_goals_with_timing WHERE llb_id='$llb_id' ";
  $query_run = mysqli_query($db,$query);
  if ($query_run)
  {
       $data=[
        'status'=>200,
        'message'=>'Record Deleted at llb_id: '.$llb_id.''
       ];
       header('HTTP/1.0 Records Deleted');
       return json_encode($data);

  }
  else{
    $data=[
      'status'=>500,
      'message'=>'Failed to delete data'
    ];
    header('HTTP/1.0 500 Failed to Delete');
    return json_encode($data);
  }

  

}
?>