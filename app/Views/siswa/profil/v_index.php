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

      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <form action="<?= base_url('siswa/password/gantis'); ?>" method="post">

                  <div class="form-group">
                     <label>Masukan Password Baru :</label>
                     <input type="" name="password" class=" <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" style="display: block;
                                 width: 100%;
                                 height: calc(2.25rem + 2px);
                                 padding: 0.375rem 0.75rem;
                                 font-size: 1rem;
                                 font-weight: 400;
                                 line-height: 1.5;
                                 color: #495057;
                                 background-color: #fff;
                                 background-clip: padding-box;
                                 border: 1px solid #ced4da;
                                 border-radius: 0.25rem;
                                 box-shadow: inset 0 0 0 transparent;">
                  </div>
                  <div class="invalid-feedback">
                     <?= $validation->getError('password'); ?>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn bg-success"><i class="fa fa-lock"></i> Update Password</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="card card-navy card-outline ">
         <div class="card-body box-profile">
            <div class="text-center">
               <?php if($siswa['foto_siswa']==null){
               $foto = 'img/siswa.png';
               }else{
                  $foto = 'public/foto_siswa/'.$siswa['foto_siswa'];
               } ?>
               <img class="img img-fluid " style="width: 350px; height: 350px; origin-fit:fill" src="<?= base_url($foto); ?>" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center"><?= $siswa['nama_siswa']; ?></h3>
            <p class="text-muted text-center"><?= ($siswa['role'] =='3') ? 'Siswa': ''; ?></p>

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
               <form action="<?= base_url('siswa/profil/update_foto/'.$siswa['id_siswa']); ?>" method="post" enctype="multipart/form-data">

                  <div class="modal-body">

                     <div class="input-group mb-3 ">
                        <div class="custom-file">
                           <label for="foto_siswa">Upload file foto</label>
                           <input type="file" name="foto_siswa" class="form-control ffoto" id="foto_siswa" required>
                        </div>
                     </div>
                     <?php if($siswa['foto_siswa']){ ?>
                     <center><img src="<?= base_url('public/foto_siswa/'.$siswa['foto_siswa']); ?>" id="preview" class="img img-fluid" width="350px"></center>
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


   <div class="card card-primary card-outline col-sm-8">
      <div class="card-header">
         <div class="card-tools">
         </div>
      </div>
      <div class="card-body box-profile">
         <form action="<?= base_url('siswa/profil/update/'.$siswa['id_siswa']); ?>" class="form-horizontal">
            <?= csrf_field() ?>

            <div class="form-group row">
               <label class="col-4 col-form-label" for="nis">NIS</label>
               <div class="col-8">
                  <input id="id_siswa" name="id_siswa" type="hidden" class="form-control">
                  <input id="nis" name="nis" placeholder="NIS" type="text" readonly class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['nis']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('nis'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="username" class="col-4 col-form-label">Username</label>
               <div class="col-8">
                  <input id="username" name="username" placeholder="Username ... " type="text" readonly class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['username']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('username'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="nama_siswa" class="col-4 col-form-label">Nama Lengkap</label>
               <div class="col-8">
                  <input id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap ..." type="text" required="required" class="form-control bedit <?= ($validation->hasError('nama_siswa')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['nama_siswa']; ?>">
                  <div class="invalid-feedback ">
                     <?= $validation->getError('nama_siswa'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
               <div class="col-8">
                  <select id="jenis_kelamin" name="jenis_kelamin" required="required" class="form-control bedit <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>">
                     <option hidden>- Pilih Jenis Kelamin -</option>
                     <option value="LAKI-LAKI" <?= ($siswa['jenis_kelamin'] =="LAKI-LAKI") ? 'selected' : '' ;; ?>>LAKI-LAKI</option>
                     <option value="PEREMPUAN" <?= ($siswa['jenis_kelamin'] =="PEREMPUAN") ? 'selected' : '' ;; ?>>PEREMPUAN</option>
                  </select>
                  <div class="invalid-feedback">
                     <?= $validation->getError('jenis_kelamin'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="alamat_siswa" class="col-4 col-form-label">Alamat</label>
               <div class="col-8">
                  <textarea id="alamat_siswa" name="alamat_siswa" cols="40" rows="3" class="form-control bedit <?= ($validation->hasError('alamat_siswa')) ? 'is-invalid' : ''; ?>"><?= $siswa['alamat_siswa']; ?></textarea>
                  <div class="invalid-feedback">
                     <?= $validation->getError('alamat_siswa'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="nama_ortu" class="col-4 col-form-label">Nama Orang Tua </label>
               <div class="col-8">
                  <input id="nama_ortu" name="nama_ortu" placeholder="Kontak ... " type="text" required="required" class="form-control bedit <?= ($validation->hasError('nama_ortu')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['nama_ortu']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('nama_ortu'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="kontak" class="col-4 col-form-label">Kontak </label>
               <div class="col-8">
                  <input id="kontak" name="kontak" placeholder="Kontak ... " type="text" required="required" class="form-control bedit <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['kontak']; ?>">
                  <div class="invalid-feedback">
                     <?= $validation->getError('kontak'); ?>
                  </div>
               </div>
            </div>
            <button type="submit" class="bupdate btn bg-navy btn-block">Update</button>
      </div>
      </form>

   </div>
</div>

<?= $this->endSection('isi'); ?>
<?= $this->section('js'); ?>
<script>
   $(document).ready(() => {
      $('#foto_siswa').change(function () {
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

</script>
<?= $this->endSection('js'); ?>