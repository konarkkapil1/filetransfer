<?php
    include "../state/variables.php";
    
    $conn = mysqli_connect($dbserver,$dbusername,$dbpassword,$database);

    if(!$conn){
        echo "cannot connect to database";
    }
?>