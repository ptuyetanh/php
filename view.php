<?php   
   session_start();
   require_once './conn.php';
   
   $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
   $limit = 8; // Giới hạn dữ liệu trên mỗi trang
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
         $('.btnupdate').click(function(e){
            var id = $(this).data('id');
            $('#id').val(id);
            userID(id);
            //$('#formUpdate').modal('show');
         });
         
         function userID(id){
   
            $.ajax({
               method: "post",
               url: "userID.php",
               data: {
                  id: id,
               },
               success: function (response) {
                  if(response.success){
                     $('.id').val(response.data.id);
                     $('.fullnames').val(response.data.fullname);
                     $('.email').val(response.data.email);
                     $('.password').val(response.data.password);
                     $('.address').val(response.data.address);
                     $('.gender').val(response.data.gender);
                     $('#modalUpdate').modal('show');
                  }
               }
            });
         }
      </script>
      <!-- end update -->
      <button class="btn1 btndelete" type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="<?php echo $row['ID']; ?>"><i
            class="fa-solid fa-delete-left"></i></button>
      <script>
         $('.btndelete').click(function(e){
            var id = $(this).data('id');
            $('#id').val(id);
            userDelete(id);
            //$('#formDelete').modal('show');
         });
         function userDelete(id){
            $.ajax({
               method: "post",
               url: "userID.php",
               data: {
                  id:id,
               },
               success: function (data) {
                  
               }
            });
         }
      </script>
   </td>
</tr>



<?php

}

}catch(PDOException $e){
   echo "Error: " . $e->getMessage();
}


?>
