<?php
require("config.php");
$servername = constant("DataBaseHostName");
$username = constant("DataBaseUserName");
$password = constant("DataBasePassWord");
$dbname = constant("DataBaseName");

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DROP DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database $dbname dropped successfully";
} else {
    echo "Error dropping database: " . $conn->error;
}

$conn->close();
