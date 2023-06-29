<?php 
    session_start();
 
	require_once 'conn.php';
 
	if(ISSET($_POST['login'])){
		if(!empty($_POST['email']) && !empty($_POST['password'])){
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$sql = "SELECT * FROM users WHERE Email=:email";
			$stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->bindColumn('ID', $resultID);
                $stmt->bindColumn('Email', $resultEmail);
                $stmt->bindColumn('Fullname', $resultFullname);
                $stmt->bindColumn('Password', $resultPassword);
                $stmt->bindColumn('role', $role);
                if ($stmt->fetch(PDO::FETCH_BOUND)) {
                    if (password_verify($pass, $resultPassword)) {
                        //Lưu token csdl
                        $token = bin2hex(random_bytes(32));
                        $stmt = $conn->prepare('INSERT INTO tokens(token) VALUES (:token)');
                        $stmt->bindParam(':token', $token);
                        $stmt = $stmt->execute();
                        //Lưu token vào cookie và session
                        setCookie('token',$token,time()+3600,'/');
                        $_SESSION['token'] = $token;
                        if( $role == 0){
                            $_SESSION['isloginOK'] = $resultID;
                            header("location:index.php");
                            $conn = null;
                            exit();
                        }else{
                            $_SESSION['isloginOK'] = $resultID;
                            header("location:admin.php");
                            $conn = null;
                           exit();
                        }
                    } else {
                        $error = "Email và mật khẩu không chính xác!";
                        header("location: login.php?error=$error");
                    }
                 }else {
                    $error = "Dữ liệu không khớp";
                    header("location: login.php?error=" . urlencode($error));
                     $conn = null;
                    exit();
                }
             } else {
                 echo 'Không có dữ liệu';
                 $conn = null;
                 exit();
            }
		}else{
			echo "
				<script>alert('Vui lòng nhập email và mật khẩu!')</script>
				<script>window.location = 'index.php'</script>";
		}
    }

?>