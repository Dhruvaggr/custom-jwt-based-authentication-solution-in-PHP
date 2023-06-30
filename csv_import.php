<?php

include_once 'inc/dbconfig.php';


if(!empty(isset($_FILES['myfile']['name'])))
{
     echo"<pre>";
    print_r($_FILES);
    $file = fopen($_FILES['myfile']['tmp_name'],"r");
  //  print_r($file);
    $csv_data= [];
    $i=7;
    while(($data = fgetcsv($file,10000,","))!==false)

{
    $numrows = count($data);

    if($numrows>0)
    {
        $csv_data[] = $data;
    }



}
//echo count($csv_data);


  
$rows = 1;
$newdata = array();

 for($i=7; $i<count($csv_data); $i++)


 {
     
    $llb_id = $csv_data[$i][6];
    $first_goal = $csv_data[$i][8];
    $first_goal_type = $csv_data[$i][7];

    $last_goal  = $csv_data[$i][10];
    
    $last_goal_type = $csv_data[$i][9];
    

    /* $query =   $db->query("INSERT INTO mdl_smart_goals_with_timing(llb_id ,first_month_goal, 1_goal_type, last_month_goal ,2_goalmonth_type) 
      VALUES('".$llb_id."', '".mysqli_real_escape_string($db, $first_goal)."' , '".mysqli_real_escape_string($db,$first_goal_type)."', '".mysqli_real_escape_string($db,$last_goal)."','".mysqli_real_escape_string($db,$last_goal_type)."')");   
     */ 
    
      $query2 = "SELECT * from  mdl_smart_goals_with_timing where llb_id ='".mysqli_real_escape_string($db, $llb_id)."' ";
   
      $result = mysqli_query($db, $query2);
      if (!$result) {
        die('Query execution failed: ' . mysqli_error($db));
    }
    else{
      $data = mysqli_fetch_assoc($result);
      array_push($newdata,$data);
      //print_r($data);
      echo"<pre>";
      $idnew = $data['llb_id'];
      //echo $idnew;
   
    }
  

 
     
     if($rows>=845)
     {
        break;
     }
     $rows++;

  }
  






print_r($newdata);
//echo json_encode($newdata);
var_dump($newdata);
fclose($file);







}




?>