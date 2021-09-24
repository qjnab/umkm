<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Produk Kadaluarsa.xls"); 
require_once '../../config/db.php';
$db = new db();
$produk_exp = $db->manual_query("select * from produk order by nama_produk asc");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Produk Kadaluarsa dan Rusak</title>
</head>
<body>
<table>
	<thead>
		<th>Kode</th>
		<th>Nama</th>
        <th>Tanggal Kadaluarsa</th>
		<th>Harga</th>
	</thead>
	<tbody>
			
		<?php 
			// $produk = $db->manual_query("select * from produk where id_produk = ".$value['id_produk']." order by nama_produk asc");
		?>
			<?php foreach ($produk_exp as $k => $v): ?>
			<tr>
				<td><?php echo $v['id_produk'] ?></td>
				<td><?php echo $v['nama_produk'] ?></td>
                <td><?php echo $v['tgl_exp'] ?></td>
				<td style="text-align: right"><?php echo number_format($v['harga_produk'],0,",",".") ?></td>
			</tr>
			<?php endforeach ?>
	</tbody>
</table>
</body>
</html>
