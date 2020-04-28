<?php

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $filenumber = $_POST['file_number'];
    $from = $userid;                  //$userid value is coming from decode.php file of jwt token
    $to = $_POST['to_id'];
    $trackingid = uniqid();            //generating a unique tracking id for file using uniqid function

    //query to be executed to transfer file from one employee to another
    $sql = "insert into movement (tracking_id,file_number,from_id,to_id) VALUES('$trackingid','$filenumber','$from','$to')";
    
    //actually runnning the query written in sql variable and checking if it runs or not
    if(mysqli_query($conn,$sql)){
        $transfer_sql = 'update files set position="'.$to.'" where file_no="'.$filenumber.'"';
        if(mysqli_query($conn,$transfer_sql)){
            echo json_encode([
                "success" => "file has been transfered",
                "tracking_id" => $trackingid
            ]);
        }else{
            echo json_encode([
                "error" => "error occured file cannot be transfered 29",
                "sqlerro " => mysqli_error($conn)
            ]);
        }
        
    }else{
        echo json_encode([
            "error" => "error occured file cannot be transfered 35",
            "sqlerro " => mysqli_error($conn)
        ]);
    }



    

?>