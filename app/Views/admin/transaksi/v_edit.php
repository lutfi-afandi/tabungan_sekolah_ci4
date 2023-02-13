<?= $this->extend('layout/main'); ?>
<?php 
function buatRupiah($angka){
   $hasil = "Rp. " . number_format($angka,2,',','.');
   return $hasil;
}
 ?>

<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>

<div class="card ">
   <div class="card-header">
      <button href="" class="btn btn-sm btn-light" onclick="kembali()"><i class="fa fa-arrow-left"></i> Kembali</button>
   </div>
   <form action="<?= base_url('admin/transaksi/update/'.$transaksi['id_transaksi']); ?>" id="form" style="display: none;">
      <div class="card-body">
         <div class="form-group">
            <label for="">Nama Siswa : </label>
            <input type="hidden" class="form-control id_transaksi" id="id_transaksi" name="id_transaksi" value="<?= 
            $transaksi['id_transaksi']; ?>">
            <select class="form-control select2bs4" id="select_siswa" name="siswa_id" style="width: 100%;">
               <option value="0" hidden>-Pilih Siswa-</option>
               <?php foreach ($siswa as $row) {?>
               <option value="<?= $row['id_siswa']; ?>" <?= ($row['id_siswa']==$transaksi['siswa_id']) ? 'selected' : '' ; ?>><b><?= $row['nis']; ?></b> | <?= $row['nama_siswa']; ?></option>
               <?php } ?>
            </select>

            <div class="invalid-feedback erNama">
            </div>
         </div>
         <div class="form-group">
            <label for="saldo">Saldo</label>
            <input type="text" name="saldo" id="saldo" readonly class="form-control" value="<?= $saldo; ?>">
         </div>
         <div class="form-group">
            <label id="labeljenis"></label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required value="<?= 
            $transaksi['tanggal_transaksi']; ?>">
            <div class="invalid-feedback erTg">
            </div>
         </div>
         <div class="form-group">
            <label id="labeljenis">Jumlah Traksaksi</label>
            <input type="text" name="jumlah_transaksi" id="jumlah_transaksi" class="form-control" required value="<?= 
            $transaksi['jumlah_transaksi']; ?>">
            <div class="invalid-feedback erJt">
            </div>
         </div>
         <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= 
            $transaksi['keterangan']; ?>">
         </div>
      </div>
      <div class="card-footer">
         <button type="button" onclick="submit()" class="btn btn-submit btn-info"><i class="fa fa-upload"></i> Update</button>
      </div>
   </form>
</div>

<?= $this->endSection('isi'); ?>


<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {
      // $('#form').hide();
      tampilform();
      bgheader();

      $('#saldo').val(rupiah("<?= $saldo; ?>"));
   });

   var jenis;
   var saldo;
   var save_method;

   function tampilform() {
      $('#form').show();
   }

   function bgheader() {
      var jenis_transaksi = "<?= $transaksi['jenis_transaksi']; ?>"
      if (jenis_transaksi == 'setor') {
         $('.card-header').addClass('bg-info');
      } else {
         $('.card-header').addClass('bg-maroon');
      }
   }


   const rupiah = (number) => {
      return new Intl.NumberFormat("id-ID", {
         style: "currency",
         currency: "IDR"
      }).format(number);
   }


   function lihatsaldo() {
      var id_siswa = $("#select_siswa").val();
      // console.log(id_siswa);
      $.ajax({
         url: "<?= base_url('admin/transaksi/show_saldo'); ?>/" + id_siswa,
         type: "GET",
         dataType: "JSON",
         success: function (data) {
            $('#saldo').val(rupiah(data.saldo_siswa));
            saldo = data.saldo_siswa;
            // console.log(saldo)

            $('#jumlah_transaksi').attr("disabled", false);
         },
         error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            alert('Gagal memuat data');
         }
      });
   }
   $("#select_siswa").change(function () {
      lihatsaldo();
      // console.log($('#select_siswa :selected').text());
   });

   $('#jumlah_transaksi').keyup(function () {

      var jt = $(this).val();
      // console.log(jt)
      if (jt > saldo && jenis !== 'setor') {
         $(this).addClass('is-invalid');
         $('.erJt').html('traksaksi melebihi saldo');
         $('.btn-submit').attr("disabled", true);
      } else {
         $(this).removeClass('is-invalid');
         $('.erJt').html('');
         $('.btn-submit').attr("disabled", false);
      }
   });

   function submit() {
      tampilform();
   }
</script>
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

   function kembali() {
      window.location.href = "<?= base_url('admin/transaksi'); ?>";
   }
</script>
<?= $this->endSection('js'); ?>