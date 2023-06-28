<?php  
    $username = 'root';
    $password = '';
    $row_limit = 5;
    $conn = new PDO( 'mysql:host=localhost;dbname=manager', $username, $password );
    if(!$conn){
        die("Fatal Error: Connection Failed!");
    }
?>