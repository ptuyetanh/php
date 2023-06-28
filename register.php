<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="./login.php"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
    <div class="tittle">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Register</h2>
                </div>
            </div>
        </div>
    </div>
    <?php 
     if(isset($_GET['success'])){
        echo "<p style='color:red; text-align: center;'>{$_GET['success']}</p>";
      }
    ?>
    <!-- end tittle  -->
    <div class="form">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 offset-4">
                    <form method="post" action="process_register.php">
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelpId"
                                placeholder="abc@mail.com">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fullname</label>
                            <input type="" class="form-control" name="name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="" class="form-control" name="address" placeholder="">
                        </div>
                        <?php
                    if(isset($_GET['error'])){
                        echo "<p style='color:red'> {$_GET['error']} </p>";
                    }

                ?>
                        <button class="btn btn-primary" type="submit" name="Register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end form  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>