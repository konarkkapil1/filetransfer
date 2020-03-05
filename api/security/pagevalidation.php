<?php

    //checking if all the requests made to the server are POST only no other request allowed
    if(!($_SERVER['REQUEST_METHOD'] == "POST")){
        echo json_encode(array(
            "invalidmethod" => "invalid request method"
        ));
        die();
    }
    
?>