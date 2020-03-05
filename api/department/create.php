<?php

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";


    $deptname = $_POST['deptname'];
    $deptid = uniqid();
    $sql = "insert into dept(dept_id,dept_name) VALUES('$deptid','$deptname')";
    if(mysqli_query($conn,$sql)){
        echo json_encode([
            "success" => "department has been created",
            "dept_id" => $deptid
        ]);
    }else{
        echo json_encode([
            "error" => "error department cannot be created"
        ]);
    }
?>