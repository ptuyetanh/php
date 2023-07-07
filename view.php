<?php
  define("ROW_PER_PAGE",5);
  require_once './conn.php';
        $search_keyword = '';
        if(!empty($_POST['search']['keyword'])) {
            $search_keyword = $_POST['search']['keyword'];
        }
        $sql = 'SELECT * FROM users, clients WHERE (users.ID = clients.CreatedBy) AND (users.ID LIKE :keyword OR users.Fullname LIKE :keyword OR users.Email LIKE :keyword OR clients.Address LIKE :keyword OR clients.Gender LIKE :keyword) ORDER BY users.ID DESC';
        /* Pagination Code starts */
        $per_page_html = '';
        $page = 1;
        $start=0;
        if(!empty($_POST["page"])) {
            $page = $_POST["page"];
            $start=($page-1) * ROW_PER_PAGE;
        }
        $limit=" limit " . $start . "," . ROW_PER_PAGE;
        $pagination_statement = $conn->prepare($sql);
        $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
        $pagination_statement->execute();
    
        $row_count = $pagination_statement->rowCount();
        if(!empty($row_count)){
            $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
            $page_count=ceil($row_count/ROW_PER_PAGE);
            if($page_count>1) {
                for($i=1;$i<=$page_count;$i++){
                    if($i==$page){
                        $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                    } else {
                        $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                    }
                }
            }
            $per_page_html .= "</div>";
        }
        
        $query = $sql.$limit;
        $pdo_statement = $conn->prepare($query);
        $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
	
?>
<form action="" method="post">
   <div class="container">
      <div class="row">
         <div class="col-sm-2 offset-sm-10 search">
            <input class="form-control mb-2" name='search[keyword]' type="text" placeholder="Search"
               value="<?php echo $search_keyword; ?>" id='keyword'>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
         </div>
      </div>
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
               </thead>
               <tbody id='table-body'>
                  <?php
                        if(!empty($result)) { 
                            foreach($result as $row) {
                        ?>
                  <tr class='table-row'>
                     <td><?php echo $row['ID']; ?></td>
                     <td><?php echo $row['Fullname']; ?></td>
                     <td><?php echo $row['Password']; ?></td>
                     <td><?php echo $row['Email']; ?></td>
                     <td><?php echo $row['Address']; ?></td>
                     <td><?php echo $row['Gender']; ?></td>
                     <td><?php echo $row['CreatedBy']; ?></td>
                     <td class="text-center">
                        <button class="btn1 btnupdate" type="button" data-bs-toggle="modal"
                           data-bs-target="#modalUpdate" data-id="<?php echo $row['ID']; ?>"><i
                              class="fa-solid fa-pen-to-square"></i></button>
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
                              $('#id').val(id);
                              userID(id);
                              //$('#formUpdate').modal('show');
                           });

                           function userID(id) {

                              $.ajax({
                                 method: "post",
                                 url: "userID.php",
                                 data: {
                                    id: id,
                                 },
                                 success: function (response) {
                                    if (response.success) {
                                       $('.id').val(response.data.id);
                                       $('.fullnames').val(response.data.fullname);
                                       $('.email').val(response.data.email);
                                       $('.address').val(response.data.address);
                                       $('.gender').val(response.data.gender);
                                       $('.password').val(response.data.password);
                                       $('#modalUpdate').modal('show');
                                    }
                                 }
                              });
                           }
                        </script>
                        <!-- end update -->
                        <button class="btn1 btndelete" type="button" data-bs-toggle="modal"
                           data-bs-target="#modalDelete" data-id="<?php echo $row['ID']; ?>"><i
                              class="fa-solid fa-delete-left"></i></button>
                        <script>
                           $('.btndelete').click(function (e) {
                              var id = $(this).data('id');
                              $('#id').val(id);
                              userDelete(id);
                              //$('#formDelete').modal('show');
                           });

                           function userDelete(id) {
                              $.ajax({
                                 method: "post",
                                 url: "userID.php",
                                 data: {
                                    id: id,
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
                        }
                        ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <!-- end table  -->
   <?php echo $per_page_html; ?>
</form>
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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
                  <input type="text" class="form-control fullnames" name="fullname" id="fullnameModal" value=""
                     required>
               </div>
               <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Address</label>
                  <input type="text" class="form-control address" id="addressModal" name="address" required>
               </div>
               <div class="col-md-4">
                  <label for="validationCustom02" class="form-label"> Gender</label>
                  <input id="genderModal" type="text" class="form-control gender" name="gender" required>
               </div>
               <div class="col-md-6">
                  <label for="validationCustom03" class="form-label">Email</label>
                  <input type="email" class="form-control email" id="emailModal" name="email" required>
               </div>
               <div class="col-md-4">
                  <label for="validationCustom03" class="form-label">Password</label>
                  <input type="password" class="form-control password" id="passwordModal" name="password" value=""
                     required>
               </div>
               <div class="col-md-2">
                  <label for="validationCustom03" class="form-label">ID</label>
                  <input type="text" class="form-control id" name="id" id="id" value="" readonly>
               </div>
               <div class="col-12 text-center  modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal update -->
