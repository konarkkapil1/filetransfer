<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";

    //getting all the data from frontend
    //uniqid creates a uniqueid for userid
    $user_id = uniqid().date("Ymdhhis");
    $password = $_POST['password'];
    $name = $_POST['name'];
    $dept_id = $_POST['dept_id'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    //query to be executed in database
    $query = "insert into users (user_id,password,name,dept_id,role,phone,email) VALUES ('$user_id','$password','$name','$dept_id','$role','$phone','$email')";

    if(mysqli_query($conn,$query)){
        echo json_encode([
            "success" => "account created successfully",
        ]);
    }else{
        echo json_encode([
            "error" => "there was an error creating account",
            "errorcode" => mysqli_error($conn)
        ]);
    }




?>