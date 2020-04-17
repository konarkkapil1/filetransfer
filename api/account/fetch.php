<?php
    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";
    //files for jwt
    require_once('../vendor/autoload.php');
    use \Firebase\JWT\JWT;
    require "../jwt/decode.php";

    if($deptid == 1){
        $sql = "select * from users";
    }else{
        $sql = 'select * from users where dept_id="'.$deptid.'"';
    }
    $query = mysqli_query($conn,$sql);

    if($query){
        while($res = mysqli_fetch_assoc($query)){
            $sql_dept = "select * from dept where dept_id='".$res['dept_id']."'";
            $query_dept = mysqli_query($conn,$sql_dept);
            if($query_dept){
                $get_dept = mysqli_fetch_assoc($query_dept);
                $deptname = $get_dept['dept_name'];
                $sql_role = "select * from role where role_id='".$res['role']."'";
                $query_role = mysqli_query($conn,$sql_role);
                if($query_role){
                    $get_role = mysqli_fetch_assoc($query_role);
                    $rolename = $get_role['role_name'];
                    if(!($res['user_id'] == $userid)){
                        $userdata[] = array(
                            "userid" => $res['user_id'],
                            "name" => $res['name'],
                            "phone" => $res['phone'],
                            "email" => $res['email'],
                            "deptid" => $res['dept_id'],
                            "deptname" => $deptname,
                            "role" => $res['role'],
                            "rolename" => $rolename,
                            "active" => $res['active']
                        );
                    }
                }else{
                    echo json_encode(null);
                }
                
            }else{
                echo json_encode(null);
            }
            
        }
        echo json_encode($userdata);
    }else{
        echo json_encode(null);
    }


?>