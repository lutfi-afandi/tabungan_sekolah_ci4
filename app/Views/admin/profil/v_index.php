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
   <div class="col-sm-4">
      <div class="card card-navy card-outline ">
         <div class="card-body box-profile">
            <div class="text-center">
               <img class="img img-fluid " style="width: 350px; height: 350px; origin-fit:cover" src="<?= base_url(); ?>/public/foto_petugas/<?= $petugas['foto_petugas']; ?>" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center"><?= $petugas['nama_petugas']; ?></h3>
            <p class="text-muted text-center"><?= ($petugas['role'] =='1') ? 'Administrator': 'Petugas'; ?></p>

            <a href="#" class="btn bg-navy btn-block" data-toggle="modal" data-target="#gantiFoto"><b>Ganti Foto</b></a>
         </div>

      </div>
      <!-- modal foto -->
      <div class="modal fade" id="gantiFoto" tabindex="-1" aria-labelledby="gantiFotoLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="gantiFotoLabel">Ganti Foto Profil</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form action="<?= base_url('admin/profil/update_foto/'.$petugas['id_petugas']); ?>" method="post" enctype="multipart/form-data">

                  <div class="modal-body">

                     <div class="input-group mb-3 ">
                        <div class="custom-file">
                           <label for="foto_petugas">Upload file foto</label>
                           <input type="file" name="foto_petugas" class="form-control" id="foto_petugas" required>
                        </div>
                     </div>
                     <?php if($petugas['foto_petugas']){ ?>
                     <center><img src="<?= base_url('public/foto_petugas/'.$petugas['foto_petugas']); ?>" id="preview" class="img img-fluid" width="350px"></center>
                     <?php }else{  ?>
                     <center>
                        <img src="<?= base_url('assets/img/avatar.png'); ?>" id="preview" class="img img-fluid" width="350px">
                     </center>
                     <?php }  ?>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" type="button" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>


   <div class="card card-primary card-outline col-8">
      <div class="card-header">
         <div class="card-tools">
            <button class="btn btn-sm bok bg-success" onclick="ok()"><i class="fa fa-check"></i> tutup</button>
            <button class="btn btn-sm bpen bg-navy" onclick="edit()"><i class="fa fa-pen"></i> edit</button>
         </div>
      </div>
      <div class="card-body box-profile">
         <form action="<?= base_url('admin/profil/update/'.$petugas['id_petugas']); ?>" class="form-horizontal">
            <?= csrf_field() ?>
            <div class="form-group row">
               <label class="col-4 col-form-label" for="nip">NIP</label>
               <div class="col-8">
                  <input id="id_petugas" name="id_petugas" type="hidden" class="form-control">
                  <input id="nip" name="nip" placeholder="NIP" type="text" readonly class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : ''; ?>" value="<?= $petugas['nip']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('nip'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="nama_petugas" class="col-4 col-form-label">Nama Lengkap</label>
               <div class="col-8">
                  <input id="nama_petugas" name="nama_petugas" placeholder="Nama Lengkap ..." type="text" required="required" class="form-control bedit <?= ($validation->hasError('nama_petugas')) ? 'is-invalid' : ''; ?>" value="<?= $petugas['nama_petugas']; ?>">
                  <div class="invalid-feedback ">
                     <?= $validation->getError('nama_petugas'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="jk_petugas" class="col-4 col-form-label">Jenis Kelamin</label>
               <div class="col-8">
                  <select id="jk_petugas" name="jk_petugas" required="required" class="form-control bedit <?= ($validation->hasError('jk_petugas')) ? 'is-invalid' : ''; ?>">
                     <option hidden>- Pilih Jenis Kelamin -</option>
                     <option value="LAKI-LAKI" <?= ($petugas['jk_petugas'] =="LAKI-LAKI") ? 'selected' : '' ;; ?>>LAKI-LAKI</option>
                     <option value="PEREMPUAN" <?= ($petugas['jk_petugas'] =="PEREMPUAN") ? 'selected' : '' ;; ?>>PEREMPUAN</option>
                  </select>
                  <div class="invalid-feedback">
                     <?= $validation->getError('jk_petugas'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="alamat_petugas" class="col-4 col-form-label">Alamat</label>
               <div class="col-8">
                  <textarea id="alamat_petugas" name="alamat_petugas" cols="40" rows="5" class="form-control bedit <?= ($validation->hasError('alamat_petugas')) ? 'is-invalid' : ''; ?>"><?= $petugas['alamat_petugas']; ?></textarea>
                  <div class="invalid-feedback">
                     <?= $validation->getError('alamat_petugas'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="kontak" class="col-4 col-form-label">Kontak </label>
               <div class="col-8">
                  <input id="kontak" name="kontak" placeholder="Kontak ... " type="text" required="required" class="form-control bedit <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>" value="<?= $petugas['kontak']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('kontak'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="username" class="col-4 col-form-label">Username</label>
               <div class="col-8">
                  <input id="username" name="username" placeholder="Username ... " type="text" readonly class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= $petugas['username']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('username'); ?>
                  </div>
               </div>
            </div>
      </div>
      <div class="card-footer">
         <button type="submit" class="bupdate btn bg-navy btn-block">Update</button>
         </form>
      </div>

   </div>
</div>

<?= $this->endSection('isi'); ?>
<?= $this->section('js'); ?>
<script>
   $(document).ready(() => {
      $('#foto_petugas').change(function () {
         const file = this.files[0];
         //   console.log(file);
         if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
               console.log(event.target.result);
               $('#preview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
         }
      });

      $('.form-control').attr('disabled', true);
      $('.bupdate').hide()
      $('.bok').hide()
   });
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
</script>
<script>
   function edit() {
      $('.bedit').removeAttr('disabled', true)
      $('.bupdate').show();
      $('.bok').show();
      $('.bpen').hide();
   }

   function ok() {
      $('.bedit').attr('disabled', true)
      $('.bupdate').hide();
      $('.bok').hide();
      $('.bpen').show();
   }
</script>
<?= $this->endSection('js'); ?>