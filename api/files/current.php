<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql_file = 'select * from files where position="'.$userid.'" AND active="1"';
    $query_file = mysqli_query($conn,$sql_file);

    if($query_file){
        while($res = mysqli_fetch_assoc($query_file)){
            $sql_movement = 'select * from movement where file_number="'.$res['file_no'].'" ORDER BY serial DESC LIMIT 1';
            $query_movement = mysqli_query($conn,$sql_movement);
            if($query_movement){
                while($res_movement = mysqli_fetch_assoc($query_movement)){
                    $result[] = array(
                        "file_number" => $res['file_no'],
                        "description" => $res['file_desc'],
                        "date" => $res_movement['transfer_timestamp'],
                        "serial" => $res_movement['serial']
                    );
                }
            }else{
                echo json_encode(null);
            }
        }
        if(isset($result)){
            echo json_encode($result);
        }else{
            echo json_encode(null);
        }
        
    }else{
        echo json_encode(null);
    }



?>