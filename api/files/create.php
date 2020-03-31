<?php

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $fileno = rand(000000,999999).date("Ymdhhis");
    $filename = $_POST['filename'];
    $filedesc = $_POST['filedesc'];
    $receiverid = $userid;
    $submittorname = $_POST['submittor_name'];
    $submittorcontact = $_POST['submittor_contact'];
    $submittoremail = $_POST['submittor_email'];
    
    //sql query to be executed to insert file into the database
    $sql = "insert into files (file_no,file_name,file_desc,dept_id,receiver_id,submittor_name,submittor_contact,submittor_email) VALUES('$fileno','$filename','$filedesc','$deptid','$receiverid','$submittorname','$submittorcontact','$submittoremail')";

    //assign the movement of file also here

    //checking if the query runs or not
    if(mysqli_query($conn,$sql)){
        echo json_encode([
            "success" => "file created successfully",
            "filenumber" => $fileno
        ]);
    }else{
        echo json_encode([
            "error" => "file cannot be created at this moment"
        ]);
    }

?>