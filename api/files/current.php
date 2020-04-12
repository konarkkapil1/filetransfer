<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = 'select * from movement where to_id="'.$userid.'"';
    $query = mysqli_query($conn,$sql);

    if($query){
        while($res = mysqli_fetch_assoc($query)){
            $sql_latest = 'select * from movement where file_number="'.$res['file_number'].'" ORDER BY serial DESC LIMIT 1';
            $query_latest = mysqli_query($conn,$sql_latest);
            if($query_latest){
                $records = mysqli_fetch_assoc($query_latest);
                
                $sql_data = 'select * from files where file_no="'.$res['file_number'].'"';
                $query_data = mysqli_query($conn,$sql_data);

                if($query_data){
                    $get_data = mysqli_fetch_assoc($query_data);
                    
                    $fetch[] = array(
                        "serial" => $records['serial'],
                        "file_number" => $records['file_number'],
                        "date" => $records['transfer_timestamp'],
                        "description" => $get_data['file_desc']
                    );
                }else{
                    echo json_encode(null);
                    die();
                }

                
            }else{
                echo json_encode(null);
                die();
            }
            
        }
        echo json_encode($fetch);
    }
    else{
        echo json_encode(null);
        die();
    }



?>