<?php 
   Session_start();
   if(!isset($_SESSION["isloginOK"])){
    header("location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css"
        integrity="sha512-yDUXOUWwbHH4ggxueDnC5vJv4tmfySpVdIcN1LksGZi8W8EVZv4uKGrQc0pVf66zS7LDhFJM7Zdeow1sw1/8Jw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">Home <span
                                class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item logout">
                        <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>LogOut</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <h2>Quản lý</h2>
            </div>
        </div>
    </div>
    <!-- modalInsert -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                    data-bs-target="#modalInsert">
                    Tạo mới
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" id="success">
                                <h5 class="modal-title" id="modalTitleId">Tạo mới tài khoản</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formInsert" class="row g-4 needs-validation" method="post">
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="form-label">Fullname</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom02" class="form-label">Address</label>
                                        <input type="text" id="address" class="form-control" name="address" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom02" class="form-label"> Gender</label>
                                        <input type="text" id="gender" class="form-control" name="gender" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" required>
                                        <div class="invalid-feedback">
                                            h@gmail.com
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="pass" name="password" required>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    <div class="col-12 text-center modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit" name="add">Insert</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" id="Table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Gender</th>
                            <th scope="col">CreatedBy</th>
                            <th scope="col">Action</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">
                                <select class="form-select form-select-lg" name="Address" id="Address">
                                    <option selected>Select</option>
                                    <option value="">Hải Dương</option>
                                    <option value="">Hà Nội</option>
                                    <option value="">Bình Giang</option>
                                </select>
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody01">

                    </tbody>
                </table>
                <div id="pagination">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9 offset-sm-5">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous" data-page=""">
                                    <span aria-hidden=" true">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next" data-page="Next">
                                                <span aria-hidden="true">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end pagination  -->
                <script>
                    $(document).ready(function () {
                        function loadData(page) {
                            $.ajax({
                                url: "view.php",
                                type: "POST",
                                data: {
                                    page: page
                                },
                                dataType: "dataType",
                                success: function (data) {
                                    $("#pagination").html(data);
                                }
                            });
                        }
                        loadData(1);
                        $(".page-link").click(function (e) {
                            var page = $(this).attr("data-page");
                            loadData(page);
                        });
                        // $(document).on("click", ".page-link", function(){
                        //      var page = $(this).attr("data-page");
                        //      loadData(page);
                        // });
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- end table  -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Cập nhập tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="post" id="formUpdate" class="row g-3 needs-validation">
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label fullname">Fullname</label>
                            <input type="text" class="form-control fullnames" name="fullname" id="fullname" value=""
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Address</label>
                            <input type="text" class="form-control address" id="address" name="address" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label"> Gender</label>
                            <input id="gender" type="text" class="form-control gender" name="gender" required>
                        </div>
                        <div class="col-md-7">
                            <label for="validationCustom03" class="form-label">Email</label>
                            <input type="text" class="form-control email" id="email" name="email" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Password</label>
                            <input type="text" class="form-control password" id="password" name="password" required>
                        </div>
                        <input type="hidden" class="id" id="id" name="id" value="">
                        <div class="col-12 text-center  modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal update -->

    <div class="modal fade" id="modalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="formDelete" class="row g-3 needs-validation">
                        <div class="col-md-12">
                            Bạn có muốn xóa không?
                        </div>


                        <input type="hidden" class="id" id="id" name="id" value="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Phân trang -->

    <script src="./js/ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>