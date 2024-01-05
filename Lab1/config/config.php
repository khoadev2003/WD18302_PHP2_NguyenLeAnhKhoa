<?php
define('DB_NAME', 'php2');
define('DB_PASSWORD', '');

$con = new mysqli("localhost","root", DB_PASSWORD, DB_NAME);

// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}