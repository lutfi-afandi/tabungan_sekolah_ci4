<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
Manajemen Data Kelas
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card ">
   <div class="card-header bg-gradient-orange">
      <div class="card-tools">
         <button id="tambah_kelas" onclick="tambah_kelas()" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> tambah kelas</button>
      </div>
   </div>
   <div class="card-body">
      <div class="listkelas"></div>

   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalkelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="#" id="form">
            <div class="modal-body">
               <div class="form-group">
                  <label for="">Nama Kelas : <sup class="text-danger">*</sup></label>
                  <input type="hidden" class="form-control id_kelas" id="id_kelas" name="id_kelas" required>
                  <input type="text" class="form-control nama_kelas" name="nama_kelas" id="nama_kelas" required>
                  <div class="invalid-feedback erNama">
                  </div>
               </div>
            </div>
         </form>
         <div class="modal-footer">
            <button type="button" onclick="submit()" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>


<?= $this->endSection('isi'); ?>

<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {
      listkelas();
   });

   function listkelas() {
      $.ajax({
         url: "<?= base_url('admin/kelas/get_data_kelas') ?>",
         dataType: "json",
         success: function (response) {
            $('.listkelas').html(response.data);
         }
      });
   }

   function tambah_kelas() {
      save_method = 'add';
      $('#modalkelas').modal('show');
      $('.modal-title').text('Tambah Kelas');
   }



   function editkelas(parameter_id) {
      save_method = 'edit';
      $('#nama_kelas').removeClass('is-invalid');
      $('.erNama').html('');
      $.ajax({
         url: "<?= base_url('admin/kelas/show'); ?>/" + parameter_id,
         type: "GET",
         dataType: "JSON",
         success: function (data) {
            console.log(data);
            $('#modalkelas').modal('show');
            $('.modal-title').text('Edit Kelas ');
            $('#id_kelas').val(data.data.id_kelas);
            $('#nama_kelas').val(data.data.nama_kelas);
         },
         error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            alert('Gagal memuat data');
         }
      });
   }

   function submit() {
      var url;
      if (save_method == 'add') {
         url = "<?php echo base_url('admin/kelas/add_kelas') ?>";
         pesan = "menambah data!";
      } else {
         url = "<?php echo base_url('admin/kelas/edit_kelas') ?>";
         pesan = "mengubah data!";
      }

      // ajax adding data to database
      $.ajax({
         url: url,
         type: "POST",
         data: {
            id_kelas: $('[name="id_kelas"]').val(),
            nama_kelas: $('[name="nama_kelas"]').val(),
         },
         dataType: "JSON",
         success: function (response) {
            if (response.error) {
               if (response.error.nama_kelas) {
                  $('#nama_kelas').addClass('is-invalid');
                  $('.erNama').html(response.error.nama_kelas);
               } else {
                  $('#nama_kelas').removeClass('is-invalid');
                  $('.erNama').html('');
               }

            } else {
               // alert('berhasil ' + pesan);
               Toast.fire({
                  icon: 'success',
                  title: response.sukses
               })
               $('#modalkelas').modal('hide');
               $('#form')[0].reset();
               listkelas();
            }

         },
      });
   }

   function hapuskelas(parameter_id) {
      var nama = $('.bhapus').attr('data-namakelas');
      console.log(parameter_id);
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus kelas " + nama,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus'
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "<?= base_url('admin/kelas/hapus') ?>/" + parameter_id,
               dataType: "json",
               success: function (response) {
                  Swal.fire(
                     'Berhasil!',
                     response.pesan,
                     'success'
                  )
                  listkelas();
               }
            });
         }
      })
   }
</script>
<?= $this->endSection('js'); ?>