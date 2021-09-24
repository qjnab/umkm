<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data UMKM.xls");
require_once '../../config/db.php';
$db = new db();
$umkm = $db->manual_query("select * from umkm inner join kategori on umkm.kategori_umkm = kategori.id_kategori inner join binaan on umkm.binaan_umkm = binaan.id_binaan");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h2 ></h2>
<table >
	<thead>
		<th>No</th>
		<th>Nama UMKM</th>
		<th>Nama Pemilik UMKM</th>
		<!-- <th>Kategori UMKM</th> -->
		<th>Alamat UMKM</th>
		<th>Produk</th>
		<th>No HP</th>
		<th>Binaan UMKM</th>
		<th>Kategori</th>
	</thead>
	<tbody>
		<?php $no=0; foreach ($umkm as $key => $value): $no++; ?>
			<tr >
				<td><?php echo $no ?></td>
				<td><?php echo $value['nama_umkm'] ?></td>
				<td><?php echo $value['nama_pemilik_umkm'] ?></td>
				<!-- <td><?php echo $value['nama_kategori'] ?></td> -->
				<td><?php echo $value['alamat_ktp_umkm']." ".$value['gang_blok_umkm']." ".$value['no_rumah_umkm']." ,".$value['kelurahan_umkm']." , ".$value['kecamatan_umkm'] ?></td>
				<?php 
											$produk = $db->manual_query("select nama_produk from produk where id_umkm = ".$value['id_umkm']);
											$total = count($produk);
											$count = 1;
										?>
				<td>
					<?php foreach ($produk as $k => $v): ?>
						<?php if ($count == $total): ?>
													<?php echo $v['nama_produk']."." ?>
												<?php else: ?>
													<?php echo $v['nama_produk']." , " ?>
												<?php endif ?>
												<?php $count ++ ?>
					<?php endforeach ?>
				</td>
				<td><?php echo $value['no_hp_umkm'] ?></td>
				<td><?php echo $value['nama_binaan'] ?></td>
				<td><?php echo $value['nama_kategori'] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

</body>
</html>