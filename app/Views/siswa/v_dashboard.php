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
   <div class="col-sm-6">
      <div class="small-box bg-primary" data-aos="fade-up" data-aos-duration="1000">
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
</div>

<button class="btn bg-gradient-navy btn-flat mb-2" id="cetak" onclick="cetak()"><i class="fa fa-print"></i> Cetak Histori</button>
<div class="row">
   <div class="col-sm-12">
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-sm" style="width: 100%;" id="example1">
            <thead class="bg-gradient-navy">
               <tr class="text-nowrap">
                  <th class="text-center" style="width: 5%;">No</th>
                  <th>Tanggal</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Setoran</th>
                  <th>Penarikan</th>
                  <th>Keterangan</th>
                  <th>Petugas</th>
               </tr>
            </thead>
            <tbody>
               <?php $no=1;
               foreach ($tabungan_siswa as $item) {?>
               <?php if($item['jenis_transaksi']=='setor'){
                  $bg = '#defff1';
                  $icon = '<i class="fa fa-file-upload text-info"></i>';
               } else{
                  $bg = '#feeeea';
                  $icon = '<i class="fa fa-file-download text-maroon"></i>';
               } ?>
               <tr style="background-color: <?= $bg; ?>;">
                  <th class="text-center"><?= $no++." ".$icon; ?></th>
                  <td><?= date('d/M/Y', strtotime($item['tanggal_transaksi'])); ?></td>
                  <td><?= $item['nis']; ?></td>
                  <td><?= $item['nama_siswa']; ?></td>
                  <td><?= $item['nama_kelas']; ?></td>
                  <td class="text-nowrap">
                     <?= ($item['jenis_transaksi']=='setor')? buatRupiah($item['jumlah_transaksi']). " ": "Rp. -"; ?>
                  </td>
                  <td class="text-nowrap">
                     <?= ($item['jenis_transaksi']=='tarik')? buatRupiah($item['jumlah_transaksi']). " ": "Rp. -" ?>
                  </td>
                  <td><?= $item['keterangan']; ?></td>
                  <td><?= $item['nama_petugas']; ?></td>
               </tr>
               <?php } ?>
            </tbody>
         </table>


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
   $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": false,
      lengthMenu: [
         [25, 50, -1],
         [25, 50, 'All'],
      ],
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