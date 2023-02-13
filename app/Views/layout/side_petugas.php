<?php $uri = current_url(true); ?>
<?php 
 if(session()->get('role')=='1'||session()->get('role')=='2'){
   $logut = 'auth/logout';
   $nama = 'nama_petugas';
   $role = 'Petugas';
   }else{
   $logut = 'auth/logout';
   $nama = 'nama_siswa';
   $role = 'Siswa';
} ?>
<nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
         <a href="<?= base_url(); ?>/admin/dashboard" class="nav-link <?= ($uri->getSegment(3) == 'dashboard') ? 'active text-white' : '' ; ?>">
            <i class="nav-icon fas fa-home"></i>
            <p class="text">Beranda</p>
         </a>
      </li>

      <li class="nav-item">
         <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-database text-primary"></i>
            <p>
               Master Data
               <i class="right fas fa-angle-left"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
            <li class="nav-item">
               <a href="<?= base_url('admin/siswa'); ?>" class="nav-link  <?= ($uri->getSegment(3) == 'siswa') ? 'active text-maroon' : '' ; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Siswa</p>
               </a>
            </li>

         </ul>
         <ul class="nav nav-treeview">
            <li class="nav-item">
               <a href="<?= base_url('admin/petugas'); ?>" class="nav-link <?= ($uri->getSegment(3) == 'petugas') ? 'active text-maroon' : '' ; ?>">
                  <i class="far   fa-circle nav-icon"></i>
                  <p>Data Petugas</p>
               </a>
            </li>

         </ul>
         <ul class="nav nav-treeview">
            <li class="nav-item">
               <a href="<?= base_url('admin/kelas'); ?>" class="nav-link <?= ($uri->getSegment(3) == 'kelas') ? 'active text-maroon' : '' ; ?>">
                  <i class="far  fa-circle  nav-icon"></i>
                  <p>Data Kelas</p>
               </a>
            </li>

         </ul>
      </li>
      <li class="nav-item ">
         <a href="<?= base_url('admin/transaksi'); ?>" class="nav-link <?= ($uri->getSegment(3) == 'transaksi') ? 'active text-white' : '' ; ?>">
            <i class="nav-icon fas fa-credit-card text-danger"></i>
            <p class="text">Transaksi</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="<?= base_url('admin/tabungan'); ?>" class="nav-link <?= ($uri->getSegment(3) == 'tabungan') ? 'active text-white' : '' ; ?>">
            <i class="nav-icon fas fa-landmark text-success"></i>
            <p class="text">Tabungan</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="<?= base_url('admin/laporan'); ?>" class="nav-link <?= ($uri->getSegment(3) == 'laporan') ? 'active text-white' : '' ; ?>">
            <i class="nav-icon fas fa-file-archive text-success"></i>
            <p class="text">Laporan</p>
         </a>
      </li>
      <li class="nav-item">
         <a href="<?= base_url($logut); ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt text-warning"></i>
            <p class="text">Keluar</p>
         </a>
      </li>
   </ul>
</nav>