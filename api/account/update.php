<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $deptid = $_POST['deptid'];
    $role = $_POST['role'];
    $active = $_POST['active'];
    $userid = $_POST['userid'];
    
    $sql = 'update users set name="'.$name.'",phone="'.$phone.'",email="'.$email.'",dept_id="'.$deptid.'",role="'.$role.'",active="'.$active.'" where user_id="'.$userid.'"';
    $query = mysqli_query($conn,$sql);

    if($query){
        $sql_fetch = 'select * from users where user_id="'.$userid.'"';
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
            echo json_encode(null);
        }
    }else{
        echo json_encode(null);
    }

?>