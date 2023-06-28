<?php
session_start();
require_once './conn.php';
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
    try{
        $id = $_POST['id'];
        $fullname= $_POST['fullname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $address=$_POST['address'];
        $gender=$_POST['gender'];
        var_dump($_POST);
        $pass_hash = password_hash($password,PASSWORD_BCRYPT);
        $stmt1 = $conn->prepare("UPDATE users SET Fullname = :fullname, Email = :email, Password = :password WHERE ID = :id");
        $stmt1->bindParam(':fullname',$fullname);
        $stmt1->bindParam(':email',$email);
        $stmt1->bindParam(':password',$pass_hash);
        $stmt1->bindParam(':id',$id);
        $stmt1->execute();

        $stmt2 = $conn->prepare("UPDATE clients SET Fullname = :fullname, Email = :email, gender = :gender, address = :address WHERE ID = :id");
        $stmt2->bindParam(':fullname',$fullname);
        $stmt2->bindParam(':email',$email);
        $stmt2->bindParam(':gender',$gender);
        $stmt2->bindParam(':address',$address);
        $stmt2->bindParam(':id',$id);
        $stmt2->execute();
        $success = 'Update thành công';
        echo $success;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
