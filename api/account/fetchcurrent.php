<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    $sql = 'select * from users where user_id="'.$userid.'"';
    $query = mysqli_query($conn,$sql);

    if($query){
        $res = mysqli_fetch_assoc($query);
        $sql_role = 'select * from role where role_id="'.$res['role'].'"';
        $query_role = mysqli_query($conn,$sql_role);
        if($res){
            if($query_role){
                $getrole = mysqli_fetch_assoc($query_role);
                if($getrole){
                    $sql_dept = 'select * from dept where dept_id="'.$res['dept_id'].'"';
                    $query_dept = mysqli_query($conn,$sql_dept);
                    if($query_dept){
                        $getdept = mysqli_fetch_assoc($query_dept);
                        if($getdept){
                            echo json_encode(array(
                                "name" => $res['name'],
                                "phone" => $res['phone'],
                                "email" => $res['email'],
                                "roleid" => $res['role'],
                                "rolename" => $getrole['role_name'],
                                "deptname" => $getdept['dept_name']
                            ));
                        }else{
                            echo json_encode(null);
                        }
                    }else{
                        echo json_encode(null);
                    } 
                }else{
                    echo json_encode(null);
                }
            }else{
                echo json_encode(null);
            }
        }else{
            echo json_encode(null);
        }
    }else{
        echo json_encode(null);
    }


?>