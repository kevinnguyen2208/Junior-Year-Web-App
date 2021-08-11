<?php 

$username = "s102449993";//Username as in the MySql Database. Change appropriately
$database_name = "s102449993_db"; //Database Name
$connection = @mysqli_connect($host, $username, $password, $database_name);//Database:: Connection to the Database. Initially set to null
$password = "220800"; //Password to the database. Change the value as suits
$host = "feenix-mariadb.swin.edu.au";///Connection therough the localhost



$connection = mysqli_connect($host, $username, $password, $database_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}



 ?>