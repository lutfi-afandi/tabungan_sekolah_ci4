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
   <div class="col-sm-4">
      <div class="card ">
         <div class="card-header bg-navy"></div>
         <div class="card-body">

            <form action="<?= base_url('siswa/password/ganti'); ?>" method="post">
               <div class="form-group">
                  <label>NIS :</label>
                  <input type="" name="password" class="form-control " value="<?= $siswa['nis']; ?>" readonly>
               </div>
               <div class="form-group">
                  <label>Username :</label>
                  <input type="" name="password" class="form-control " value="<?= $siswa['username']; ?>" readonly>
               </div>
               <div class="form-group">
                  <label>Masukan Password Baru :</label>
                  <input type="" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
               </div>
               <div class="invalid-feedback">
                  <?= $validation->getError('password'); ?>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn bg-navy"><i class="fa fa-lock"></i> Simpan</button>
               </div>
            </form>

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
</script>

<script>
   function cetak() {
      v_print = "<?= base_url('siswa/cetak'); ?>";
      window.open(v_print, '_blank');
      // window.location.href = 
   }
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