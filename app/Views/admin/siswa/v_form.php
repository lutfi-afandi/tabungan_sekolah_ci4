<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card card-orange card-outline">
   <div class="card-header ">
      <small class="card-title text-danger text-sm">* wajib diisi!</small>
      <div class="card-tools">
         <button id="back" onclick="back()" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i>
            kembali</button>
      </div>
   </div>
   <div class="card-body">
      <form id="form" action="<?= base_url('admin/siswa/save'); ?>" method="POST" enctype="multipart/form-data">
         <?= csrf_field() ?>
         <div class="form-group row">
            <label class="col-4 col-form-label" for="nis">NIS <sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="id_siswa" name="id_siswa" type="hidden" class="form-control">
               <input id="nis" name="nis" placeholder="NIS" type="text" required
                  class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>"
                  value="<?= old('nis'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('nis'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="username" class="col-4 col-form-label">Username<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="username" name="username" placeholder="Username ... " type="text" required="required"
                  class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"
                  value="<?= old('username'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('username'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="password" class="col-4 col-form-label">Password<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="password" name="password" placeholder="Password" type="text"
                  class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                  value="<?= old('password'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('password'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="nama_siswa" class="col-4 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap ..." type="text" required="required"
                  class="form-control <?= ($validation->hasError('nama_siswa')) ? 'is-invalid' : ''; ?>"
                  value="<?= old('nama_siswa'); ?>">
               <div class="invalid-feedback ">
                  <?= $validation->getError('nama_siswa'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="kelas_id" class="col-4 col-form-label">Kelas<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <select id="kelas_id" name="kelas_id" required="required"
                  class="custom-select <?= ($validation->hasError('kelas_id')) ? 'is-invalid' : ''; ?>">
                  <option value="" hidden>- Pilih Kelas -</option>
                  <?php foreach ($kelas as $row) { ?>
                  <option value="<?= $row['id_kelas']; ?>"
                     <?= (old('kelas_id') ==$row['id_kelas']) ? 'selected' : '' ;; ?>><?= $row['nama_kelas']; ?>
                  </option>
                  <?php } ?>
               </select>
               <div class="invalid-feedback">
                  <?= $validation->getError('kelas_id'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label value="" for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin<sup
                  class="text-danger">*</sup></label>
            <div class="col-8">
               <select id="jenis_kelamin" name="jenis_kelamin" required="required"
                  class="custom-select <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>">
                  <option value="" hidden>- Pilih Jenis Kelamin -</option>
                  <option value="LAKI-LAKI" <?= (old('jenis_kelamin') =="LAKI-LAKI") ? 'selected' : '' ;; ?>>LAKI-LAKI
                  </option>
                  <option value="PEREMPUAN" <?= (old('jenis_kelamin') =="PEREMPUAN") ? 'selected' : '' ;; ?>>PEREMPUAN
                  </option>
               </select>
               <div class="invalid-feedback">
                  <?= $validation->getError('jenis_kelamin'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="alamat_siswa" class="col-4 col-form-label">Alamat</label>
            <div class="col-8">
               <textarea id="alamat_siswa" name="alamat_siswa" cols="40" rows="5"
                  class="form-control <?= ($validation->hasError('alamat_siswa')) ? 'is-invalid' : ''; ?>"><?= old('alamat_siswa'); ?></textarea>
               <div class="invalid-feedback">
                  <?= $validation->getError('alamat_siswa'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="nama_ortu" class="col-4 col-form-label">Nama Wali Siswa</label>
            <div class="col-8">
               <input id="nama_ortu" name="nama_ortu" placeholder="Nama Wali Siswa ... " type="text"
                  class="form-control <?= ($validation->hasError('nama_ortu')) ? 'is-invalid' : ''; ?>"
                  value="<?= old('nama_ortu'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('nama_ortu'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="kontak" class="col-4 col-form-label">Kontak Wali Siswa</label>
            <div class="col-8">
               <input id="kontak" name="kontak" placeholder="Kontak Wali Siswa ... " type="text"
                  class="form-control ikontak <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>"
                  value="<?= old('kontak'); ?>">
               <div class="invalid-feedback erKontak">
                  <?= $validation->getError('kontak'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="foto_siswa" class="col-4 col-form-label">Foto</label>
            <div class="col-8">
               <input type="file" id="foto_siswa" name="foto_siswa"
                  class="form-control <?= ($validation->hasError('foto_siswa')) ? 'is-invalid' : ''; ?>"
                  accept="image/*">
               <div class="invalid-feedback">
                  <?= $validation->getError('foto_siswa'); ?>
               </div>
               <div class="preview">
                  <img src="<?= base_url() ?>/img/user.png" id="preview" class="img img-thumbnail mt-2" width="250px"
                     height="250px">
               </div>
            </div>
         </div>
   </div>
   <div class="card-footer">
      <button id="button" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
   </div>
   </form>
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
               // console.log(event.target.result);
               $('#preview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
         }
      });
   });

   "<?php if (session()->getFlashdata('swal_icon')) { ?>"
   Swal.fire({
      icon: "<?= session()->getFlashdata('swal_icon'); ?>",
      title: "<?= session()->getFlashdata('swal_title'); ?>",
      text: "<?= session()->getFlashdata('swal_text'); ?>",
      showConfirmButton: false,
      timer: 1500
   })
   "<?php } ?>"


   //  Kembali
   function back() {
      window.location.href = "<?= base_url('admin/siswa'); ?>";
   }

   $(".ikontak").change(function () {
      var kontak = $(".ikontak").val();
      console.log(kontak);
      var jumlahkarakter = kontak.length;
      if (jumlahkarakter < 10) {
         $(".erKontak").text("jumlah nomor kurang dari 10 digit");
         $(".ikontak").addClass("is-invalid");
      } else {
         $(".ikontak").removeClass("is-invalid");
      }
   });
</script>
<?= $this->endSection('js'); ?>