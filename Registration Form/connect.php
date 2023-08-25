<?php

$con = mysqli_connect('localhost','root','','student_management');
if(!$con){
    // echo "Connection Successful";
    die(mysqli_error($con));
}

?>