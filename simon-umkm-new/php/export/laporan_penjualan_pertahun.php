<?php 
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=data omset ds point.xls");

header("Pragma: no-cache");

header("Expires: 0");
require_once '../../config/db.php';
$db = new db();
$umkm = $db->manual_query("select * from umkm where binaan_umkm = 1");
foreach ($umkm as $key => $value) {
	for ($i=1; $i <= 12 ; $i++) { 
		$omset[$value['id_umkm']][$i] = $db->manual_query("select sum(harga_total_purchase) as omset from purchase  inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where month(tanggal_purchase) = ".$i." and year(tanggal_purchase) = ".$_GET['tahun']." and umkm.id_umkm = ".$value['id_umkm'])[0];
	}
}
if ($_GET['tahun'] == 2021) {
	foreach ($umkm as $key => $value) {
		# code... 
		for ($i=1; $i <= 2; $i++) { 
			$omset[$value['id_umkm']][$i] = $db->manual_query("select sum(jumlah_omset) as omset from omset inner join umkm on omset.id_umkm = umkm.id_umkm where omset.id_umkm = ".$value['id_umkm']." and bulan_omset = ".$i." and tahun_omset = ".$_GET['tahun'])[0];
		}
	}
}
$now = (int)date('n');
$namaBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Laporan
	</title>
<style type="text/css">
	table,
      th,
      td {
        padding: 5px;
        border: 1px solid black;
        border-collapse: collapse;
      }
    .greyCell {
        background-color: #D9D9D9;
    }
      @media print {
		    body{
		        width: 215mm;
		        /*margin: 2mm 2mm 2mm 2mm; */
		        /* change the margins as you want them to be. */
		   } 
		}

</style>
</head>
<body>
	<h2 align="center">LAPORAN PENJUALAN UMKM DOLLY SAIKI POINT</h2>
	<p align="center">PERIODE : <?php echo $_GET['tahun']; ?></p>

	<table align="center">
		<thead class="greyCell">
			<th>No</th>
			<th>Nama Umkm</th>
			<?php for ($i=1; $i <= $now ; $i++) { ?>  
			<th><?php echo $namaBulan[$i-1] ?></th>
			<?php } ?>

		</thead>
		<tbody>
			<?php $No=0; foreach ($umkm as $key => $value): $no++;?>
			<tr>
				<td align="center"><?php echo $no ?></td>
				<td ><?php echo $value['nama_umkm'] ?></td>
				<?php for ($i=1; $i <= $now; $i++) { ?>
				<?php if (isset($omset[$value['id_umkm']][$i]['omset'] ) && $omset[$value['id_umkm']][$i]['omset'] !="" && $omset[$value['id_umkm']][$i]['omset'] !=0): ?>
				<td align="right" ><?php echo (string)$omset[$value['id_umkm']][$i]['omset'] ?></td>

				<?php else: ?>
				<td align="right" ><?php echo '-' ?></td>

				<?php endif ?>
				<?php } ?>
			</tr>	
			<?php endforeach ?>
		</tbody>
	</table>
	<table width="100%" style="border: none">
		<tr style="border: none">
			<td style="border: none">&nbsp</td>
			<td style="border: none"></td>
			<td style="border: none"></td>
		</tr>
		<tr style="border: none">
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td align="center" style="border: none">Surabaya,&nbsp&nbsp&nbsp&nbsp<?php echo $namaBulan[$b-1]." ".$bulan[0];?></td>
		</tr>
		<tr style="border: none">
			<td align="center" style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td align="center" style="border: none">Mengetahui,</td>
		</tr>
		<tr>
			<td align="center" style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td align="center" style="border: none">Seksi Keamanan Pangan,</td>
		</tr>
		<tr>
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
		</tr>
		<tr>
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
		</tr>
		<tr>
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
		</tr>
		<tr>
			<td align="center" style="text-decoration:underline;border: none">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td align="center" style="text-decoration:underline;border: none">Drh. Rinni Sulestari</td>
		</tr>
		<tr>
			<td  style="border: none" align="center">&nbsp</td>
			<td style="border: none">&nbsp</td>
			<td  style="border: none" align="center">NIP 196909241997032005</td>
		</tr>
	</table>
</body>
</html>