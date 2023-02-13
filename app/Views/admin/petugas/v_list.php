<table class="table table-striped table-bordered table-sm" style="width: 100%;" id="example1">
   <thead class="bg-gradient-navy">
      <tr>
         <th class="text-center" style="width: 5%;">No</th>
         <th>NIP</th>
         <th>Nama Petugas</th>
         <th>Jenis Kelamin</th>
         <th>Kontak</th>
         <th>Username</th>
         <th>Role</th>
         <th class="text-center">Foto</th>
         <th class="text-center">Password</th>
         <th class="text-center" style="width: 10%;">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php $no=1;
      foreach ($petugass as $item) {?>
      <tr>
         <th class="text-center"><?= $no++; ?></th>
         <td><?= $item['nip']; ?></td>
         <td><?= $item['nama_petugas']; ?></td>
         <td><?= $item['jk_petugas']; ?></td>
         <td><?= $item['kontak']; ?></td>
         <td><?= $item['username']; ?></td>
         <td><?= ($item['role'] =='1') ? 'Administrator': 'Petugas'; ?></td>
         <td class="text-center">
            <?php if($item['foto_petugas']==null){
               $foto = 'img/admin.png';
            }else{
               $foto = 'public/foto_petugas/'.$item['foto_petugas'];
            } ?>
            <img src="<?= base_url($foto); ?>" alt="foto" style="width: 50px; height: 50px; object-fit: cover;">
            </a>
         </td>
         <td class="text-center"><button onclick="reset(<?= $item['id_petugas']; ?>)" class=" btn btn-info btn-xs">reset</button>
         </td>
         <td class="text-center">
            <button class="btn btn-info btn-sm" onclick="editpetugas(<?= $item['id_petugas']; ?>)"><i class="fa fa-pen"></i></button>
            <button class="btn btn-danger btn-sm bhapus" onclick="hapuspetugas(<?= $item['id_petugas']; ?>)" data-namapetugas="<?= $item['nama_petugas']; ?>"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
      <?php } ?>
   </tbody>
</table>

<script>
   $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": false,
      lengthMenu: [
         [25, 50, -1],
         [25, 50, 'All'],
      ],
   });
</script>
<script>
   function reset(parameter_id) {
      if (confirm("Password akan di reset menjadi 12345 \nYakin mau reset password ini?") == true) {
         window.location.href = "<?= base_url('admin/petugas/reset_password'); ?>/" + parameter_id;
      }
   }
</script>