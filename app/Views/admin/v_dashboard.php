<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<marquee behavior="scroll" direction="right" scrollamount="7"><?= $title; ?></marquee>

<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>
<?php 
function buatRupiah($angka){
   $hasil = "Rp. " . number_format($angka,2,',','.');
   return $hasil;
} ?>

<?= $this->section('isi'); ?>
<div class="row">
   <div class="col-sm-3">
      <div class="small-box bg-danger" data-aos="fade-up" data-aos-duration="1000">
         <center>

         </center>
         <div class="inner">
            <h3 style="font-size:2.1rem !important"><?= buatRupiah($total_saldo); ?></h3>
            <p>Total Saldo</p>
         </div>
         <div class="icon">
            <i class="fas fa-university" style="font-size: 90px;"></i>
         </div>

      </div>
   </div>
   <div class="col-sm-3">
      <div class="small-box bg-info" data-aos="fade-right" data-aos-duration="1000">
         <center>

         </center>
         <div class="inner">
            <h3 style="font-size:2.1rem !important"><?= buatRupiah($total_setoran); ?></h3>
            <p>Saldo Masuk</p>
         </div>
         <div class="icon">
            <i class="fas fa-money-bill-alt" style="font-size: 90px;"></i>
         </div>

      </div>
   </div>
   <div class="col-sm-3">
      <div class="small-box bg-success" data-aos="fade-left" data-aos-duration="1000">
         <center>

         </center>
         <div class="inner">
            <h3 style="font-size:2.1rem !important"><?= buatRupiah($total_penarikan); ?></h3>
            <p>Saldo Keluar</p>
         </div>
         <div class="icon">
            <i class="fas fa-money-bill-alt" style="font-size: 90px;"></i>
         </div>

      </div>
   </div>
   <div class="col-sm-3">
      <div class="small-box bg-navy" data-aos="fade-left" data-aos-duration="1000">
         <center>

         </center>
         <div class="inner">
            <h3 style="font-size:2.1rem !important"><?= $total_siswa; ?></h3>
            <p>Total Siswa</p>
         </div>
         <div class="icon">
            <i class="fas fa-users" style="font-size: 90px; color: rgb(255, 255, 255, .25);"></i>
         </div>

      </div>
   </div>
</div>

<?= $this->endSection('isi'); ?>

<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {
      // listkelas();
   });
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
<?= $this->endSection('js'); ?>