<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $title; ?></title>
   <!-- Theme style -->
   <!-- <link rel="stylesheet" href="<?= base_url()?>/dist/css/adminlte.min.css"> -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;700;900&display=swap" rel="stylesheet">
   <style type="text/css">
      /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
      body {
         width: 100%;
         height: 100%;
         margin: 0;
         padding: 0;
         /* background-color: #FAFAFA; */
         font-family: 'Inter', sans-serif;
         font-size: 8pt;
      }

      table,
      th,
      td {
         border: 1px solid;
         border-collapse: collapse;
      }

      .setoran,
      .tarikan {
         white-space: nowrap;
      }

      * {
         box-sizing: border-box;
         -moz-box-sizing: border-box;
      }

      @page {
         size: A4;
         margin: 0;
      }

      @media print {

         html,
         body {
            width: 210mm;
            height: 297mm;
         }

         .container {
            padding-left: 10mm;
            padding-right: 10mm;
            padding-bottom: 10mm;
         }

         .identitas {
            margin: 0px;
            margin-bottom: 3px;
         }

      }
   </style>
</head>
<?php 
function buatRupiah($angka){
   $hasil = "Rp. " . number_format($angka,2,',','.');
   return $hasil;
}
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Ags',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
 ?>

<body>
   <div class="judul">
      <center>
         <img src="<?= base_url()?>/img/kop.png" style="height: 20mm;">
         <h3 style="margin: 0px;">DATA LAPORAN TABUNGAN</h3>
         <hr>
         <p class="identitas">Periode <?= tgl_indo($tanggal_awal); ?> s.d <?= tgl_indo($tanggal_akhir); ?></p>
      </center>
   </div>
   <div class="container mt-4">

      <table class="table table-bordered" style="width: 100%;  ">
         <thead class="bg-gradient-navy">
            <tr class="text-nowrap">
               <th class="text-center" style="width: 5%;">No</th>
               <th>Tanggal</th>
               <th>NIS</th>
               <th>Nama Siswa</th>
               <th>Kelas</th>
               <th class="setoran">Setoran</th>
               <th class="tarikan">Penarikan</th>
               <th>Keterangan</th>
               <th>Petugas</th>
            </tr>
         </thead>
         <tbody>
            <?php $no=1;
               foreach ($laporan as $item) {?>
            <?php if($item['jenis_transaksi']=='setor'){
                  $bg = '#defff1';
                  $icon = '<i class="fa fa-file-upload text-info"></i>';
               } else{
                  $bg = '#feeeea';
                  $icon = '<i class="fa fa-file-download text-maroon"></i>';
               } ?>
            <tr style="background-color: <?= $bg; ?>;">
               <td>
                  <center><?= $no++." ".$icon; ?></center>
               </td>
               <td><?= tgl_indo(date('Y-m-d', strtotime($item['tanggal_transaksi']))); ?></td>
               <td><?= $item['nis']; ?></td>
               <td><?= $item['nama_siswa']; ?></td>
               <td style="text-align: center;"><?= $item['nama_kelas']; ?></td>
               <td class="text-nowrap setoran">
                  <?= ($item['jenis_transaksi']=='setor')? buatRupiah($item['jumlah_transaksi']). " ": "Rp. -"; ?>
               </td>
               <td class="tarikan">
                  <?= ($item['jenis_transaksi']=='tarik')? buatRupiah($item['jumlah_transaksi']). " ": "Rp. -" ?>
               </td>
               <td><?= $item['keterangan']; ?></td>
               <td><?= $item['nama_petugas']; ?></td>
            </tr>
            <?php } ?>
         </tbody>
         <tfoot>
            <tr>
               <td colspan="5">Total Setoran</td>
               <td><?= buatRupiah($total_setoran); ?></td>
               <td colspan="3"></td>
            </tr>
            <tr>
               <td colspan="6">Total Penarikan</td>
               <td><?= buatRupiah($total_penarikan); ?></td>
               <td colspan="2"></td>
            </tr>
            <tr>
               <td colspan="6"><b>Total Saldo</b></td>
               <td colspan="4" style="background-color: #16c745;">
                  <center><b><?= buatRupiah($saldo); ?></b></center>
               </td>
            </tr>
         </tfoot>
      </table>
   </div>

</body>

<script type="text/javascript">
   window.print();
</script>

</html>