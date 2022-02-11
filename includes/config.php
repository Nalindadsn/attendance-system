<?php
$server = "localhost";
$dbname = "attendance_system";
$user = "root";
$pass = "";

// Create connection
try{
   $conn = new PDO("mysql:host=$server;dbname=$dbname","$user","$pass");
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
   die('Unable to connect with the database');
}
    