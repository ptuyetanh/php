<?php
   session_start();
   require_once 'conn.php';
   if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
      $id = $_POST['id'];
   //xử lí token
   //Lấy token từ header
   $token = $_SERVER['HTTP_X_CSRF_TOKEN'];
   $stmt = $conn->prepare("SELECT * FROM tokens where token = :token");
   $stmt->bindParam(':token', $token);
   $stmt->execute();
   $tokenExists = $stmt->fetch();
   if(!$tokenExists){
      die('Token không hợp lệ');
   }else{
      $stmt1 = $conn->prepare("DELETE FROM clients WHERE ID = :id");
      $stmt1->bindParam(':id',$id);
      $stmt1->execute();
  
      $stmt2 = $conn->prepare("DELETE FROM users WHERE ID = :id");
      $stmt2->bindParam(':id',$id);
      $stmt2->execute();
      $success = "Xóa thành công";
      echo $success;
   } 
   }

?>