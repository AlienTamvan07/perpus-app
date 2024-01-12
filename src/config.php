<?php

$servername = "10.106.227.137";
$username = "root";
$password = "password";
$dbname = "perpus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
     echo ' not connected';
}
