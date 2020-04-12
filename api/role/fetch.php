<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = "select * from role";
    $query = mysqli_query($conn,$sql);

    if($query){
        while($data = mysqli_fetch_assoc($query)){
            if(!($data['role_id'] == '100')){
                $res[] = array(
                    'serial' => $data['serial'],
                    'name' => $data['role_name'],
                    'id' => $data['role_id']
                );
            }
            
        }
        echo json_encode($res);
    }else{
        echo json_encode(null);
    }

?>