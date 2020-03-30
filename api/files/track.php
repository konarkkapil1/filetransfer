<?php


    //this api is for tracking a file, No Auth required unprotected route

    require "../config/db.php";
    require "../security/pagevalidation.php";
    require "../state/variables.php";

    $filenumber = $_POST['filenumber'];

    $sql = "select * from movement where file_number='$filenumber' ORDER BY transfer_timestamp DESC";
    $query = mysqli_query($conn,$sql);

    if($query){
        if(mysqli_num_rows($query) == 0){
            echo json_encode(null);
        }else{
            while($res = mysqli_fetch_assoc($query)){
                //also create logic to fetch names of users also
                $data[] = array(
                    'serial' => $res['serial'],
                    'filenumber' => $res['file_number'],
                    'from' => $res['from_id'],
                    'to' => $res['to_id'],
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