<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";

    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;

    //getting email and password from frontend
    $email = $_POST['email'];
    $password = $_POST['password'];

    //sql query for login to be executed
    $sql = "select * from users where email='$email' and password='$password'";

    //executing the query to database
    $query = mysqli_query($conn,$sql);


    
    //checking number of rows returned by query
    if(mysqli_num_rows($query) == 1){

        //fetching user details from databse to be inserted into jwt token
        $res = mysqli_fetch_assoc($query);
        $userid = $res['user_id'];
        $deptid = $res['dept_id'];
         

        //creating all the variable to be used in jwt token
        $tokenId = uniqid();
        $data = [
            'iat'  => time(),           // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $server,           // Issuer
            'exp'  => time() + 3600,      // Expire
            'data' => [                  // Data related to the signer user
                'email'   => $email,      // email from the users table
                'userid' => $userid,
                'deptid' => $deptid
            ]
        ];
        //creating the actual jwt token
        $jwt = JWT::encode(
            $data,      //Data to be encoded in the JWT
            $jwtkey,    // The signing key
            $jwtalgo     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
            );
        setcookie('token',$jwt,time() + 3600,"/");
        echo json_encode(array(
            //login success create a user token here
            "success" => "logged in successfully",
            "token" => $jwt
        ));
    }else{
        echo json_encode(array(
            "autherror" => "invalid credentials"
        ));
    }



?>