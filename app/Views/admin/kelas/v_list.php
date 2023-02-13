<table class="table table-striped table-bordered table-sm" style="width: 100%;">
   <thead class="bg-gradient-navy">
      <tr>
         <th class="text-center" style="width: 5%;">No</th>
         <th>Nama Kelas</th>
         <th style="width: 15%;">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php $no=1;
      foreach ($kelass as $item) {?>
      <tr>
         <th class="text-center"><?= $no++; ?></th>
         <td><?= $item['nama_kelas']; ?></td>
         <td class="text-center">
            <button class="btn btn-info btn-sm" onclick="editkelas(<?= $item['id_kelas']; ?>)"><i class="fa fa-pen"></i></button>
            <button class="btn btn-danger btn-sm bhapus" onclick="hapuskelas(<?= $item['id_kelas']; ?>)" data-namakelas="<?= $item['nama_kelas']; ?>"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
      <?php } ?>
   </tbody>
</table>