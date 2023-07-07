function getCookie(name) {
    var cookieArr = document.cookie.split(';');
    for(var i=0; i<cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split('=');
        if(name === cookiePair[0].trim()){
            return decodeURIComponent(cookiePair[1])
        }
    }
    return null;
}

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
//insert
    $('#formInsert').submit(function(e){
       e.preventDefault();
      var fullname = $('#fullname').val();
      var email = $('#email').val();
      var password = $('#pass').val();
      var address = $('#address').val();
      var gender = $('#gender').val(); 
      var token = getCookie('token') || '<?php echo $_SESSION["token"]; ?>';
      $.ajax({
        method: 'POST',
        headers: {'X-CSRF-token': token},
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
// Update 
$(document).ready(function () {
    $('#formUpdate').submit(function (e) {
        e.preventDefault();
        var id = $('#id').val(); // Lấy giá trị ID từ trường input ẩn
        var password = $('.password').val();
        var fullname = $('.fullnames').val();
        var email = $('.email').val();
        var address = $('.address').val();
        var gender = $('.gender').val();
        var token = getCookie('token') || '<?php echo $_SESSION["token"]; ?>';
        $.ajax({
           method: "POST",
           headers: {'X-CSRF-token': token},
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
//Delete
$(document).ready(function () {
    $('#formDelete').submit(function(e){
        e.preventDefault();
        var id = $('#id').val();
        var token = getCookie('token') || '<?php echo $_SESSION["token"]; ?>';
        $.ajax({
            method: "post",
            headers: {'X-CSRF-token': token},
            url: "delete.php",
            data: {
                id:id,
            },
            success: function (data) {
              alert(data);
              $("#modalDelete").modal('hide');
              loadTable();
            }
        });
    })
});








