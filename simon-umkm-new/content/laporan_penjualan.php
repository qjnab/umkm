<?php 
$mulai="";
$selesai="";
if (isset($_GET['tanggal-mulai']) && isset($_GET['tanggal-selesai'])) {
	// print_r($_GET);
	$transaksi = $db->manual_query('select * from transaksi where date(tanggal_transaksi) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\'');
	$omset = $db->manual_query("select sum(harga_total_transaksi) as omset from transaksi where date(tanggal_transaksi) between '".$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai']."'")[0];
	$mulai = $_GET['tanggal-mulai'];
	$selesai= $_GET['tanggal-selesai'] ;
}
// $transaksi = null;
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-info">
				<span class="description-header"><b>Laporan Penjualan</b></span>
				<div class="card-tools">
					<button class=" btn btn-default " onclick="window.location.href='index.php?content=list_pembelian'">Pembelian</button>
					<button class=" btn btn-default " onclick="window.location.href='index.php?content=laporan_omset'">Omset</button>
					<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                </button>
				</div>
			</div>
			<div class="card-body">
				<!-- <div class="row"> -->
				<form>
					<div class="row">
						<input type="hidden" name="content" value="laporan_penjualan">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Tanggal Mulai</label>
								<input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control" value="<?php echo $mulai ?>">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Tanggal Selesai</label>
								<input type="date" name="tanggal-selesai" id="tanggal-selesai" class="form-control"  value="<?php echo $selesai ?>">
							</div>
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-info">Pilih</button> <button type="button" id="btn-cetak-laporan" class="btn btn-default" ><i class="fa fa-print"></i> Cetak</button> <button type="button"  class="btn btn-default" data-toggle='modal' data-target='#modal-rekap'><i class="fa fa-save"></i> Rekap</button>
							<button type="button"  class="btn btn-default" data-toggle='modal' data-target='#modal-tahunan'><i class="fa fa-print"></i>Cetak Tahunan</button>
						</div>
						<div class="col-lg-2">
							
						</div>
					</div>	
				</form>
				<!-- </div> -->
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<h5>Total Omset : Rp. <?php echo number_format($omset['omset']) ?></h5>
					</div>
					<hr>
					<div class="col-lg-12">
						<table class="table data-table-responsive" style="width: 100%">
							<thead>
								<th>ID</th>
								<th>Tanggal Nota</th>
								<th>Harga</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php if (isset($transaksi)): ?>
									
								<?php foreach ($transaksi as $key => $value): ?>
								<tr>
									<td><?php echo $value['id_transaksi'] ?></td>
									<td><?php echo $value['tanggal_transaksi'] ?></td>
									<td><?php echo number_format($value['harga_total_transaksi']) ?></td>
									<td><?php echo $value['keterangan_transaksi'] ?></td>	
									<td><button class="btn btn-default" data-toggle="modal" data-target="#modal-transaksi-<?php echo($value['id_transaksi']) ?>"><i class="fa fa-eye"></i></button></td>								
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
<?php if (isset($transaksi)): ?>
	<?php foreach ($transaksi as $key => $value): ?>
		<div class="modal" tabindex="-1" id="modal-transaksi-<?php echo $value['id_transaksi'] ?>" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Rincian Transaksi <?php echo $value['id_transaksi'] ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php 
							$datatrx = $db->manual_query("select * from purchase inner join produk on produk.id_produk = purchase.id_barang where id_transaksi = ".$value['id_transaksi']);
							// var_dump($datatrx);
						?>
						<table class="table">
							<thead>
								<th>Kode Brang</th>
								<th>Nama Barang</th>
								<th> </th>
								<th>Total</th>
							</thead>
							<tbody>
								<?php foreach ($datatrx as $k => $val): ?>
									<tr>
										<td><?php echo $val['id_barang'] ?></td>
										<td><?php echo $val['nama_produk'] ?><br><?php echo $val['harga_satuan_barang_purchase'] ?></td>
										<td><br> x <?php echo $val['jumlah_barang_purchase'] ?></td>
										<td><br><?php echo $val['harga_total_purchase'] ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<td><b>TOTAL</b></td>
									<td></td>
									<td></td>
									<td><?php echo $value['harga_total_transaksi'] ?></td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>	
	<?php endforeach ?>
<?php endif ?>
<div class="modal" id="modal-tahunan" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cetak Bulanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="php/export/laporan_penjualan_pertahun.php">
					
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<select class="form-control" required="" name="tahun" >
								<option value="">Pilih...</option>
								<?php for ($i=0; $i < 10; $i++) { ?>
								<option><?php echo $i+2021 ?></option>	
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Pilih</button>
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
