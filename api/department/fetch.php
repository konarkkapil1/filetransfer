<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = "select * from dept";
    $query = mysqli_query($conn,$sql);
    if($query){
        
        while($data = mysqli_fetch_assoc($query)){
            $res[] = array(
                'serial'=> $data['serial'],
                'id' => $data['dept_id'],
                'name' => $data['dept_name'],
                'manager' => $data['dept_manager_id']
            );
        }
        echo json_encode($res);
        
    }else{
        echo json_encode(null);
    }


?>