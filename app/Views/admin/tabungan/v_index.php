<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card card-outline card-navy">
   <div class="card-header">

      <h5 id="saldo_total"></h5>

   </div>
   <div class="card-body">
      <form action="#" id="form">
         <div class="modal-body">
            <div class="form-group">
               <label for="">Nama Siswa : </label>
               <input type="hidden" class="form-control id_transaksi" id="id_transaksi" name="id_transaksi" required>
               <select class="form-control select2bs4" id="select_siswa" name="siswa_id" style="width: 100%;">
                  <option value="0" hidden>-Pilih Siswa-</option>
                  <?php foreach ($siswa as $row) {?>
                  <option value="<?= $row['id_siswa']; ?>"><b><?= $row['nis']; ?></b> | <?= $row['nama_siswa']; ?></option>
                  <?php } ?>
               </select>
               <div class="invalid-feedback erNama">
               </div>
            </div>
            <div class="form-group">
               <label for="saldo">Saldo</label>
               <input type="text" name="saldo" id="saldo" readonly class="form-control">
            </div>
         </div>
      </form>

   </div>

   <div class="card-footer">
      <button class="btn btn-primary" id="cari" onclick="search()"><i class="fa fa-search"></i> cari</button>
   </div>

</div>


<?= $this->endSection('isi'); ?>


<?= $this->section('js'); ?>
<script>

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
</script>
<?= $this->endSection('js'); ?>