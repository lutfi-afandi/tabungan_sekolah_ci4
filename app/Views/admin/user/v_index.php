<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
Manajemen Data Admin
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card ">
   <div class="card-header bg-gradient-orange">
      <div class="card-tools">
         <button id="tambah_user" onclick="tambah_user()" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> tambah user</button>
      </div>
   </div>
   <div class="card-body">
      <div class="listuser"></div>

   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <label for="">Nama User : </label>
                  <input type="hidden" class="form-control id" id="id" name="id" required>
                  <input type="text" class="form-control nama_user" name="nama_user" id="nama_user" required>
                  <div class="invalid-feedback erNama">
                  </div>
               </div>
               <div class="form-group">
                  <label for="">Username : </label>
                  <input type="text" class="form-control username" name="username" id="username" required>
                  <div class="invalid-feedback erUser">
                  </div>
               </div>
               <div class="form-group">
                  <label for="">Password : </label>
                  <input type="text" class="form-control password" name="password" id="password" required>
                  <div class="invalid-feedback erPass">
                  </div>
               </div>
            </div>
         </form>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="submit()">Simpan</button>
         </div>
      </div>
   </div>
</div>


<?= $this->endSection('isi'); ?>

<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {
      listuser();
   });
   var save_method;

   function listuser() {
      $.ajax({
         url: "<?= base_url('admin/user/get_data_user') ?>",
         dataType: "json",
         success: function (response) {
            $('.listuser').html(response.data);
         }
      });
   }

   function tambah_user() {
      save_method = 'add';
      $('#modaluser').modal('show');
      $('.modal-title').text('Tambah User');
   }

   function edituser(parameter_id) {
      console.log(parameter_id);
   }

   function reset_password(parameter_id) {
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus ingin mereset password?",
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus'
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "<?= base_url('admin/user/reset') ?>/" + parameter_id,
               dataType: "json",
               success: function (response) {
                  Swal.fire(
                     'Berhasil!',
                     response.pesan,
                     'success'
                  )
                  listuser();
               }
            });
         }
      })
   }

   function submit() {
      var url;
      if (save_method == 'add') {
         url = "<?php echo base_url('admin/user/add_user') ?>";
         pesan = "menambah data!";
      } else {
         url = "<?php echo base_url('admin/user/edit_user') ?>";
         pesan = "mengubah data!";
      }

      // ajax adding data to database
      $.ajax({
         url: url,
         type: "POST",
         data: {
            nama_user: $('[name="nama_user"]').val(),
            username: $('[name="username"]').val(),
            password: $('[name="password"]').val(),
         },
         dataType: "JSON",
         success: function (response) {
            if (response.error) {
               if (response.error.nama_user) {
                  $('#nama_user').addClass('is-invalid');
                  $('.erNama').html(response.error.nama_user);
               } else {
                  $('#nama_user').removeClass('is-invalid');
                  $('.erNama').html('');
               }
               if (response.error.username) {
                  $('#username').addClass('is-invalid');
                  $('.erUser').html(response.error.username);
               } else {
                  $('#username').removeClass('is-invalid');
                  $('.erUser').html('');
               }
               if (response.error.password) {
                  $('#password').addClass('is-invalid');
                  $('.erPass').html(response.error.password);
               } else {
                  $('#password').removeClass('is-invalid');
                  $('.erPass').html('');
               }

            } else {
               // alert('berhasil ' + pesan);
               Toast.fire({
                  icon: 'success',
                  title: response.sukses
               })
               $('#modaluser').modal('hide');
               $('#form')[0].reset();
               listuser();
            }

         },
      });
   }

   function hapususer(parameter_id) {
      var nama = $('.bhapus').attr('data-namauser');
      console.log(parameter_id);
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus user " + nama,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus'
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "<?= base_url('admin/user/hapus') ?>/" + parameter_id,
               dataType: "json",
               success: function (response) {
                  Swal.fire(
                     'Berhasil!',
                     response.pesan,
                     'success'
                  )
                  listuser();
               }
            });
         }
      })
   }
</script>
<?= $this->endSection('js'); ?>