<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

    if(isset($_GET['api_token'])){
        if ($conn) {
            $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
            $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
            $chack = mysqli_query($conn, $sqlapi);
            $chackrow = mysqli_num_rows($chack);
            if ($chackrow > 0) {
              $row = mysqli_fetch_assoc($chack);
              echo json_encode($row);
            }else{
              header('X-PHP-Response-Code: 404', true, 404);
              echo "User Not found"; 
            }
        }else{
            echo "databse not connect";
        }
      
    
     }else{
         echo "invelid api token";
     }
    



 



?>
