<?php
$dbhost = "localhost";
$username = 'root';
$password = '';
$dbname = 'resort';
$dsn = 'mysql:host='.$dbhost.';dbname=' . $dbname;

//get the connection
$dbcon = new PDO($dsn, $username, $password);

if($dbcon === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$tempUserId=1;
?>


