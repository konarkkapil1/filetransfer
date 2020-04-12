<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";

    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;

    
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        //getting email and password from frontend
        $email = $_POST['email'];
        $password = $_POST['password'];
    }else{
        echo json_encode([
            "error" => "empty values",
        ]);
        die();
    }
    

    

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
        $role = $res['role'];
        $name = $res['name'];
        $phone = $res['phone'];
        $email = $res['email'];

        $sql_dept_name = "select * from dept where dept_id='".$deptid."'"; 
        $query_dept_name = mysqli_query($conn,$sql_dept_name);
        if($query_dept_name){
            $fetch = mysqli_fetch_assoc($query_dept_name);
            $deptname = $fetch['dept_name'];
        }

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
                'deptid' => $deptid,
                'role' => $role,
                'name' => $name,
                'phone' => $phone,
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
            "token" => $jwt,
            "userid" => $userid,
            "role" => $role,
            "email" => $email,
            "deptid" => $deptid,
            "name" => $name,
            "phone" => $phone,
            "email" => $email,
            "deptname" => $deptname
        ));
    }else{
        echo json_encode(array(
            "autherror" => "invalid credentials"
        ));
    }



?>