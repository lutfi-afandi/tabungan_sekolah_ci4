<?php 
function buatRupiah($angka){
   $hasil = "Rp. " . number_format($angka,2,',','.');
   return $hasil;
} ?>
<table class="table table-striped table-bordered table-sm" style="width: 100%;" id="example1">
   <thead class="bg-gradient-navy">
      <tr class="text-nowrap">
         <th class="text-center" style="width: 5%;">No</th>
         <th>Tanggal</th>
         <th>NIS</th>
         <th>Nama Siswa</th>
         <th>Kelas</th>
         <th>Setoran</th>
         <th>Penarikan</th>
         <th>Keterangan</th>
         <th>Petugas</th>
         <th class="text-center" style="width: 10%;">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php $no=1;
      foreach ($transaksis as $item) {?>
      <?php if($item['jenis_transaksi']=='setor'){
         $bg = '#defff1';
         $icon = '<i class="fa fa-file-upload text-info"></i>';
      } else{
         $bg = '#feeeea';
         $icon = '<i class="fa fa-file-download text-maroon"></i>';
      } ?>
      <tr style="background-color: <?= $bg; ?>;">
         <th class="text-center"><?= $no++; ?></th>
         <td><?= date('d/M/Y', strtotime($item['tanggal_transaksi'])); ?></td>
         <td><?= $item['nis']; ?></td>
         <td><?= $item['nama_siswa']; ?></td>
         <td><?= $item['nama_kelas']; ?></td>
         <td class="text-nowrap float-right" style="content: 'Rp.'; float:left;">
            <?= ($item['jenis_transaksi']=='setor')? buatRupiah($item['jumlah_transaksi']). " ": "Rp. -"; ?>
         </td>
         <td class="text-nowrap">
            <?= ($item['jenis_transaksi']=='tarik')? buatRupiah($item['jumlah_transaksi']). " ": "Rp. -" ?>
         </td>
         <td><?= $item['keterangan']; ?></td>
         <td><?= $item['nama_petugas']; ?></td>
         <td class="text-center">
            <button class="btn btn-danger btn-sm bhapus" onclick="hapustransaksi(<?= $item['id_transaksi']; ?>, '<?= $item['nama_siswa']; ?>','<?= date('d/M/Y', strtotime($item['tanggal_transaksi'])); ?>')"><i class=" fa fa-trash"></i></button>
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