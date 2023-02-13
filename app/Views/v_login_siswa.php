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
   <link rel="icon" type="image/x-icon" href="<?= base_url()?>/img/logo.png">

</head>

<body class="hold-transition login-page" style="background-image: url('<?= base_url(); ?>/img/bg.jpg'); background-position: center;
    background-repeat: no-repeat;
    background-size: cover; ">
   <div class="login-box">

      <div class="card card-outline card-primary">
         <div class="card-header text-center">
            <a href="#" class="h1"><b>APP</b> Tabungan</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">
               <marquee behavior="scroll" direction="left">Silahkan Login!</marquee>
            </p>
            <form action="<?= base_url('auth/cek_login'); ?>" method="post" id="form">
               <div class="input-group mb-3">
                  <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= old('username'); ?>" id="username" name="username" placeholder="Username" autofocus required>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
                  <div class="invalid-feedback">
                     <?= $validation->getError('username'); ?>
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" required>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
                  <div class="invalid-feedback">
                     <?= $validation->getError('password'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <button type="submit" class="btn bg-gradient-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                  </div>
            </form>

         </div>
      </div>
      <div class="card-footer bg-gradient-primary">
         <center></center>
      </div>

   </div>


   <script src="<?= base_url()?>/plugins/jquery/jquery.min.js"></script>
   <script src="<?= base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="<?= base_url()?>/dist/js/adminlte.min.js?v=3.2.0"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      "<?php if (session()->getFlashdata('swal_icon')) { ?>"
      Swal.fire({
         icon: "<?= session()->getFlashdata('swal_icon'); ?>",
         title: "<?= session()->getFlashdata('swal_title'); ?>",
         text: "<?= session()->getFlashdata('swal_text'); ?>",
         showConfirmButton: false,
         timer: 1500
      })
      "<?php } ?>"
   </script>
</body>

</html>