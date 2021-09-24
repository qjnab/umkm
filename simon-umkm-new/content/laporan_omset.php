<?php 
$mulai="";
$selesai="";
if (isset($_GET['tanggal-mulai']) && isset($_GET['tanggal-selesai'])) {
	// print_r($_GET);
	// $transaksi = $db->manual_query('select * from transaksi where date(tanggal_transaksi) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\'');
	$omset = $db->manual_query("select sum(harga_total_transaksi) as omset from transaksi where date(tanggal_transaksi) between '".$_GET['mulai'].'\' and \''.$_GET['selesai']."'")[0];
	$dataumkm = $db->manual_query("select * from umkm where binaan_umkm = 1 order by nama_umkm");
	// $hasil = $db->manual_query('select sum(harga_total_transaksi) as omset from transaksi where date(tanggal_transaksi) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\'')[0];
	$mulai = $_GET['tanggal-mulai'];
	$selesai= $_GET['tanggal-selesai'] ;
	$dataminggu = $db->manual_query("select week(selected_date) from (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v where selected_date between '".$_GET['tanggal-mulai']."' and '".$_GET['tanggal-selesai']."' group by week(selected_date)");
}
// $transaksi = null;
// print_r($dataminggu);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-danger">
				<span class="description-header"><b>Laporan Omset</b></span>
				<div class="card-tools">
					<button class=" btn btn-default " onclick="window.location.href='index.php?content=laporan_penjualan'">Laporan Penjualan</button>
					<button class=" btn btn-default " onclick="window.location.href='index.php?content=list_pembelian'">Laporan Pembelian</button>
					<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                </button>
				</div>
			</div>
			<div class="card-body">
				<!-- <div class="row"> -->
				<form>
					<div class="row">
						<input type="hidden" name="content" value="laporan_omset">
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
							<button type="submit" class="btn btn-info">Pilih</button> <button type="button" id="btn-cetak-laporan" class="btn btn-default" id="cetak-omset"><i class="fa fa-print"></i> Cetak</button>
						</div>
						<div class="col-lg-2">
							
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
								<th>Nama UMKM</th>
								<th>I</th>
								<th>II</th>
								<th>III</th>
								<th>IV</th>
								<th>V</th>
								<th>Omset</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($dataumkm as $key => $value): $no++; ?>
								<?php 
									$totalomsetumkm = $db->manual_query("select sum(harga_total_purchase) as omset from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between '".$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai']."' and umkm.id_umkm = ".$value['id_umkm'])[0]; 
									foreach ($dataminggu as $k => $v) {
										# code...
										// echo "select sum(harga_total_purchase) as total from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between '".$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\' and week(tanggal_purchase) = '.$v[0]." and umkm.id_umkm = ".$value['id_umkm'];
										$omsetminggu[$v[0]]= $db->manual_query("select sum(harga_total_purchase) as total from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where date(tanggal_purchase) between '".$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\' and week(tanggal_purchase) = '.$v[0]." and umkm.id_umkm = ".$value['id_umkm'])[0];
									}
								?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['nama_umkm'] ?></td>
									<?php foreach ($dataminggu as $k => $v): ?>
										<td><?php echo number_format($omsetminggu[$v[0]]['total'],0,",",".");?></td>
									<?php endforeach ?>
									<td><?php echo number_format($totalomsetumkm['omset'],0,",",".");?></td>
									<td><button class="btn btn-default" data-toggle="modal" data-target="#modal-purchase-<?php echo $value['id_umkm'] ?>"><i class="fa fa-eye"></i></button></td>
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
<?php foreach ($dataumkm as $key => $value): ?>
<?php 
// echo "select * from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where id_umkm = ".$value['id_umkm']." and date(tanggal_purchase) between '".$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai']."' order by tanggal_purchase desc";
$datapurchase = $db->manual_query("select * from purchase inner join produk on purchase.id_barang = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where umkm.id_umkm = ".$value['id_umkm']." and date(tanggal_purchase) between '".$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai']."' and id_transaksi != 0 order by tanggal_purchase desc") ?>	
<div class="modal" tabindex="-1" role="dialog" id="modal-purchase-<?php echo $value['id_umkm'] ?>">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Penjualan <?php echo $value['nama_umkm'] ?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<table class="table data-table">
				<thead>
					<th>No</th>
					<th>Tanggal Pembelian</th>
					<th>Nama Produk</th>
					<th>Jumlah</th>
					<th>Harga</th>
				</thead>
				<tbody>
					<?php $no=0; foreach ($datapurchase as $k => $v): $no++; ?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $v['tanggal_purchase'] ?></td>
							<td><?php echo $v['nama_produk'] ?></td>
							<td><?php echo $v['jumlah_barang_purchase'] ?></td>
							<td><?php echo number_format($v['harga_total_purchase']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>
<?php endforeach ?>