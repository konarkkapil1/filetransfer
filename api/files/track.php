<?php


    //this api is for tracking a file, No Auth required unprotected route

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";

    $filenumber = $_POST['filenumber'];

    $sql = "select * from movement where file_number='$filenumber' ORDER BY serial DESC";
    $query = mysqli_query($conn,$sql);

    if($query){
        if(mysqli_num_rows($query) == 0){
            echo json_encode(null);
        }else{
            while($res = mysqli_fetch_assoc($query)){

                //also create logic to fetch names of users also
                $sql_from_name = "select name from users where user_id=".$res['from_id'];
                $query_from_name = mysqli_query($conn,$sql_from_name);
                if($query_from_name){
                    $get_from_name = mysqli_fetch_assoc($query_from_name);
                    $fromname = $get_from_name['name'];
                }

                $sql_to_name = "Select name from users where user_id=".$res['to_id'];
                $query_to_name = mysqli_query($conn,$sql_to_name);
                if($sql_to_name){
                    $get_to_name = mysqli_fetch_assoc($query_to_name);
                    $toname = $get_to_name['name'];
                }
                
                $data[] = array(
                    'serial' => $res['serial'],
                    'filenumber' => $res['file_number'],
                    'from' => !empty($fromname) ? $fromname : $res['from_id'],
                    'to' => !empty($toname) ? $toname : $res['to_id'],
                    'time' => $res['transfer_timestamp']
                );
            }
            echo json_encode($data);
        }
    }else{
        echo json_encode(array(
            "error" => "error fetching result"
        ));
    }





?>