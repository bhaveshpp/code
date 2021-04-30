<?php
function conn()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'universetech';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: '.$conn->connect_error);
    }

    return $conn;
}
//echo "Connected successfully";
?> 