<?php 
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=data omset ds point.xls");

header("Pragma: no-cache");

header("Expires: 0");
require_once '../../config/db.php';
$db = new db();
$namaBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
// print_r($_GET);
// $datatransaksi = $db->manual_query("select * from transaksi where tanggal");
$omset = $db->manual_query("select sum(harga_total_transaksi) as omset from transaksi where date(tanggal_transaksi) between '".$_GET['mulai'].'\' and \''.$_GET['selesai']."'")[0];
$dataumkm = $db->manual_query("select * from umkm where binaan_umkm = 1 order by nama_umkm");
$dataminggu = $db->manual_query("select week(selected_date) from (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v where selected_date between '".$_GET['mulai']."' and '".$_GET['selesai']."' group by week(selected_date)");
$jumlahminggu = count($dataminggu);
$spesial = true;
// print_r($bulan);

?>
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
<?php $bulan=explode("-",$_GET['mulai']);$b=str_replace("0", "", $bulan[1]);

if ($bulan[1]>3 && $bulan[0] == 2021) {
	# code...
	$spesial = false;	
}

 ?>
<h2 align="center">LAPORAN PENJUALAN UMKM DOLLY SAIKI POINT</h2>
<p align="center">PERIODE : <?php echo strtoupper($namaBulan[$b-1])." ".$bulan[0]; ?></p>
<!-- <table style="border-width: 0px"> 
	<tr>
		<td>Tanggal</td>
		<td>: <?php echo $_GET['mulai']." - ".$_GET['selesai']  ?></td>
	</tr>
	<tr>
		<td>Omset</td>
		<td>: <?php echo number_format($omset['omset'])  ?></td>
	</tr>
</table> -->
<br>
<table align="center" class="table-bordered" style="border-width: 2px" width="100%">
	<thead>
		<tr>
		<th rowspan="2" class="greyCell">No</th>
		<th rowspan="2" class="greyCell">Nama Umkm</th>
		<!-- <th></th> -->
		<th colspan="4" class="greyCell"><?php echo strtoupper($namaBulan[$b-1])?></th>

		<th rowspan="2" class="greyCell">Omset</th>
		<!-- <th rowspan="2">Stok</th> -->
		</tr>
		<tr>
		<?php if ($spesial): ?>
		<?php for ($i=1; $i < 6; $i++) { ?>
		<th class="greyCell">M <?php echo $i ?></th>	
		<?php } ?>	
		<?php else: ?>
		<?php $no = 0; foreach ($dataminggu as $key => $value): $no++; ?>
		<?php if ($no >4): break?>
			
		<?php endif ?>
		<th class="greyCell">M <?php echo $no ?></th>	
		<?php endforeach ?>
		<?php endif ?>	
		</tr>
	</thead>
	<tbody>
		<?php $no = 0; foreach ($dataumkm as $key => $value): ?>
			<?php 
			$tampil_umkm = false;
			if (!$spesial) {
				# code...
				$totalomsetumkm = $db->manual_query("select sum(harga_total_purchase) as omset from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai']."' and umkm.id_umkm = ".$value['id_umkm'])[0];
				foreach ($dataminggu as $k => $v) {
					$omsetminggu[$k]= $db->manual_query("select sum(harga_total_purchase) as total from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai'].'\' and week(tanggal_purchase) = '.$v[0]." and umkm.id_umkm = ".$value['id_umkm'])[0];
					// echo "select sum(harga_total_purchase) as total from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai'].'\' and week(tanggal_purchase) = '.$v[0]." and umkm.id_umkm = ".$value['id_umkm'];
				}

				if ($jumlahminggu == 6) {
					$omsetminggu[0]['total'] += $omsetminggu[1]['total'];
					$omsetminggu[1]['total'] = $omsetminggu[2]['total'];
					$omsetminggu[2]['total'] = $omsetminggu[3]['total'];
					$omsetminggu[3]['total'] = $omsetminggu[4]['total'] + $omsetminggu[5]['total'];
					unset($omsetminggu[4]);
					unset($omsetminggu[5]);
				}
				if ($jumlahminggu == 5) {
					$omsetminggu[0]['total'] += $omsetminggu[1]['total'];
					$omsetminggu[1]['total'] = $omsetminggu[2]['total'];
					$omsetminggu[2]['total'] = $omsetminggu[3]['total'];
					$omsetminggu[3]['total'] = $omsetminggu[4]['total'];
					unset($omsetminggu[4]);
				}
			}else{
				$totalomsetumkm = $db->manual_query("select sum(jumlah_omset) as omset from omset where id_umkm = ".$value['id_umkm'])[0];
				for ($i=1; $i < 6; $i++) { 
					# code...

					$omsetminggu[$i] = $db->manual_query("select sum(jumlah_omset) as total from omset where id_umkm = ".$value['id_umkm']." and minggu_omset = ".$i)[0];
				}
			}
			
			if ($totalomsetumkm['omset']!=0) {
			 	# code...
			 	$tampil_umkm = true;
			 } 
			
			?>
			<?php if ($tampil_umkm): $no++;?>
			<?php if ($spesial): ?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $value['nama_umkm'] ?></td>
				<!-- <td></td> -->
				<?php for ($i=1; $i < 6; $i++) { ?> 
					
					
				<td align="right"><?php echo number_format($omsetminggu[$i]['total'],0,",",".");?></td>
				<?php $totalomsetminggu[$i] += $omsetminggu[$i]['total']; ?>
				<?php } ?>
				<td align="right"><?php echo number_format($totalomsetumkm['omset'],0,",",".");?></td>
				<?php $totalomset  += $totalomsetumkm['omset']; ?>
				<!-- <td></td> -->
			</tr>
			<?php else: ?>	
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $value['nama_umkm'] ?></td>
				<!-- <td></td> -->
				<?php foreach($omsetminggu as $k => $v): ?>
					
				<td align="right"><?php echo number_format($v['total'],0,",",".");?></td>
				<?php $totalomsetminggu[$k] += $v['total']; ?>
				<?php endforeach ?>
				<td align="right"><?php echo number_format($totalomsetumkm['omset'],0,",",".");?></td>
				<?php $totalomset  += $totalomsetumkm['omset']; ?>
				<!-- <td></td> -->
			</tr>
			<?php endif ?>
			<?php endif ?>

		<?php endforeach ?>
		<tr>
			<td align="center" class="greyCell" colspan="2">Total</td>
			<?php if ($spesial): ?>
			<?php for ($i=1; $i < 5; $i++) { ?> 
			<td align="right" class="greyCell"><?php echo number_format($totalomsetminggu[$i],0,",",".");?></td>	
			<?php } ?>
			<?php else: ?>
			<?php foreach ($totalomsetminggu as $k => $v): ?>
				<td align="right" class="greyCell"><?php echo number_format($v,0,",",".");?></td>
			<?php endforeach ?>
			<?php endif ?>
			<td align="right" class="greyCell"><?php echo number_format($totalomset,0,",","."); ?></td>
		</tr>
	</tbody>
</table>
<table width="100%" style="border: none">
	<tr style="border: none">
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td style="border: none"></td>
		<td colspan="4" style="border: none"></td>
	</tr>
	<tr style="border: none">
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td style="border: none"></td>
		<td colspan="4" align="center" style="border: none">Surabaya,&nbsp&nbsp&nbsp&nbsp <?php echo $namaBulan[$b-1]." ".$bulan[0];?></td>
	</tr>
	<tr style="border: none">
		<td style="border: none">&nbsp</td>
		<td align="center" style="border: none"></td>
		<td style="border: none"></td>
		<td colspan="4" align="center" style="border: none">Mengetahui,</td>
	</tr>
	<tr>
		<td style="border: none">&nbsp</td>
		<td align="center" style="border: none"></td>
		<td style="border: none"></td>
		<td colspan="4" align="center" style="border: none">Seksi Keamanan Pangan,</td>
	</tr>
	<tr>
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td colspan="4" style="border: none">&nbsp</td>
	</tr>
	<tr>
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td colspan="4" style="border: none">&nbsp</td>
	</tr>
	<tr>
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td colspan="4" style="border: none">&nbsp</td>
	</tr>
	<tr>
		<td style="border: none">&nbsp</td>
		<td align="center" style="text-decoration:underline;border: none">&nbsp</td>
		<td style="border: none">&nbsp</td>
		<td colspan="4" align="center" style="text-decoration:underline;border: none">Drh. Rinni Sulestari</td>
	</tr>
	<tr>
		<td style="border: none">&nbsp</td>
		<td  style="border: none" align="center"></td>
		<td style="border: none"></td>
		<td colspan="4"  style="border: none" align="center">NIP 196909241997032005</td>
	</tr>
</table>