<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = 'select * from movement where to_id="'.$userid.'" ORDER BY transfer_timestamp DESC';
    $query = mysqli_query($conn,$sql);

    if($query){
        while($res = mysqli_fetch_assoc($query)){
            $sql_latest = 'select * from movement where file_number="'.$res['file_number'].'" ORDER BY transfer_timestamp DESC LIMIT 1';
            $query_latest = mysqli_query($conn,$sql_latest);
            $records = mysqli_fetch_assoc($query_latest);
            $fetch[] = array(
                "serial" => $records['serial'],
                "file_number" => $records['file_number'],
                "date" => $records['transfer_timestamp']
            );
        }
        echo json_encode($fetch);
    }
    else{
        echo json_encode(null);
    }



?>