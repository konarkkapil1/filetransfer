<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";

    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    if(isset($_POST['file_number'])){
        $file_number = $_POST['file_number'];
    }else{
        echo json_encode(["error"=>"empty values supplied"]);
        die();
    }

    $sql = 'update files set active="0" where file_no="'.$file_number.'"';
    $query = mysqli_query($conn,$sql);
    if($query){
        echo json_encode(["success"=>"file has been completed"]);
    }else{
        echo json_encode(["error"=>"cannot complete file","sqlerror"=>mysqli_error($conn)]);
    }


?>