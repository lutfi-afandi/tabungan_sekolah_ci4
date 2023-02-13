<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card ">
   <div class="card-header bg-gradient-orange">
      <div class="card-tools">
         <button id="tambah_siswa" onclick="tambah_siswa()" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> tambah siswa</button>
      </div>
   </div>
   <div class="card-body">
      <div class="listsiswa table-responsive"></div>

   </div>
</div>



<?= $this->endSection('isi'); ?>

<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {
      listsiswa();
   });

   function listsiswa() {
      $.ajax({
         url: "<?= base_url('admin/siswa/get_data_siswa') ?>",
         dataType: "json",
         success: function (response) {
            $('.listsiswa').html(response.data);
         }
      });

   }

   function tambah_siswa() {
      window.location.href = '<?= base_url(); ?>/admin/siswa/add';
   }



   function editsiswa(parameter_id) {
      save_method = 'edit';
      window.location.href = '<?= base_url(); ?>/admin/siswa/add/' + parameter_id;
   }


   function hapussiswa(parameter_id, parameter_nama, parameter_nis) {
      var nama = $('.bhapus').attr('data-namasiswa');
      // console.log(parameter_nama);
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus siswa [" + parameter_nis + "] " + parameter_nama,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus'
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "<?= base_url('admin/siswa/hapus') ?>/" + parameter_id,
               dataType: "json",
               success: function (response) {
                  Swal.fire(
                     'Berhasil!',
                     response.pesan,
                     'success'
                  )
                  listsiswa();
               }
            });
         }
      })
   }

   // notif data baru
   "<?php if (session()->getFlashdata('swal_icon')) { ?>"
   Swal.fire({
      icon: "<?= session()->getFlashdata('swal_icon'); ?>",
      title: "<?= session()->getFlashdata('swal_title'); ?>",
      text: "<?= session()->getFlashdata('swal_text'); ?>",
      timer: 2500,
   })
   "<?php } ?>"
</script>
<?= $this->endSection('js'); ?>