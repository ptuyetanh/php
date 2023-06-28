<?php 
session_start();
require_once 'conn.php';

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
    try{
        $fullname= $_POST['fullname'];
        $email= $_POST['email'];
        $password= $_POST['password'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $ID='';
        $stmt = $conn->prepare("SELECT * FROM users where Email= :email");
    
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $error = "Email đã tồn tại";
            echo $error;
            //header("location: admin.php?error=$error");
        }else{
            $pass_hash = password_hash($password,PASSWORD_BCRYPT);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt= $conn->prepare("INSERT INTO users(ID,Fullname,Email,Password) value (:ID,:fullname,:email,:password)");
            $stmt->bindValue(':ID',$ID);
            $stmt->bindValue(':fullname',$fullname);
            $stmt->bindValue(':email',$email);
            $stmt->bindValue(':password',$pass_hash);
            $stmt->execute();
            $ID = $conn->lastInsertId();
            $stmt = $conn->prepare("INSERT INTO clients (ID,Fullname,Email,CreatedBy,Address,Gender) VALUES (:ID,:Fullname,:Email,:CreatedBy,:Address,:gender)");
            $stmt->bindParam(':ID', $ID);
            $stmt->bindParam(':Fullname', $fullname);
            $stmt->bindParam(':Email', $email);
            $stmt->bindParam(':CreatedBy', $ID);
            $stmt->bindParam(':Address', $address);
            $stmt->bindParam(':gender', $gender);
            $stmt->execute();
            $success = "Thêm thành công";
            echo $success;
            //header("Location: admin.php?success=$success");
    
        }
    }catch(PDOException $e){
       echo  $e->getMessage();
    }
    
}


?>