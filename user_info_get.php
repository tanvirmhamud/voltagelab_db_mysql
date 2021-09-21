<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);
   $response = array();
  if($conn){
   $sql = "SELECT * FROM user_information";
   $result = mysqli_query($conn, $sql);

   if($result){
     header("Content-type : JSON");

    $i= 0;
     while($row = mysqli_fetch_assoc($result)){
           $response[$i]['id'] = $row['id'];
           $response[$i]['full_name'] = $row['full_name'];
           $response[$i]['email'] = $row['email'];
           $response[$i]['passwords'] = $row['passwords'];
           $response[$i]['photo_url'] = $row['photo_url'];
           $response[$i]['account_id'] = $row['account_id'];
           $response[$i]['types'] = $row['types'];


         $i++;
     }
     echo json_encode($response, JSON_PRETTY_PRINT);

   }


  } 





?>