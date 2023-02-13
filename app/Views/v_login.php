<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= $title; ?></title>

   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="stylesheet" href="<?= base_url()?>/plugins/fontawesome-free/css/all.min.css">

   <link rel="stylesheet" href="<?= base_url()?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

   <link rel="stylesheet" href="<?= base_url()?>/dist/css/adminlte.min.css?v=3.2.0">

</head>

<body class="hold-transition login-page" style="background-image: url('<?= base_url(); ?>/img/bg.jpg'); background-position: center;
    background-repeat: no-repeat;
    background-size: cover; background-blend-mode: color-burn; ">
   <div class="login-box">

      <div class="card card-outline card-danger">
         <div class="card-header text-center">
            <a href="#" class="h1"><b>APP</b> Tabungan</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Silahkan Login!</p>
            <form action="#" id="form">
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
                  <div class="invalid-feedback erUser">
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
                  <div class="invalid-feedback erPass">
                  </div>
               </div>
            </form>
            <div class="row">
               <div class="col-12">
                  <button type="button" onclick="submit()" class="btn btn-danger btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
               </div>

            </div>
         </div>
         <div class="card-footer">
            <br>
         </div>

      </div>

   </div>


   <script src="<?= base_url()?>/plugins/jquery/jquery.min.js"></script>

   <script src="<?= base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

   <script src="<?= base_url()?>/dist/js/adminlte.min.js?v=3.2.0"></script>

   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      // const Toast = Swal.mixin({
      //    toast: true,
      //    position: 'top-end',
      //    showConfirmButton: false,
      //    timer: 3000,
      //    timerProgressBar: true,

      // })

      function submit() {
         // ajax adding data to database
         $.ajax({
            url: "<?= base_url('auth/cek_login'); ?>",
            type: "POST",
            data: {
               username: $('[name="username"]').val(),
               password: $('[name="password"]').val(),
            },
            dataType: "JSON",
            success: function (response) {
               if (response.error) {
                  if (response.error.username) {
                     $('#username').addClass('is-invalid');
                     $('.erUser').html(response.error.username);
                  } else {
                     $('#username').removeClass('is-invalid');
                     $('.erUser').html('');
                  }
                  if (response.error.password) {
                     $('#password').addClass('is-invalid');
                     $('.erPass').html(response.error.password);
                  } else {
                     $('#password').removeClass('is-invalid');
                     $('.erPass').html('');
                  }

               } else {
                  if (response.status == 'admin') {
                     Swal.fire(
                        'Login Berhasil',
                        '',
                        'success',
                        false,
                        1500
                     );
                     window.location.href = "<?= base_url('admin/dashboard'); ?>"
                  } else if (response.status == 'petugas') {
                     Swal.fire(
                        'Login Berhasil',
                        '',
                        'success'
                     );
                     window.location.href = "<?= base_url('petugas/dashboard'); ?>"
                  } else if (response.status == 'siswa') {
                     Swal.fire(
                        'Login Berhasil',
                        '',
                        'success'
                     );
                     window.location.href = "<?= base_url('siswa/dashboard'); ?>"
                  } else {
                     Swal.fire(
                        'Login Gagal',
                        response.galat,
                        'error'
                     );
                  }
               }

            },
         });
      }

      $('#password').keypress(function (event) {
         var keycode = (event.keyCode ? event.keyCode : event.which);
         if (keycode == '13') {
            submit();
         }
      });
   </script>
</body>

</html>