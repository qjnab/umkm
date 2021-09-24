<?php 

// $produk = $db->manual_query("select * from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");
$produk = $db->manual_query("select produk.id_produk, produk.nama_produk, produk.harga_produk, produk.satuan_produk, produk.produksi_produk, produk.kategori_produk, umkm.nama_umkm, stok.jumlah_stok, (select sum(jumlah_barang_purchase) from purchase where id_barang = produk.id_produk and exp_date != '0000-00-00' and exp_date <= now() and jenis_purchase = '+' order by exp_date desc) sum_exp, (select exp_date from purchase where id_barang = produk.id_produk and exp_date != '0000-00-00' and exp_date <= now() and jenis_purchase = '+' order by exp_date desc limit 1) exp_date  from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1 and (select sum(jumlah_barang_purchase) from purchase where id_barang = produk.id_produk and exp_date != '0000-00-00 00:00:00' and exp_date <= now() and jenis_purchase = '+' order by exp_date desc) > 0");

?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<table class="table data-table" style="width:100%">
							<thead>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Stok</th>
								<th>Nama Umkm</th>
								<th>Tanggal Kadaluarsa</th>
								<th>Harga</th>
							</thead>
							<tbody>
								<?php $no=1; foreach ($produk as $key => $value): ?>	
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['sum_exp'] ?? 0 ?></td>
									<td><?php echo $value['nama_umkm'] ?></td>
									<td><?php echo $value['exp_date'] ?></td>
									<td><?php echo $value['harga_produk'] ?></td>
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