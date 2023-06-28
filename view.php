<?php   
   session_start();
   require_once './conn.php';
   
   $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
   $limit = 6; // Giới hạn dữ liệu trên mỗi trang
   $offset = ($page - 1) * $limit; // Tính từ bản ghi số bao nhiêu
   $offset = max(0, $offset); // Đảm bảo OFFSET không nhỏ hơn 0
   
   // Lấy dữ liệu phân trang từ csdl
   
   $stmt = $conn->prepare("SELECT * FROM users INNER JOIN clients ON users.ID = clients.CreatedBy LIMIT :limit OFFSET :offset");
   $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
   $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
   
   $stmt->execute();
   
   $data = $stmt->fetchAll();
   
   
   
   //Tính số trang
   
   $total = $conn->query("SELECT COUNT(*) FROM users,clients WHERE users.ID=clients.CreatedBy")->fetchColumn();
   $totalPages = ceil($total/$limit);
   
try{
   foreach($data as $row){
?>
<tr class="">
   <td><?php echo $row['ID']; ?></td>
   <td><?php echo $row['Fullname']; ?></td>
   <td><?php echo $row['Password']; ?></td>
   <td><?php echo $row['Email']; ?></td>
   <td><?php echo $row['Address']; ?></td>
   <td><?php echo $row['Gender']; ?></td>
   <td><?php echo $row['CreatedBy']; ?></td>
   <td class="text-center">
      <button class="btn1 btnupdate" type="button" data-bs-toggle="modal" data-bs-target="#modalUpdate"
         data-id="<?php echo $row['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
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
                        <label for="validationCustom01" class="form-label">Fullname</label>
                        <input type="text" class="form-control" name="fullname" id="fullname"
                           value="<?php echo $row['Fullname']; ?>" required>
                     </div>
                     <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Address</label>
                        <input id="address" type="text" class="form-control" name="address" required>
                     </div>
                     <div class="col-md-4">
                        <label for="validationCustom02" class="form-label"> Gender</label>
                        <input id="gender" type="text" class="form-control" name="gender" required>
                     </div>
                     <div class="col-md-7">
                        <label for="validationCustom03" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                     </div>
                     <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                     </div>
                     <input type="hidden" id="id" name="id" value="">
                     <div class="col-12 text-center  modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- update -->
      <script>
         function loadTable() {
            $.ajax({
               url: 'view.php',
               method: 'GET',
               success: function (response) {
                  $('#Table tbody').html(response);
               }
            });
         }
         $('.btnupdate').click(function (e) {
            var id = $(this).data('id');
            $('#id').val(id); // Gán giá trị ID vào trường input ẩn
            $.ajax({
               method: "post",
               url: "userID.php",
               data: {
                  id: id,
               },
               success: function (data) {
                  if (data.success) {
                     var user = data.user;
                     $('#id').val(user.id);
                     $('#fullname').val(user.fullname);
                     $('#email').val(user.email);
                     $('#password').val(user.password);
                     $('#address').val(user.address);
                     $('#gender').val(user.gender);
                     $('#modalUpdate').modal('show');
                  }
               }
            });
         });
         $('#formUpdate').submit(function (e) {
            e.preventDefault();
            var id = $('#id').val(); // Lấy giá trị ID từ trường input ẩn
            var fullname = $('#fullname').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var address = $('#address').val();
            var gender = $('#gender').val();
            $.ajax({
               method: "POST",
               url: "update.php?id=" + id,
               data: {
                  id: id, // Bao gồm giá trị ID trong đối tượng dữ liệu
                  fullname: fullname,
                  email: email,
                  password: password,
                  address: address,
                  gender: gender,
               },
               success: function (data) {
                  alert(data);
                  $("#modalUpdate").modal('hide');
                  loadTable();
               }
            });
         });
      </script>
      <!-- end update -->
      <button class="btn1 btndelete" type="button" data-id="<?php echo $row['ID']; ?>"><i
            class="fa-solid fa-delete-left"></i></button>
      <script>
         $(document).ready(function () {
            function loadTable() {
               $.ajax({
                  url: 'view.php',
                  method: 'GET',
                  success: function (response) {
                     $('#Table tbody').html(response);
                  }
               });
            }
            $('.btndelete').click(function (e) {
               var id = $(this).data('id');

               if (confirm("Bạn có chắc chắn muốn xóa?")) {
                  var row = $(this).closest('tr');
                  var confirmationDialog = $(this).closest('.confirmation-dialog');

                  confirmationDialog.hide(); // Ẩn hộp thoại xác nhận
                  $.ajax({
                     method: 'POST',
                     url: 'delete.php',
                     data: {
                        id: id
                     },
                     success: function (response) {
                        row.hide();
                        loadTable();
                     }
                  });
               }
            });
         });
      </script>
   </td>
</tr>



<?php

}

}catch(PDOException $e){
   echo "Error: " . $e->getMessage();
}

   

?>