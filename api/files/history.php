<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = "select * from movement where from_id='$userid' or to_id='$userid'";

    $query = mysqli_query($conn,$sql);

    if(!(mysqli_fetch_assoc($query)==null)){
        while($res = mysqli_fetch_assoc($query)){
                $sql_creation_date = "select timestamp_submission from files where file_no=".$res['file_number'];
                $query_creation_date = mysqli_query($conn,$sql_creation_date);
                $fetch_creation_date = mysqli_fetch_assoc($query_creation_date);
                $creation_date = $fetch_creation_date['timestamp_submission'];
                $history[] = array(
                    "serial" => $res['serial'],
                    "trackingid" => $res['tracking_id'],
                    "file_number" => $res['file_number'],
                    "created_on" => $creation_date
                );
        }
        echo json_encode($history);
    }else{
        echo json_encode(null);
    }
    
    


?>