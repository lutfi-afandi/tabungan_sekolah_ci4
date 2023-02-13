<table class="table table-striped table-bordered table-sm" style="width: 100%;">
   <thead class="bg-gradient-navy">
      <tr>
         <th class="text-center" style="width: 5%;">No</th>
         <th>Nama User</th>
         <th>Username</th>
         <th>Password</th>
         <th class="text-center" style="width: 15%;">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php $no=1;
      foreach ($users as $item) {?>
      <tr>
         <th class="text-center"><?= $no++; ?></th>
         <td><?= $item['nama_user']; ?></td>
         <td><?= $item['username']; ?></td>
         <td>
            <a type="button" onclick="reset_password(<?= $item['id']; ?>)" class="badge badge-primary"> reset password</a>
         </td>
         <td class="text-center">
            <button class="btn btn-danger btn-sm bhapus" onclick="hapususer(<?= $item['id']; ?>)" data-namauser="<?= $item['nama_user']; ?>"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
      <?php } ?>
   </tbody>
</table>