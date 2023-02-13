<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card card-outline card-navy">
   <div class="card-header">

   </div>
   <div class="card-body">
      <form action="#" id="form">
         <div class="modal-body">
            <div class="form-group">
               <label for="tanggal_awal">Tanggal Awal</label>
               <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
            </div>
            <div class="form-group">
               <label for="tanggal_akhir">Tanggal Akhir</label>
               <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
            </div>
         </div>

      </form>
   </div>

   <div class="card-footer">
      <button class="btn bg-gradient-orange" id="cetak" onclick="cetak()"><i class="fa fa-print"></i> Cetak</button>
   </div>

</div>


<?= $this->endSection('isi'); ?>


<?= $this->section('js'); ?>
<script>
   function cetak() {
      var url = "<?= base_url('admin/laporan/cetak'); ?>";
      var tanggal_awal = $('#tanggal_awal').val();
      var tanggal_akhir = $('#tanggal_akhir').val();
      var v_print = url + "/" + tanggal_awal + "/" + tanggal_akhir;
      console.log(tanggal_awal, tanggal_akhir);
      if (tanggal_awal == '' || tanggal_akhir == '') {
         Toast.fire({
            position: 'top',
            icon: 'error',
            title: 'Pilih tanggalnya dulu',
            timer: 4000,
         })
      } else {
         window.open(v_print, '_blank');

      }

   }
</script>
<script>

</script>



<?= $this->endSection('js'); ?>