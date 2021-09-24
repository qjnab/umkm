<?php 
$produk = $db->manual_query("select * from produk inner join kategori on produk.kategori_produk = kategori.id_kategori inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h2 class="description-header">Kelola Produk</h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table">
							<thead>
								<th>No</th>
								<th>Nama Barang</th>
								<th>UMKM</th>
								<th>Kategori</th>
								<th>Harga</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($produk as $key => $value): $no++; ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['nama_umkm'] ?></td>
									<td><?php echo $value['nama_kategori'] ?></td>
									<td><?php echo number_format($value['harga_produk']) ?></td>
									<td>#</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>