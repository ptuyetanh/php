<?php
session_start();
require_once './conn.php';
if(ISSET($_POST['Register'])){
    if($_POST['email'] != "" || $_POST['name'] != "" || $_POST['pass'] != ""){
        try{
            $address = $_POST['address'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            $stmt = $conn->prepare("SELECT * FROM users WHERE Email = :email ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
            if($stmt->rowCount()>0){
                $error ="Email đã tồn tại";
                header("location: register.php?error=$error");
            }else{
                $pass_hash = password_hash($pass,PASSWORD_BCRYPT);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("INSERT INTO users (ID, Email, Password, Fullname) VALUES (:ID, :email, :pass, :name)");
                $stmt->bindParam(':ID', $ID);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pass', $pass_hash);
                $stmt->bindParam(':name', $name);
                $stmt->execute();
                $ID = $conn->lastInsertId();

                $stmt = $conn->prepare("INSERT INTO clients (ID,Fullname,Email,CreatedBy,Address) VALUES (:ID,:name,:email,:CreatedBy,:Address)");
                $stmt->bindParam(':ID', $ID);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':CreatedBy', $ID);
                $stmt->bindParam(':Address', $address);
                $stmt->execute();
                include "./send_mail.php";
                $success = "Đăng kí thành công";
                header("location: register.php?success=$success");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }else{
        echo "
            <script>alert('Please fill up the required field!')</script>
            <script>window.location = 'register.php'</script>
        ";
    }
}


?>