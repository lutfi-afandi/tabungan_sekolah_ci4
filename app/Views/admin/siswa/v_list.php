<table class="table table-striped table-bordered table-sm" style="width: 100%;" id="example1">
   <thead class="bg-gradient-navy">
      <tr>
         <th class="text-center" style="width: 5%;">No</th>
         <th>NIS</th>
         <th>Nama Siswa</th>
         <th>Jenis Kelamin</th>
         <th>Kelas</th>
         <th class="text-center">Foto</th>
         <th class="text-center">Password</th>
         <th class="text-center" style="width: 10%;">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php $no=1;
      foreach ($siswas as $item) {?>
      <tr>
         <th class="text-center"><?= $no++; ?></th>
         <td><?= $item['nis']; ?></td>
         <td><?= $item['nama_siswa']; ?></td>
         <td><?= $item['jenis_kelamin']; ?></td>
         <td><?= $item['nama_kelas']; ?></td>
         <td class="text-center">
            <?php if($item['foto_siswa']==null){
               $foto = 'img/siswa.png';
            }else{
               $foto = 'public/foto_siswa/'.$item['foto_siswa'];
            } ?>
            <img src="<?= base_url($foto); ?>" alt="foto" style="width: 50px; height: 50px; object-fit: cover;">
         </td>
         <td class="text-center"><button onclick="reset(<?= $item['id_siswa']; ?>)" class=" btn btn-info btn-xs">reset</button>
         </td>
         <td class="text-center">
            <button class="btn btn-info btn-sm" onclick="editsiswa(<?= $item['id_siswa']; ?>)"><i class="fa fa-pen"></i></button>
            <button class="btn btn-danger btn-sm bhapus" onclick="hapussiswa(<?= $item['id_siswa']; ?>,'<?= $item['nama_siswa']; ?>','<?= $item['nis']; ?>')"><i class="fa fa-trash"></i></button>
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
      if (confirm("Password akan menjadi 12345 \n Yakin mau reset password ini?") == true) {
         window.location.href = "<?= base_url('admin/siswa/reset_password'); ?>/" + parameter_id;
      }
   }
</script>