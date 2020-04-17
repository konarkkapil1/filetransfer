<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = "select * from movement where from_id='$userid' OR to_id='$userid' ORDER BY serial DESC";

    $query = mysqli_query($conn,$sql);

    if(mysqli_num_rows($query) > 0){
        while($res = mysqli_fetch_assoc($query)){
            $sql_fetch_data = "select * from files where file_no=".$res['file_number'];
            $query_fetch_data = mysqli_query($conn,$sql_fetch_data);
            if($query_fetch_data){
                $fetch_data = mysqli_fetch_assoc($query_fetch_data);
                $creation_date = $fetch_data['timestamp_submission'];
                $submittor_name = $fetch_data['submittor_name'];
                $submittor_contact = $fetch_data['submittor_contact'];
                $file_desc = $fetch_data['file_desc'];
                $history[] = array(
                    "serial" => $res['serial'],
                    "trackingid" => $res['tracking_id'],
                    "file_number" => $res['file_number'],
                    "created_on" => $creation_date,
                    "submittor_name" => $submittor_name,
                    "submittor_contact" => $submittor_contact,
                    "file_desc" => $file_desc
                );
            }else{
                echo json_encode(null);
            }
            
        }
        echo json_encode($history);
    }else{
        echo json_encode(null);
    }
    
    


?>