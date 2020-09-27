<?php
    $db = mysqli_connect("localhost","root","","patient");
    if (mysqli_connect_errno()){
        echo "server not connected" . mysqli_connect_error();
    }
?>
