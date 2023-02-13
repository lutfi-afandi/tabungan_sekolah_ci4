<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card card-outline card-navy">
   <div class="card-header">
      <button href="" class="btn btn-sm btn-info" onclick="msetoran()"><i class="fa fa-upload"></i> Setoran</button>
      <button href="" class="btn btn-sm bg-maroon " onclick="mtarik()"><i class="fa fa-download"></i> Penarikan</button>
   </div>
   <div class="card-body">
      <div class="listtransaksi table-responsive"></div>

   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modaltransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content ">
         <div class="modal-header py-2">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="#" id="form">
            <div class="modal-body">
               <div class="form-group">
                  <label for="">Nama Siswa : </label>
                  <input type="hidden" class="form-control id_transaksi" id="id_transaksi" name="id_transaksi" required>
                  <select class="form-control select2bs4" id="select_siswa" name="siswa_id" style="width: 100%;">
                     <option value="" hidden>-Pilih Siswa-</option>
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
               <div class="form-group">
                  <label id="labeltanggal"></label>
                  <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
                  <div class="invalid-feedback erTg">
                  </div>
               </div>
               <div class="form-group">
                  <label id="labeljenis"></label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                     </div>
                     <input type="text" name="jumlah_transaksi" id="jumlah_transaksi" class="form-control" required disabled>
                     <div class="invalid-feedback erJumlah">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" name="keterangan" id="keterangan" class="form-control">
               </div>
            </div>
         </form>
         <div class="modal-footer">
            <button type="button" onclick="submit()" class="btn btn-submit"></button>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection('isi'); ?>


<?= $this->section('js'); ?>
<script>
</script>
<script>
   $(document).ready(function () {
      listtransaksi();
   });
   $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
         theme: 'bootstrap4',
         dropdownParent: $('#modaltransaksi')
      })
   })

   function listtransaksi() {
      $.ajax({
         url: "<?= base_url('admin/transaksi/get_data_transaksi') ?>",
         dataType: "json",
         success: function (response) {
            $('.listtransaksi').html(response.data);
         }
      });
   }

   var jenis;
   var saldo;
   var save_method;

   function msetoran() {
      jenis = 'setor';
      save_method = 'add';
      $('#form')[0].reset();
      $('#modaltransaksi').modal('show');
      $('.modal-title').text('Tambah Setoran');
      $('#labeljenis').text('Jumlah Setoran');
      $('#labeltanggal').text('Tanggal Setoran');
      $('.modal-header').addClass('bg-info');
      $('.btn-submit').addClass('bg-info'); //ini menambah class
      $('.form-group').removeClass('is-invalid'); //ini menambah class
      $('.invalid-feedback').html(''); //ini menambah class
      $('.btn-submit').empty(); // ini menghapus property
      $('.btn-submit').append('<i class="fa fa-upload"></i> Setor'); //ini menambah elemen
   }

   function mtarik() {
      jenis = 'tarik';
      save_method = 'add';
      $('#form')[0].reset();
      $('#modaltransaksi').modal('show');
      $('.modal-title').text('Tambah Penarikan');
      $('#labeljenis').text('Jumlah Penarikan');
      $('#labeltanggal').text('Tanggal Penarikan');
      $('.modal-header').addClass('bg-maroon');
      $('.btn-submit').addClass('bg-maroon');
      $('.form-group').removeClass('is-invalid'); //ini menambah class
      $('.invalid-feedback').html(''); //ini menambah class
      $('.btn-submit').empty();
      $('.btn-submit').append('<i class="fa fa-download"></i> Penarik');
   }

   function edittransaksi(parameter_id) { // Deklarasi
      window.location.href = "<?= base_url('admin/transaksi/show'); ?>/" + parameter_id;
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

   var tanpa_rupiah = document.getElementById('jumlah_transaksi');
   tanpa_rupiah.addEventListener('keyup', function (e) {
      tanpa_rupiah.value = buatMask(this.value);
   });

   function buatMask(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
         split = number_string.split(','),
         sisa = split[0].length % 3,
         rupiah = split[0].substr(0, sisa),
         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
         separator = sisa ? '.' : '';
         rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
   }

   // $('#jumlah_transaksi').keyup(function () {
   //    var jt = $(this).val();

   //    if (jt > saldo && jenis !== 'setor') {
   //       $(this).addClass('is-invalid');
   //       $('.erJumlah').html('traksaksi melebihi saldo');
   //       $('.btn-submit').attr("disabled", true);
   //    } else {
   //       $(this).removeClass('is-invalid');
   //       $('.erJumlah').html('');
   //       $('.btn-submit').attr("disabled", false);
   //    }
   // });



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
               console.log(response.error.jumlah_transaksi);
               console.log(response.error.tanggal_transaksi);
               if (response.error.siswa_id) {
                  $('#siswa_id').addClass('is-invalid');
                  $('.erNama').html(response.error.siswa_id);
               } else {
                  $('#siswa_id').removeClass('is-invalid');
                  $('.erNama').html('');
               }
               if (response.error.tanggal_transaksi) {
                  $('#tanggal_transaksi').addClass('is-invalid');
                  $('.erTg').html(response.error.tanggal_transaksi);
               } else {
                  $('#tanggal_transaksi').removeClass('is-invalid');
                  $('.erTg').html('');
               }
               if (response.error.jumlah_transaksi) {
                  $('#jumlah_transaksi').addClass('is-invalid');
                  $('.erJumlah').html(response.error.jumlah_transaksi);
               } else {
                  $('#jumlah_transaksi').removeClass('is-invalid');
                  $('.erJumlah').html('');
               }

            } else {
               // alert('berhasil ' + pesan);
               Toast.fire({
                  icon: 'success',
                  title: response.sukses
               })
               $('#modaltransaksi').modal('hide');
               // $('#form')[0].reset();
               $(':input', '#form')
                  .val('')
                  .removeClass('is-invalid')
                  .removeAttr('checked')
                  .removeAttr('selected');
               listtransaksi();
            }

         },
      });
   }



   function hapustransaksi(parameter_id, parameter_nama, parameter_tanggal) {
      var judul = "\n" + parameter_nama + "\nTanggal : " + parameter_tanggal
      console.log(parameter_id);
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus transaksi " + judul + " ini?",
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
<?= $this->endSection('js'); ?>