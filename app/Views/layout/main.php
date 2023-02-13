<?php $uri = current_url(true); ?>
<?php 
 if(session()->get('role')=='1'||session()->get('role')=='2'){
   $logut = 'auth/logout';
   $nama = 'nama_petugas';
   $role = 'Petugas';
   $status = 'petugas';
   }else{
   $logut = 'auth/logout';
   $nama = 'nama_siswa';
   $role = 'Siswa';
   $status = 'siswa';
} ?>
<!DOCTYPE html>
<html lang="en">


<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= (!empty($title))   ? $title : '' ; ?> | Aplikasi Tabungan</title>

   <link rel="icon" type="image/x-icon" href="<?= base_url()?>/img/logo.png">

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?= base_url()?>/plugins/fontawesome-free/css/all.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url()?>/dist/css/adminlte.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;700;900&display=swap" rel="stylesheet">
   <!-- //select2 -->
   <link rel="stylesheet" href="<?= base_url()?>/plugins/select2/css/select2.min.css">
   <link rel="stylesheet" href="<?= base_url()?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- AOS -->
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <style>
      body {
         font-family: 'Inter', sans-serif;
      }
   </style>
</head>

<body class="hold-transition sidebar-mini">
   <!-- Site wrapper -->
   <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark" style="background: linear-gradient(153deg, rgba(255,160,96,1) 12%, rgba(181,73,0,1) 92%);">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

         </ul>

         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">

            <li class="nav-item">
               <a class="nav-link" href="#" role="button">
                  <marquee behavior="scroll" direction="lect" scrollamount="4">Selamat Datang, <?= session()->get($nama); ?></marquee>
               </a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#" style=" padding-top: 4px">
                  <div class="image">
                     <?php  if(session()->get('role') =='1'||session()->get('role') =='2'){
                     if(session()->get('foto')==null){
                        $foto = 'img/admin.png';
                     }else{
                        $foto = 'public/foto_petugas/'.session()->get('foto');
                     }
                  echo '<img src="'. base_url($foto).'" class=" img-circle" alt="User Image" style="origin-fit:cover;width: 35px;height: 35px;">';
                  }else{
                     if(session()->get('foto')==null){
                        $foto = 'img/siswa.png';
                     }else{
                        $foto = 'public/foto_siswa/'.session()->get('foto');
                     } 
                  echo '<img src="'. base_url($foto).'" class=" img-circle" alt="User Image" style="origin-fit:cover;width: 35px;height: 35px; ">';
                  } ?>

                  </div>
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header"><?= session()->get($nama); ?></span>

                  <a href="<?= base_url($status.'/profil'); ?>" class="dropdown-item">
                     <i class="fas fa-user-cog mr-2"></i> Profil <?= $role; ?>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="<?= base_url($logut); ?>" class="dropdown-item dropdown-footer"><i class="fa fa-sign-out-alt"></i> Logout</a>
               </div>

            </li>
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
               </a>
            </li>

         </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-orange elevation-1">
         <!-- Brand Logo -->
         <a href="<?= base_url()?>" class="brand-link" style="background: linear-gradient(237deg, rgba(255,160,96,1) 12%, rgba(181,73,0,1) 92%);">
            <img src="<?= base_url()?>/img/logo.png" alt="APP Tabungan Logo" class="brand-image  elevation-3" style="">
            <span class="brand-text font-weight-bold text-white">APP Tabungan</span>
         </a>

         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <!-- <div class="user-panel pb-3 mb-3 d-flex ">

               <div class="info">
                  <a href="#" class="d-block"><?= session()->get($nama); ?> </a><span class="badge badge-success"><?= $role; ?></span>
               </div>
            </div> -->

            <!-- Sidebar Menu -->
            <?php if(session()->get('role') =='1'||session()->get('role') =='2'){
                  echo $this->include('layout/side_petugas');
               }else{
                  echo $this->include('layout/side_siswa');
               }
             ?>
            <!-- /.sidebar-menu -->

         </div>
         <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1>
                        <?= $this->renderSection('judul'); ?>
                     </h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"></li> <?= $uri->getSegment(3); ?>
                     </ol>
                  </div>
               </div>
            </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">

            <?= $this->renderSection('subjudul'); ?>

            <?= $this->renderSection('isi'); ?>
            <!-- <input type="text" id="input-nilai" name="nilai_angka">
            <p id="hasil"></p> -->
            <!-- /.card-footer-->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
   <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
         <b>Version</b> 1.0.0-rc
      </div>
      <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Hendra Setiawan</a>.</strong>
   </footer>
   <!-- ./wrapper -->

   <!-- jQuery -->
   <script src="<?= base_url()?>/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="<?= base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="<?= base_url()?>/dist/js/adminlte.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- DataTables  & Plugins -->
   <script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
   <script src="<?= base_url(); ?>/plugins/select2/js/select2.full.min.js"></script>
   <script src="<?= base_url(); ?>/plugins/inputmask/jquery.inputmask.min.js"></script>

   <?= $this->renderSection('js'); ?>
   <script>
      $('#input-nilai').keyup(function () { // Jika Select Box id provinsi dipilih
         var input_nilai = $('#input-nilai').val();
         var hasil = $('#hasil')
         var url = "<?= base_url('home/hasil') ?>";
         console.log(input_nilai);
         $.ajax({
            url: url,
            type: "POST",
            data: {
               nilai_angka: input_nilai,
            },
            dataType: "json",
            success: function (response) {
               console.log(response.nilai);
               $('#hasil').text(response.nilai);
            }
         });
      });

      const Toast = Swal.mixin({
         toast: true,
         position: 'top-end',
         showConfirmButton: false,
         timer: 3000,
         timerProgressBar: true,

      })
   </script>
   <script>
      AOS.init();
   </script>
</body>

</html>