<?= $this->extend('layout/main'); ?>


<?= $this->section('judul'); ?>
<?= $title; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>

<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<div class="card card-orange card-outline">
   <div class="card-header ">
      <div class="card-tools">
         <button id="back" onclick="back()" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> kembali</button>
      </div>
   </div>
   <div class="card-body">
      <form id="form" action="<?= base_url('admin/petugas/save'); ?>" method="POST" enctype="multipart/form-data">
         <?= csrf_field() ?>
         <div class="form-group row">
            <label class="col-4 col-form-label" for="nip">NIP<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="id_petugas" name="id_petugas" type="hidden" class="form-control">
               <input id="nip" name="nip" placeholder="NIP" type="text" required="required" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : ''; ?>" value="<?= old('nip'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('nip'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="nama_petugas" class="col-4 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="nama_petugas" name="nama_petugas" placeholder="Nama Lengkap ..." type="text" required="required" class="form-control <?= ($validation->hasError('nama_petugas')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_petugas'); ?>">
               <div class="invalid-feedback ">
                  <?= $validation->getError('nama_petugas'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="username" class="col-4 col-form-label">Username<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="username" name="username" placeholder="Username ... " type="text" required="required" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= old('username'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('username'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="password" class="col-4 col-form-label">Password<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="password" name="password" placeholder="Password" type="text" required="required" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" value="<?= old('password'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('password'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="jk_petugas" class="col-4 col-form-label">Jenis Kelamin<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <select id="jk_petugas" name="jk_petugas" required="required" class="custom-select <?= ($validation->hasError('jk_petugas')) ? 'is-invalid' : ''; ?>">
                  <option hidden>- Pilih Jenis Kelamin -</option>
                  <option value="LAKI-LAKI" <?= (old('jk_petugas') =="LAKI-LAKI") ? 'selected' : '' ;; ?>>LAKI-LAKI</option>
                  <option value="PEREMPUAN" <?= (old('jk_petugas') =="PEREMPUAN") ? 'selected' : '' ;; ?>>PEREMPUAN</option>
               </select>
               <div class="invalid-feedback">
                  <?= $validation->getError('jk_petugas'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="alamat_petugas" class="col-4 col-form-label">Alamat</label>
            <div class="col-8">
               <textarea id="alamat_petugas" name="alamat_petugas" cols="40" rows="5" class="form-control <?= ($validation->hasError('alamat_petugas')) ? 'is-invalid' : ''; ?>"><?= old('alamat_petugas'); ?></textarea>
               <div class="invalid-feedback">
                  <?= $validation->getError('alamat_petugas'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="kontak" class="col-4 col-form-label">Kontak ..</label>
            <div class="col-8">
               <input id="kontak" name="kontak" placeholder="Kontak ..  " type="text" class="form-control <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>" value="<?= old('kontak'); ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('kontak'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="role" class="col-4 col-form-label">Role<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <select id="role" name="role" required="required" class="custom-select <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?>">
                  <option hidden>- Pilih Role -</option>
                  <option value="1" <?= (old('role') =="1") ? 'selected' : '' ;; ?>>Administrator</option>
                  <option value="2" <?= (old('role') =="2") ? 'selected' : '' ;; ?>>Petugas</option>
               </select>
               <div class="invalid-feedback">
                  <?= $validation->getError('role'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="foto_petugas" class="col-4 col-form-label">Foto</label>
            <div class="col-8">
               <input type="file" id="foto_petugas" name="foto_petugas" class="form-control <?= ($validation->hasError('foto_petugas')) ? 'is-invalid' : ''; ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('foto_petugas'); ?>
               </div>
               <div class="preview">
                  <img src="<?= base_url() ?>/img/admin.png" id="preview" class="img img-thumbnail mt-2" width="250px" height="250px">
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
      $('#foto_petugas').change(function () {
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
      window.location.href = "<?= base_url('admin/petugas'); ?>";
   }
</script>
<?= $this->endSection('js'); ?>