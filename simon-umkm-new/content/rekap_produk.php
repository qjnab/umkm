<?php 
$mulai="";
$selesai="";
if (isset($_GET['tanggal-mulai']) && isset($_GET['tanggal-selesai'])) {
	// print_r($_GET);
	$transaksi = $db->manual_query('select sum(jumlah_barang_purchase) as jumlah,produk.id_produk ,umkm.id_umkm, produk.nama_produk , umkm.nama_umkm  from purchase left join produk on id_barang = id_produk left join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\' and jenis_purchase = \''.$_GET['jenis']."' group by id_barang ");
	$mulai = $_GET['tanggal-mulai'];
	$selesai = $_GET['tanggal-selesai'] ;
} 
// $transaksi = null;
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-info">
				<span class="description-header"><b>Rekap Barang</b></span>
				<div class="card-tools">
					<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                </button>
				</div>
			</div>
			<div class="card-body">
				<!-- <div class="row"> -->
					<form>
					<div class="form-row">
						<input type="hidden" name="content" value="rekap_produk">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control" required="" value="<?php echo $mulai ?>">
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="date" name="tanggal-selesai" id="tanggal-selesai" class="form-control" required="" value="<?php echo $selesai ?>">
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Jenis Transaksi</label>
								<select class="form-control" name="jenis" required="">
									<option value="">Pilih ... </option>
									<option value="+" <?php if ($_GET['jenis'] == "+"): ?>
										selected
									<?php endif ?>>Barang Masuk</option>
									<option value="-" <?php if ($_GET['jenis'] == "-"): ?>
										selected
									<?php endif ?>>Barang Keluar</option>
								</select>
							</div>	
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-info float-right">Export</button>
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-info float-right">Pilih</button>
						</div>
					</div>	
					</form>
				<!-- </div> -->
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<table class="table data-table-responsive" style="width: 100%">
							<thead>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Umkm</th>
								<th>Jumlah</th>
								<th>Tanggal Kadaluarsa</th>
								<th>#</th>
							</thead>
							<tbody>
								<?php if (isset($transaksi)): ?>
									
								<?php $no =0; foreach ($transaksi as $key => $value): $no++; ?>
								<tr class="clickable" data-toggle="modal" data-target="#modal-produk-<?php echo $value['id_produk'] ?>">
									<td><?php echo $no ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['nama_umkm'] ?></td>
									<td><?php echo $value['jumlah'] ?></td>	
									<td><?php echo $value['tgl_exp'] ?></td>	
									<td>#</td>								
								</tr>
								<?php endforeach ?>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php foreach ($transaksi as $key => $value): ?>
	<?php $datatransaksi = $db->manual_query('select * from purchase left join produk on id_barang = id_produk left join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\' and jenis_purchase = \''.$_GET['jenis']."' and id_barang = ".$value['id_produk']) ?>
	<div class="modal" id="modal-produk-<?php echo $value['id_produk'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo $value['nama_produk']." - ".$value['nama_umkm'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- <?php print_r($datatransaksi) ?> -->
					<table class="table table-bordered table-stripped datatable-nosort">
						<thead>
							<th>No</th>
							<th>Tanggal Transaksi</th>
							<th>Jumlah</th>
						</thead>
						<tbody>
							<?php $no = 0; foreach ($datatransaksi as $k => $v): $no++; ?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $v['tanggal_purchase'] ?></td>
								<td><?php echo $_GET['jenis']." ". $v['jumlah_barang_purchase'] ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>	
<?php endforeach ?>