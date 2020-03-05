<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $deptid = $_POST['deptid'];
    $managerid = $_POST['userid'];
    $sql = "update dept set dept_manager_id='$managerid' where dept_id='$deptid'";
    if(mysqli_query($conn,$sql)){
        echo json_encode([
            "success" => "manager has been updated"
        ]);
    }else{
        echo json_encode([
            "error" => "error in updating manager"
        ]);
    }

?>