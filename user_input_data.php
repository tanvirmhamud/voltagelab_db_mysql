<?php

$servername = "localhost";
$dbname = "tanvir";
$dbuser = "root";
$dbpassword ="";

$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

$jsondata = json_decode(file_get_contents('php://input'),true);

if($conn){

    $full_name = $jsondata['full_name'];
    $email = $jsondata['email'];
    $passwords = $jsondata['passwords'];
    $photo_url = $jsondata['photo_url'];
    $account_id = $jsondata['account_id'];
    $types = $jsondata['types'];

    $check=mysqli_query($conn,"select * from user_information where email='$email'");
    $checkrows=mysqli_num_rows($check);

    if($checkrows > 0){
        header('X-PHP-Response-Code: 404', true, 404);
        echo "customer exists"; 
    }else{
       
        $sql1 = "INSERT INTO user_information (full_name, email, passwords, photo_url, account_id, types) VALUES ('$full_name','$email','$passwords','$photo_url','$account_id','$types')";

        if (mysqli_query($conn, $sql1)) {
            echo '{"result" : "success"}';
        }else{
            echo '{"result" : "sql error"}';
        }
    }

   
}



?>