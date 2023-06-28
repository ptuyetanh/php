<?php
   session_start();
   require_once 'conn.php';
   if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
    $ID = $_POST['id'];
    
    $stmt1 = $conn->prepare("DELETE FROM clients WHERE ID = :id");
    $stmt1->bindParam(':id',$ID);
    $stmt1->execute();

    $stmt2 = $conn->prepare("DELETE FROM users WHERE ID = :id");
    $stmt2->bindParam(':id',$ID);
    $stmt2->execute();
   }

?>