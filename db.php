<?php
$host="localhost"; //server (Big server ho vane ip rakhnu parxa)
$user="root";
$pass=""; //default password blank
$dbname="productivity"; //database name
$conn= new mysqli($host, $user, $pass, $dbname); //connects host,user,pass,dbname
if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}
?>