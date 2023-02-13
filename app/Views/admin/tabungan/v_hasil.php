<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>
<?php 
function buatRupiah($angka){
   $hasil = "Rp. " . number_format($angka,2,',','.');
   return $hasil;
}
 ?>

<?= $this->section('isi'); ?>
<div class="alert alert-success ">
   <p class="mb-1"><i class="icon fas fa-info"></i> Informasi Tabungan!</p>
   <div class="row">
      <dt class="col-sm-3">Total Setoran &emsp;:</dt>
      <dd class="col-sm-9"><?= buatRupiah($total_setoran); ?></dd>
      <dt class="col-sm-3">Total Penarikan &emsp;:</dt>
      <dd class="col-sm-9"><?= buatRupiah($total_penarikan); ?></dd>

   </div>
   <h3 class="font-weight-bold">Saldo : <?= buatRupiah($total_saldo); ?></h3>
</div>
<div class="card card-outline card-navy">
   <div class="card-header">
      <button href="" class="btn btn-sm bg-maroon" onclick="back()"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button href="" class="btn btn-sm btn-success " onclick="cetak_tabungan()"><i class="fa fa-print"></i> Cetak</button>
      <h5 id="saldo_total"></h5>

   </div>
   <div class="card-body">
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

   <div class="card-footer">

   </div>

</div>


<?= $this->endSection('isi'); ?>


<?= $this->section('js'); ?>
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
   $(document).ready(function () {
      // listtransaksi();
   });
   $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
         theme: 'bootstrap4',
         // dropdownParent: $('#modaltransaksi')
      })
   })

   function listtransaksi() {
      $.ajax({
         url: "<?= base_url('admin/tabungan/get_data_transaksi') ?>",
         dataType: "json",
         success: function (response) {
            $('.listtransaksi').html(response.data);
         }
      });
   }



   var jenis;
   var saldo;
   var save_method;

   const rupiah = (number) => {
      return new Intl.NumberFormat("id-ID", {
         style: "currency",
         currency: "IDR"
      }).format(number);
   }



   $("#select_siswa").change(function () {
      var id_siswa = $("#select_siswa").val();
      // console.log(id_siswa);
      $('#cari').attr('disabled', false);
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
      var url;
      if (save_method == 'add') {
         url = "<?php echo base_url('admin/transaksi/add_transaksi') ?>";
         pesan = "menambah data!";
      } else {
         url = "<?php echo base_url('admin/transaksi/edit_transaksi') ?>";
         pesan = "mengubah data!";
      }

      // ajax adding data to database
      $.ajax({
         url: url,
         type: "POST",
         data: {
            id_transaksi: $('[name="id_transaksi"]').val(),
            jumlah_transaksi: $('[name="jumlah_transaksi"]').val(),
            tanggal_transaksi: $('[name="tanggal_transaksi"]').val(),
            siswa_id: $('[name="siswa_id"]').val(),
            keterangan: $('[name="keterangan"]').val(),
            jenis_transaksi: jenis,

         },
         dataType: "JSON",
         success: function (response) {
            if (response.error) {
               if (response.error.siswa_id) {
                  $('#siswa_id').addClass('is-invalid');
                  $('.erNama').html(response.error.siswa_id);
               } else {
                  $('#siswa_id').removeClass('is-invalid');
                  $('.erNama').html('');
               }
               if (response.error.jumlah_transaksi) {
                  $('#jumlah_transaksi').addClass('is-invalid');
                  $('.erJt').html(response.error.jumlah_transaksi);
               } else {
                  $('#jumlah_transaksi').removeClass('is-invalid');
                  $('.erJt').html('');
               }
               if (response.error.tanggal_transaksi) {
                  $('#tanggal_transaksi').addClass('is-invalid');
                  $('.erTg').html(response.error.tanggal_transaksi);
               } else {
                  $('#tanggal_transaksi').removeClass('is-invalid');
                  $('.erTg').html('');
               }

            } else {
               // alert('berhasil ' + pesan);
               Toast.fire({
                  icon: 'success',
                  title: response.sukses
               })
               $('#modaltransaksi').modal('hide');
               $('#form')[0].reset();
               listtransaksi();
            }

         },
      });
   }

   function hapustransaksi(parameter_id) {
      var nama = $('.bhapus').attr('data-namatransaksi');
      console.log(parameter_id);
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus transaksi " + nama + " ini?",
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus'
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "<?= base_url('admin/transaksi/hapus') ?>/" + parameter_id,
               dataType: "json",
               success: function (response) {
                  Swal.fire(
                     'Berhasil!',
                     response.pesan,
                     'success'
                  )
                  listtransaksi();
               }
            });
         }
      })
   }
</script>

<script>
   // TABUNGAN
   function search() {
      var id_siswa = $("#select_siswa").val();
      if (id_siswa == 0 || id_siswa == undefined) {
         $('#cari').attr('disabled', true);
         Toast.fire({
            position: 'top',
            icon: 'error',
            title: 'Pilih siswa dulu',
            timer: 3000,
         })
      } else {
         window.location.href = "<?php echo base_url('admin/tabungan/search') ?>/" + id_siswa;
      }

   }

   function cetak_tabungan() {
      v_print = "<?php echo base_url('admin/tabungan/print/'.$id_siswa) ?>";
      window.open(v_print, '_blank');
   }

   function back() {
      window.location.href = "<?php echo base_url('admin/tabungan/') ?>";

   }
</script>
<?= $this->endSection('js'); ?>