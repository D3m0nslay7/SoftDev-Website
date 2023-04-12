<?php
//we have this just to connect to hte database
define('DB_HOST', 'localhost');
define('DB_USER', 'u-220181356');
define('DB_PASS', '1D37WbzrCdq56nQ');
define('DB_NAME', 'u_220181356_db');

//connect to database, catch if there is an error
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
  echo "failed";
  die("Connection failed: " . mysqli_connect_error());
  
}
//echo "Connected successfully";



