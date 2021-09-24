<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Data Produk Kadaluarsa.xls"); 
require_once '../../config/db.php';
$db = new db();
// $produk_exp = $db->manual_query("select * from produk order by nama_produk asc");
$produk = $db->manual_query("select produk.id_produk, produk.nama_produk, produk.harga_produk, produk.satuan_produk, produk.produksi_produk, produk.kategori_produk, umkm.nama_umkm, stok.jumlah_stok, (select sum(jumlah_barang_purchase) from purchase where id_barang = produk.id_produk and exp_date != '0000-00-00' and exp_date <= now() and jenis_purchase = '+' order by exp_date desc) sum_exp, (select exp_date from purchase where id_barang = produk.id_produk and exp_date != '0000-00-00' and exp_date <= now() and jenis_purchase = '+' order by exp_date desc limit 1) exp_date  from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1 and (select sum(jumlah_barang_purchase) from purchase where id_barang = produk.id_produk and exp_date != '0000-00-00 00:00:00' and exp_date <= now() and jenis_purchase = '+' order by exp_date desc) > 0");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Produk Kadaluarsa dan Rusak</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<table class="table table-bordered table-stripped datatable">
	<thead>
		<th>No.</th>
		<th>Nama UMKM</th>
		<th>Nama Produk</th>
		<th>Harga</th>
		<th>Jumlah Produk</th>
        <th>Tanggal Kadaluarsa</th>
	</thead>
	<tbody>
			
		<?php 
			// $produk = $db->manual_query("select * from produk where id_produk = ".$value['id_produk']." order by nama_produk asc");
			
		?>

			<?php $no=1; foreach ($produk as $key => $value) : ?>	
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $value['nama_umkm'] ?></td>
					<td><?php echo $value['nama_produk'] ?></td>
					<td><?php echo $value['harga_produk'] ?></td>
					<td><?php echo $value['sum_exp'] ?></td>
					<td><?php echo $value['exp_date'] ?></td>
				</tr>
			<?php endforeach ?>
	</tbody>
</table>
</body>
</html>
