<?php
session_start();
if(isset($_SESSION["email"])){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPBasic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css"
        integrity="sha512-yDUXOUWwbHH4ggxueDnC5vJv4tmfySpVdIcN1LksGZi8W8EVZv4uKGrQc0pVf66zS7LDhFJM7Zdeow1sw1/8Jw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="big01">
        <div class="tittle">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- end tittle  -->
        <div class="form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 offset-4">
                        <form method="POST" action="loginProcess.php">

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                <input type="email" class="form-control" name="email" id="basic-url"
                                    aria-describedby="basic-addon1" placeholder="abc@mail.com" id="email">
                            </div>

                            <div class="input-group mb-3 pass">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-lock"></i></span>
                                <i class="fa-solid fa-eye"></i>
                                <input type="password" class="form-control" name="password" id="basic-url"
                                    aria-describedby="basic-addon2" id="password" placeholder="password">
                            </div>

                            <?php
                           if(isset($_GET['error'])){
                             echo "<p style='color:red'>{$_GET['error']}</p>";
                           }
                        ?>
                            <button class="btn btn-primary" type="submit" name="login">logIn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end form  -->
        <div class="register">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>No Account: <a href="./register.php">Register</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>