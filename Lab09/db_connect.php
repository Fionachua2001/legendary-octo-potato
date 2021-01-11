<?php
$conn = new mysqli("localhost","root","","db_itp_fiona");

if($conn->connect_error){
    die("Fail to connect to MySQL: $conn->connect_error");
    exit();
}
?>