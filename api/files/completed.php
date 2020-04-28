<?php 
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = 'select * from files where active=0';
    $query = mysqli_query($conn,$sql);

    if($query){
        while($data = mysqli_fetch_assoc($query)){
            $res[] = array(
                "file_number" => $data['file_no'],
                "serial" => $data['serial'],
                "name" => $data['file_name'],
                "description" => $data['file_desc'],
                "deptid" => $data['dept_id'],
                "timestamp_submission" => $data['timestamp_submission'],
                "submittor_name" => $data['submittor_name'],
                "submittor_contact" => $data['submittor_contact'],
                "submittor_email" => $data['submittor_email'],
                "pages" => $data['pages']
            );
        }
        echo json_encode($res);
    }else{
        echo json_encode(["error"=> "cannot fetch data"]);
    }



?>