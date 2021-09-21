<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

$email = isset($_GET['email']) ? $_GET['email'] : die();
$types = isset($_GET['types']) ? $_GET['types'] : die();
    
 if ($conn) {
    
    $sql = "SELECT * FROM user_information WHERE email='$email' AND types=$types";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $checkrows=mysqli_num_rows($result);
        if ($checkrows > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row, JSON_PRETTY_PRINT);
        }else{
            header('X-PHP-Response-Code: 404', true, 404);
            echo "User Not found"; 
        }  
    }
    
 }

  


?>