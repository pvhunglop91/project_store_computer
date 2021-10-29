<?php
    $con = mysqli_connect("localhost","root","","doan");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    }
    mysqli_query($con, "SET NAMES 'utf8'");
?>