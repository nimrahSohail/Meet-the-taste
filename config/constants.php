<?php 

// start session
session_start();

// create constants to store non repeating values
define('SITEURL','http://localhost/food-website-meet-the-taste/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345');
define('DB_NAME', 'meet-the-taste');

// execute query and save data in database
$conn =mysqli_connect(LOCALHOST, DB_USERNAME , DB_PASSWORD) or die(mysqli_error());         // database connection
// $conn =mmysqli_connect('localhost', 'username' , 'password') or die(mysqli_error());  jab website banain gy tu ye
// it try to connect with database host which is in our case is local host
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());       //selecting database

?>