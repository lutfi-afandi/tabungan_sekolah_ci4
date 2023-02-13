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
         <button id="tambah_petugas" onclick="tambah_petugas()" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> tambah petugas</button>
      </div>
   </div>
   <div class="card-body">
      <div class="listpetugas table-responsive"></div>

   </div>
</div>


<!-- Modal -->
<?php foreach ($petugas as $row) {?>
<div class="modal fade" id="modalfoto<?= $row['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Foto <?= $row['nama_petugas']; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <img src="<?= base_url('public/foto_petugas/'.$row['foto_petugas']); ?>" alt="" class="img img-fluid">
         </div>
         <div class="modal-footer">

         </div>
      </div>
   </div>
</div>
<?php } ?>



<?= $this->endSection('isi'); ?>

<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {
      listpetugas();



   });

   function listpetugas() {
      $.ajax({
         url: "<?= base_url('admin/petugas/get_data_petugas') ?>",
         dataType: "json",
         success: function (response) {
            $('.listpetugas').html(response.data);
         }
      });
   }

   function tambah_petugas() {
      window.location.href = '<?= base_url(); ?>/admin/petugas/add';
   }



   function editpetugas(parameter_id) {
      save_method = 'edit';
      window.location.href = '<?= base_url(); ?>/admin/petugas/add/' + parameter_id;
   }


   function hapuspetugas(parameter_id) {
      var nama = $('.bhapus').attr('data-namapetugas');
      console.log(parameter_id);
      Swal.fire({
         title: 'Apakah yakin?',
         text: "Hapus petugas " + nama,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus'
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: "<?= base_url('admin/petugas/hapus') ?>/" + parameter_id,
               dataType: "json",
               success: function (response) {
                  Swal.fire(
                     'Berhasil!',
                     response.pesan,
                     'success'
                  )
                  listpetugas();
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