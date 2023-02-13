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
         <a href="<?= base_url(); ?>/siswa/dashboard" class="nav-link <?= ($uri->getSegment(3) == 'dashboard') ? 'active text-white' : '' ; ?>">
            <i class="nav-icon fas fa-home"></i>
            <p class="text">Beranda</p>
         </a>
      </li>

      <li class="nav-item ">
         <a href="<?= base_url('siswa/profil'); ?>" class="nav-link <?= ($uri->getSegment(3) == 'profil') ? 'active text-white' : '' ; ?>">
            <i class="nav-icon fas fa-cog text-danger"></i>
            <p class="text">Utility</p>
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