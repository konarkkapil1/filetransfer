<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;

    //checking if cookie with token exists or not if not do not let user see this page
    if(isset($_COOKIE['token'])){

        //decoding jwt token
        $token = $_COOKIE['token'];
        try{
            $data = JWT::decode($token,$jwtkey,[$jwtalgo]);
        }
        catch(Exception $e){               //checking if jwt decode worked or not if not throw error
            echo json_encode([
                "error" => "not authorised"
            ]);
            die();
        }
        $email = $data->data->email;            //getting email from the jwt token
        $userid = $data->data->userid;          //getting userid from jwt token
        $deptid = $data->data->deptid;          //this dept id goes directly to the sql query from here

    }
    else{
        echo json_encode([
            "error" => "not authorised"
        ]);
        die();
    }
?>