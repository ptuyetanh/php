// viewdata
$(document).ready(function () {
    $.ajax({
        url:"view.php",
        type:"POST",
        cache:false,
        success:function (data){
            $('#tbody01').html(data);
        }
    })
});
//insert
$(document).ready(function () {
    function loadTable() {
        $.ajax({
        url: 'view.php', 
        method: 'GET',
        success: function(response) {
            $('#Table tbody').html(response); 
        }
        });
    }
    $('#formInsert').submit(function(e){
       e.preventDefault();
      var fullname = $('#fullname').val();
      var email = $('#email').val();
      var password = $('#pass').val();
      var address = $('#address').val();
      var gender = $('#gender').val(); 
      $.ajax({
        method: 'POST',
        url: "add.php",
        data: {
            fullname:fullname,
            email: email,
            password: password,
            address:address,
            gender: gender,
        },
        success: function (data) {
            alert(data);
            $('#modalInsert').modal('hide');
            loadTable();           
        }
        });
    });
});
$(document).ready(function () {
    $('#formUpdate').submit(function (e) {
        e.preventDefault();
        var id = $('#id').val(); // Lấy giá trị ID từ trường input ẩn
        var password = $('.password').val();
        var fullname = $('.fullnames').val();
        var email = $('.email').val();
        var address = $('.address').val();
        var gender = $('.gender').val();
        $.ajax({
           method: "POST",
           url: "update.php?id=" + id,
           data: {
              id: id, // Bao gồm giá trị ID trong đối tượng dữ liệu
              password: password,
              fullname: fullname,
              email: email,
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
});







