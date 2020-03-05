<?php

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";

    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;

    
    if(isset($_COOKIE['token'])){
        $token = $_COOKIE['token'];

        try{
            $jwtdata = JWT::decode($token,$jwtkey,[$jwtalgo]);
        }catch(Exception $e){
            echo "invalid" . $e ;
        }
        $jwtemail = $jwtdata->data->email;
        echo json_encode([
            "email" => $jwtemail
        ]);
    }else{
        echo json_encode([
            "error" => "cookie not set"
        ]);
    }

?>