<?php

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    //sql query to the movement table of db to select all files related to the logged in user
    $sql = "select * from movement where from_id='$userid' OR to_id='$userid'";
    //running the query defined in the sql variable to track files
    $query = mysqli_query($conn,$sql);

    //fetching all records from db table
    if(mysqli_num_rows($query) > 0){
        while($res = mysqli_fetch_assoc($query)){
            
            $sql_from_name = "select name from users where user_id=".$res['from_id'];
            $query_from_name = mysqli_query($conn,$sql_from_name);
            $get_from_name = mysqli_fetch_assoc($query_from_name);
            $from_name = $get_from_name['name'];

            $sql_to_name = "select name from users where user_id=".$res['to_id'];
            $query_to_name = mysqli_query($conn,$sql_to_name);
            $get_to_name = mysqli_fetch_assoc($query_to_name);
            $to_name = $get_to_name['name'];

            $filedata[] = array(
                "serial" => $res['serial'],
                "trackingid" => $res['tracking_id'],
                "file_number" => $res['file_number'],
                "from" => $from_name,
                "to" => $to_name,
                "timestamp"=>$res['transfer_timestamp']
            );
        }
        echo json_encode($filedata);
    }else{
        echo json_encode(null);
    }
    


?>