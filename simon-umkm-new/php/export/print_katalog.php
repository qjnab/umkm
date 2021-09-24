<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Data Produk.xls"); 
require_once '../../config/db.php';
$db = new db();
$umkm = $db->manual_query("select * from umkm where binaan_umkm = 1 order by nama_umkm asc");

?>
<!DOCTYPE html>
<html>
<head>
	<title>KATALOG DS POINT</title>
	<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
</head>
<body>
<table class="table table-bordered table-stripped datatable">
	<br><br><h1 style="text-align: center">KATALOG DS POINT</h1><br><br>
	<thead style="text-align: center; background-color: yellow">
		<th>NAMA</th>
		<th>HARGA</th>
		<th>FOTO</th>
	</thead>
	<tbody>
		<?php foreach ($umkm as $key => $value): ?>
		<?php 
			$produk = $db->manual_query("select * from produk where id_umkm = ".$value['id_umkm']." order by nama_produk asc");
		?>
			<?php foreach ($produk as $k => $v): ?>
				<?php if ($v['foto_produk'] && file_exists('../images/produk/'.$v['foto_produk'])) { ?>
					<?php //foreach ($i as $i => $img): //echo json_encode($img);exit;
						// echo json_encode($v);
					?>
					<tr>
						<td colspan="3" style="text-align: center; background-color: #DCDCDC" ><b><?php echo $value['nama_umkm'] ?></b></td>
					</tr>
						<tr>
							<td><?php echo $v['nama_produk'] ?></td>
							<td style="text-align: right"><?php echo number_format($v['harga_produk'],0,",",".") ?></td>
							<?php //foreach ($image as $img => $v): //echo json_encode($img);exit;?>
								<td style="text-align: center"><img src="<?php echo '../images/produk/'.$v['foto_produk'] ?>" style="max-width: 100px; max-height: 100px"></td>
							<?php //endforeach ?>
						</tr>
					<?php //endforeach ?>
				<?php } ?>
			<?php endforeach ?>
			<?php if ($v['foto_produk'] && file_exists('../images/produk/'.$v['foto_produk'])) { ?>
					<?php //foreach ($i as $i => $img): //echo json_encode($img);exit;
						// echo json_encode($v);
					?>
					<!-- <tr>
						<td colspan="3" style="text-align: center; background-color: #DCDCDC" ><b><?php //echo $value['nama_umkm'] ?></b></td>
					</tr>	 -->
						<!-- <tr>
							<td><?php echo $v['nama_produk'] ?></td>
							<td style="text-align: right"><?php echo number_format($v['harga_produk'],0,",",".") ?></td>
							<?php //foreach ($image as $img => $v): //echo json_encode($img);exit;?>
								<td style="text-align: center"><img src="<?php echo '../images/produk/'.$v['foto_produk'] ?>" style="max-width: 100px; max-height: 100px"></td>
							<?php //endforeach ?>
						</tr> -->
					<?php //endforeach ?>
				<?php } ?>
		<?php endforeach ?>
		
	</tbody>
</table>
</body>
</html>