<?php 
$produk = $db->manual_query("select * from produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");
$trx = $db->manual_query("select * from transaksi where date(tanggal_transaksi) = date(now()) order by tanggal_transaksi desc");
$voucher = $db->manual_query("select * from voucher where status_voucher = 0 and tanggal_voucher > now()");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-success">
				<span class="description-header"><b>KASIR</b></span>
				<div class="card-tools">
					<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                </button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header bg-gradient-info">
								<span class="description-header"><b>Tambah Barang</b></span>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label>Id Barang</label>
											<!-- <input type="text" class="form-control" name="id_produk"> -->
											<select class="form-control select2" name="id_produk" id="id_produk">
												<option disabled="" selected="">Pilih Produk - UMKM</option>
												<?php foreach ($produk as $key => $value): ?>
													<option value="<?php echo $value['id_produk'] ?>" ><?php echo $value['nama_produk']." - ".$value['nama_umkm']." - ".$value['harga_produk'] ?> </option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<!-- <div class="col-lg-2">
										<div class="form-group">
											<label>Nama Produk</label> -->
											<input type="hidden" class="form-control" name="nama_produk" readonly="" id="nama_produk">
										<!-- </div>
									</div> -->
									<div class="col-lg-2">
										<div class="form-group">
											<label>Harga Produk</label>
											<input type="text" class="form-control" name="harga_produk" readonly="" id="harga_produk">
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<label>Diskon Produk (%)</label>
											<input type="text" class="form-control" name="diskon_produk" readonly="" id="diskon_produk">
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<label>Jumlah </label>
											<input type="number" class="form-control" name="jumlah_produk" value="0" min="1" id="jumlah_produk" >
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group"><br>
											<button class="btn btn-success float-bottom" id="tambah-nota" >Tambah</button>
											<button class="btn btn-info" data-toggle="modal" data-target="#modal-scanner" id="bt-scan">Scan</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header bg-success">
								<span class="description-header"><b>Nota</b></span>
							</div>
							<div class="card-body">
								<table class="table table-bordered table-stripped datatable-nosort" id="table-nota ">
									<thead>
										<th>No</th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Diskon (%)</th>
										<th>Jumlah</th>
										<th>Total</th>
									</thead>
									<tbody id="nota-body">
										
									</tbody>
								</table>
								<hr>
								<div class="row">
									<div class="col-lg-6">
										<h2>PEMBAYARAN : </h2>
									</div>
									<div class="col-lg-6" style="text-align: right">
										<h2>RP. <span id="total">0</span></h2>
										
									</div>
									<hr>
									<div class="col-lg-6">
										<h2>CASH </h2>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="number" class="form-control" name="cash" id="cash">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Diskon</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input class="form-control" type="number" value="0" min="0" max="100" name="diskon_transaksi" id="diskon_transaksi"  >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group"> 
											<label>Voucher</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<select class="form-control select2" name="id_voucher" id="id_voucher">
												<option  selected="" value="">Pilih Voucher</option>
												<?php foreach ($voucher as $key => $value): ?>
													<option value="<?php echo $value['id_voucher'] ?>"><?php echo $value['kode_voucher']." - ".number_format($value['potongan_voucher']) ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="col-lg-12">
										<button class="btn btn-info float-right" id="bayar-nota">Bayar</button>
										<button class="btn btn-danger float-left" id="cancel-nota">Batal</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header bg-info">
								Transaksi Hari Ini
							</div>
							<div class="card-body">
								<table class="data-table">
									<thead>
										<th>No</th>
										<th>ID transaksi</th>
										<th>Tanggal transaksi</th>
										<th>Harga</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php if ($trx!=null): ?>
											
										<?php $no=0; foreach ($trx as $key => $value): $no++ ?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $value['id_transaksi'] ?></td>
											<td><?php echo $value['tanggal_transaksi'] ?></td>
											<td><?php echo $value['harga_total_transaksi'] ?></td>
											<td><button class="btn btn-default modal-cetak-nota" data-toggle="modal" data-target="#modal-nota" id="<?php echo $value['id_transaksi'] ?>" >cetak</button></td>

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
</div>

<div class="modal" id="modal-scanner">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Scanner</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="quangga-img" style="max-width: 100%" >
      
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" id="print-nota">Cetak</button>
      </div>

    </div>
  </div>
</div>