<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";
    $active = $_POST['active'];
    $user_id = $_POST['userid'];

    $sql = 'update users set active="'.$active.'" where user_id="'.$user_id.'"';
    $query = mysqli_query($conn,$sql);

    if($query){
        $sql_fetch = 'select * from users where user_id="'.$user_id.'"';
        $query_fetch = mysqli_query($conn ,$sql_fetch);
        if($query_fetch){
            $getdata = mysqli_fetch_assoc($query_fetch);
            echo json_encode([
                "userid" => $getdata['user_id'],
                "phone" => $getdata['phone'],
                "email" => $getdata['email'],
                "deptid" => $getdata['dept_id'],
                "role" => $getdata['role'],
                "active" => $getdata['active']
            ]);
        }else{
            echo json_encode(["query_fetch"=>"not working","error" => mysqli_error($conn)]);
        }
    }else{
        echo json_encode(["query1" => "not working","error" => mysqli_error($conn)]);
    }

?>