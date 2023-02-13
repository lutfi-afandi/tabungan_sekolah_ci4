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
      <form id="form" action="<?= base_url('admin/siswa/update/'.$siswa['id_siswa']); ?>" method="POST" enctype="multipart/form-data">
         <?= csrf_field() ?>
         <div class="form-group row">
            <label class="col-4 col-form-label" for="nis">NIS<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="id_siswa" name="id_siswa" type="hidden" class="form-control">
               <input id="nis" name="nis" placeholder="NIS" type="text" readonly class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['nis']; ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('nis'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="username" class="col-4 col-form-label">Username<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="username" name="username" placeholder="Username ... " type="text" readonly class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['username']; ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('username'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="nama_siswa" class="col-4 col-form-label">Nama Lengkap<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <input id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap ..." type="text" required="required" class="form-control <?= ($validation->hasError('nama_siswa')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['nama_siswa']; ?>">
               <div class="invalid-feedback ">
                  <?= $validation->getError('nama_siswa'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="kelas_id" class="col-4 col-form-label">Kelas<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <select id="kelas_id" name="kelas_id" required="required" class="custom-select <?= ($validation->hasError('kelas_id')) ? 'is-invalid' : ''; ?>">
                  <option hidden>- Pilih Kelas -</option>
                  <?php foreach ($kelas as $row) { ?>
                  <option value="" value="<?= $row['id_kelas']; ?>" <?= ($siswa['kelas_id'] ==$row['id_kelas']) ? 'selected' : '' ;; ?>><?= $row['nama_kelas']; ?></option>
                  <?php } ?>
               </select>
               <div class="invalid-feedback">
                  <?= $validation->getError('kelas_id'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin<sup class="text-danger">*</sup></label>
            <div class="col-8">
               <select id="jenis_kelamin" name="jenis_kelamin" required="required" class="custom-select <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>">
                  <option value="" hidden>- Pilih Jenis Kelamin -</option>
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
               <textarea id="alamat_siswa" name="alamat_siswa" cols="40" rows="3" class="form-control <?= ($validation->hasError('alamat_siswa')) ? 'is-invalid' : ''; ?>"><?= $siswa['alamat_siswa']; ?></textarea>
               <div class="invalid-feedback">
                  <?= $validation->getError('alamat_siswa'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="nama_ortu" class="col-4 col-form-label">Nama Wali Siswa</label>
            <div class="col-8">
               <input id="nama_ortu" name="nama_ortu" placeholder="Nama Wali Siswa ... " type="text" class="form-control <?= ($validation->hasError('nama_ortu')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['nama_ortu']; ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('nama_ortu'); ?>
               </div>
            </div>
         </div>
         <div class="form-group row">
            <label for="kontak" class="col-4 col-form-label">Kontak Wali Siswa</label>
            <div class="col-8">
               <input id="kontak" name="kontak" placeholder="Kontak Wali Siswa ... " type="text" class="form-control <?= ($validation->hasError('kontak')) ? 'is-invalid' : ''; ?>" value="<?= $siswa['kontak']; ?>">
               <div class="invalid-feedback">
                  <?= $validation->getError('kontak'); ?>
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
</script>
<?= $this->endSection('js'); ?>