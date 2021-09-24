<?php 
$trx = $db->manual_query("select * from transaksi order by tanggal_transaksi desc");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<!-- <div class="card-title"> -->
					<h2 class="description-header">Kelola Transaksi</h2>
				<!-- </div> -->
			</div>
			<div class="card-body">

				<hr>

				<div class="row">
					<div class="col-lg-12">
						<table class="table datatable">
							<thead>
								<th>No</th>
								<th>Tanggal Transaksi</th>
								<th>Kode Transaksi</th>
								<th>Harga Transaksi</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($trx as $key => $value): $no++ ?>
								<tr role="button" >
									<td><?php echo $no ?></td>
									<td><?php echo $value['tanggal_transaksi'] ?></td>
									<td><?php echo $value['id_transaksi'] ?></td>
									<td><?php echo $value['harga_transaksi'] ?></td>
									<td><button data-toggle="modal" data-target="#modal-nota" id="<?php echo $value['id_transaksi'] ?>" class="btn btn-info modal-cetak-nota"><i class="fa fa-eye"></i></button></td>
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
<div class="modal" id="modal-nota">
	<div class="modal-dialog">
		<div class="modal-content">

		<!-- Modal Header -->
		<div class="modal-header">
			<h4 class="modal-title">Nota <span id="id-nota"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

		<!-- Modal body -->
		<div class="modal-body" id="printable-nota">
			No Nota : <span id="no-nota"></span>
			<br>
			Tanggal Nota : <span id="tanggal-nota"></span>
			<hr>
			<table class="table table-bordered table-stripped datatable-nota" id="cetak-nota">
				<thead>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Total</th>
				</thead>
				<tbody id="cetak-nota-body">
					
				</tbody>
			</table>
			<hr>
			<div class="row">
					<b>PEMBAYARAN : </b>
					<b>RP. <span id="total-nota">0</span></b>
				<div class="col-lg-6">
				</div>
				<div class="col-lg-6" style="text-align: right">
				</div>
			</div>
			</table>
		</div>

		<!-- Modal footer -->
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-info" id="print-nota">Cetak</button>
		</div>
    </div>
</div>