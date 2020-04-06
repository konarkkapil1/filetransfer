<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = "select * from users";
    $query = mysqli_query($conn,$sql);

    if($query){
        while($res = mysqli_fetch_assoc($query)){
            $userdata[] = array(
                "userid" => $res['user_id'],
                "name" => $res['name'],
                "phone" => $res['phone'],
                "email" => $res['email']
            );
        }
        echo json_encode($userdata);
    }


?>