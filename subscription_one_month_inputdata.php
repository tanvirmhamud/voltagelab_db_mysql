<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";
$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

$jsondata = json_decode(file_get_contents('php://input'),true);


if(isset($_GET['api_token'])){
    if ($conn) {
        $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : die();
        $sqlapi = "SELECT * FROM api_token WHERE token='$api_token'";
        $chack = mysqli_query($conn, $sqlapi);
        $chackrow = mysqli_num_rows($chack);
        if ($chackrow > 0) {
            $fullname = $jsondata['fullname'];
            $email = $jsondata['email'];
            $phone_number = $jsondata['phone_number'];
            $address = $jsondata['address'];
            $start_date = $jsondata['start_date'];
            $end_date = $jsondata['end_date'];
            $status = $jsondata['status'];

            $check=mysqli_query($conn,"select * from subscription_one_month where email='$email'");
            $checkrows=mysqli_num_rows($check);

            if($checkrows > 0){
                header('X-PHP-Response-Code: 404', true, 404);
                echo "customer exists"; 
            }else{
               
                $sql1 = "INSERT INTO subscription_one_month (fullname, email, phone_number, address, start_date, end_date, status) VALUES ('$fullname','$email','$phone_number','$address','$start_date','$end_date','$status')";
        
                if (mysqli_query($conn, $sql1)) {
                    echo '{"result" : "success"}';
                }else{
                    echo '{"result" : "sql error"}';
                }
            }





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