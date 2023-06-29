<?php
session_start();
require_once './conn.php';
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
    try{
        $id = $_POST['id'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
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
            $stmt = $conn->prepare("SELECT * FROM users where Email= :email");
    
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $error = "Email đã tồn tại";
                echo $error;
                //header("location: admin.php?error=$error");
            }else{
                $pass_hash = password_hash($password,PASSWORD_BCRYPT);
                $stmt1 = $conn->prepare("UPDATE users SET Fullname = '$fullname', Email = '$email', Password = '$pass_hash' WHERE ID = '$id'");
                
                $stmt1->execute();
        
                $stmt2 = $conn->prepare("UPDATE clients SET Fullname = '$fullname', Email = '$email', gender = '$gender', address = '$address' WHERE ID = '$id'");
                
                $stmt2->execute();
                $success = 'Update thành công';
                echo $success;
            }     
        }
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
