<?php
$servername = "localhost";
$username = "yearsoflgindia_master_user";
$password = "QKaf3[)0v3AS";
$dbname = "yearsoflgindia_SHYAM";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
