<?php 
// query lama
// $produk = $db->manual_query("select * from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");

// query baru
$produk = $db->manual_query("select produk.id_produk, produk.nama_produk, produk.harga_produk, produk.satuan_produk, produk.produksi_produk, produk.kategori_produk, umkm.nama_umkm, stok.jumlah_stok, ((select sum(p1.jumlah_barang_purchase) from purchase p1 where p1.id_barang = produk.id_produk and p1.jenis_purchase = '+') - (select sum(p2.jumlah_barang_purchase) sum from purchase p2 where p2.id_barang = produk.id_produk and ((p2.jenis_purchase = '-') or (p2.exp_date <= now() and p2.exp_date != '0000-00-00')))) total_stok, (select p3.exp_date from purchase p3 where p3.id_barang = produk.id_produk and p3.exp_date != '0000-00-00' and p3.exp_date > now() and p3.jenis_purchase = '+' order by p3.exp_date asc limit 1) exp_date from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");

$dataajust = $db->manual_query("select * from purchase inner join produk on produk.id_produk = purchase.id_barang where id_transaksi = 0 order by tanggal_purchase desc");
$umkm = $db->manual_query("select * from umkm inner join kategori on umkm.kategori_umkm = kategori.id_kategori inner join binaan on umkm.binaan_umkm = binaan.id_binaan where umkm.binaan_umkm = 1");
$kategori = $db->manual_query("select * from kategori");
foreach ($kategori as $key => $value) {
	# code...
	$newkategori[$value['id_kategori']] = $value['nama_kategori'];
}

?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<!-- <div class="card-title"> -->
					<div class="row">
						<div class="col-8">
							<h2 class="description-header">Stok</h2>
						</div>
						<div class="col-4">
              				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-produk">Tambah Produk</button>
							<a href="php/export/export_produk_kadaluarsa.php" class="btn btn-primary">Export</a>
							<a href="php/export/print_katalog.php" class="btn btn-default">Katalog</a>
						</div>
					</div>

				<!-- </div> -->
			</div>
			<div class="card-body">
				<!-- <div class="row">
					<div class="col-lg-5">
						<label>Barang</label>
						<select class="form-control select2" name="id_produk" id="nama_produk_stok">
							<option disabled="" selected="">pilih produk</option>
							<?php foreach ($produk as $key => $value): ?>
								<option value="<?php echo $value['id_produk'] ?>" > <?php echo $value['nama_produk']." - ".$value['nama_umkm'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-lg-5">
						<label>Jumlah Stok</label>
						<input type="number" readonly="" name="stok" class="form-control" id="stok">
					</div>
					<div class="col-lg-2">
						<div class="form-group">
						<br>
						<button class="btn btn-default" id="btn-min" data-target="#modal-tambah" data-toggle="modal"><i class="fa fa-minus"></i></button>
						<button class="btn btn-default" id="btn-plus" data-target="#modal-tambah" data-toggle="modal"><i class="fa fa-plus" ></i></button>
						</div>
					</div>
				</div> -->
				<hr>
				<!-- <div class="row">
					<div class="col-lg-12">
						<table class="table">
							<thead>
								<th>No</th>
								<th>Tanggal</th>
								<th>Barang</th>
								<th>Jumlah</th>
								<th>Keterangan</th>	
							</thead>
							<tbody>
								<?php $no=0; foreach ($dataajust as $key => $value): $no++ ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['tanggal_purchase'] ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['jenis_purchase'] ?>  <?php echo $value['jumlah_barang_purchase'] ?></td>
									<td><?php echo $value['keterangan_purchase'] ?></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div> -->
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
								<th>Action</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($produk as $key => $value): $no++ ?>
								<?php
									$purchase = $db->manual_query("select jumlah_barang_purchase, DATE_FORMAT(exp_date, '%d-%m-%Y') exp_date from purchase where jenis_purchase = '+' and id_barang = ".$value['id_produk']." and exp_date > now() order by exp_date asc limit 1");
									$exp = $purchase ? $purchase[0]['exp_date'] : '-';
									$expired = $db->manual_query("select sum(jumlah_barang_purchase) sum from purchase where id_barang = ".$value['id_produk']." and jenis_purchase='+' and exp_date <= now() and exp_date != '0000-00-00'");
									// echo json_encode($expired[0]['sum']);
									// exit;
								?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<!-- <td><?php echo $value['jumlah_stok'] - ($expired && $expired[0]['sum'] ? $expired[0]['sum'] : 0) ?></td> -->
									<td><?php echo $value['total_stok'] ?></td>
									<td><?php echo $value['nama_umkm'] ?></td>
									<td><?php echo $value['exp_date']??'-' ?></td>
									<td><?php echo $value['harga_produk'] ?></td>
									<td>
										<!-- <a href="#" data-toggle="modal" data-target="#modal-edit-produk-<?php echo $value['id_produk'] ?>">Edit</a> -->
										<button class="btn btn-primary" data-target="#modal-edit-produk-<?php echo $value['id_produk'] ?>" data-toggle="modal"> Edit</button>
										<button class="btn btn-success" data-target="#modal-tambah-<?php echo $value['id_produk'] ?>" data-toggle="modal"> Stok</button>

										<div class="modal" id="modal-tambah-<?php echo $value['id_produk'] ?>" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title"><span id="nama"></span>Stok <?php echo $value['nama_produk'] ?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="php/stok.php">
														<div class="form-group form-group-lg">
															<label>Stok Awal</label>
															<input type="number" class="form-control" name="stok_awal" value="<?php echo $value['total_stok'] ?>" aria-label="Disabled input example" disabled readonly>
														</div>
														<div class="form-group form-group-lg">
															<label>Jumlah</label>
															<input type="number" class="form-control" name="jumlah" id="jumlah-tambah">
														</div>
														<div class="form-group form-group-lg">
															<label>Keterangan</label>
															<input type="text" class="form-control" name="keterangan" >
														</div>
														<div class="form-group form-group-lg">
															<label>Tanggal Kadaluarsa (opsional)</label>
															<input type="date" class="form-control" name="exp" >
														</div>
														<input type="hidden" name="id_produk" value="<?php echo $value['id_produk'] ?>">
													</div>
													<div class="modal-footer d-flex bd-highlight mb-3" style="width:100%">
															<button type="button" class="btn btn-secondary mr-auto p-2 bd-highlight" data-dismiss="modal">Close</button>
															<button class="btn btn-danger p-2 bd-highlight" name="min" id="btn-min"><i class="fa fa-minus"></i></button>
															<button class="btn btn-success p-2 bd-highlight" name="plus" id="btn-plus"><i class="fa fa-plus" ></i></button>
														</div>
														<!-- <button  class="btn btn-primary" id="kirim-stok">Save changes</button> -->
													</form>
												</div>
												</div>
											</div>
										</div>
									</td>
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


<?php foreach ($produk as $key => $value): ?>
<div class="modal" id="modal-edit-produk-<?php echo $value['id_produk'] ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="php/produk.php" enctype="multipart/form-data">
          <input type="hidden" name="from" value="">
          <input type="hidden" name="id_produk" value="<?php echo $value['id_produk'] ?>">
          <input type="hidden" name="edit" >
          <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" value="<?php echo $value['nama_produk'] ?>">
          </div>
		  <div class="form-group">
            <label>Stok Produk</label>
            <input type="text"  class="form-control" name="stok_produk" value="<?php echo $value['jumal_stok_awal'] ?>">
          </div>
          <div class="form-group">
            <label>Harga Produk</label>
            <input type="text"  class="form-control" name="harga_produk" value="<?php echo $value['harga_produk'] ?>">
          </div>
          <div class="form-group">
            <label>Satuan Produk</label>
            <input type="text" class="form-control" name="satuan_produk" value="<?php echo $value['satuan_produk'] ?>">
          </div>
          <!-- <div class="form-group" >
            <label>Produksi Produk / Bulan</label>
            <input type="text" class="form-control" name="produksi_produk" value="<?php echo $value['produksi_produk'] ?>">
          </div> -->
		  <!-- <div class="form-group" >
            <label>Tanggal Kadaluarsa</label>
			<input type="date" name="tanggal-exp" id="tanggal-exp" class="form-control" required="" value="<?php echo $value['tgl_exp'] ?>">
          </div> -->
          <div class="form-group">
            <label>Kategori Produk</label>
            <select class="form-control" name="kategori_produk">
              <option value="" >Pilih Kategori ... </option>
              <?php foreach ($newkategori as $k => $v): ?>
                <option value="<?php echo $k ?>" <?php if ($value['kategori_produk'] == $k): ?>
                  selected
                <?php endif ?>><?php echo $v ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Foto Produk</label>
            <input type="file" name="foto_produk" accept="image/*">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
<?php endforeach ?>

<div class="modal" id="modal-tambah-produk" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="php/produk.php" enctype="multipart/form-data">
        	<!-- <input type="hidden" name="id_umkm" value="<?php echo $_GET['id_umkm'] ?>"> -->
        	<input type="hidden" name="insert" >
        	<div class="form-group">
        		<label>UMKM</label>
        		<select class="form-control select2" name="id_umkm" required="">
        			<option value="">Pilih ...</option>
        			<?php foreach ($umkm as $key => $value): ?>
        				<option value="<?php echo $value['id_umkm'] ?>"><?php echo $value['nama_umkm'] ?></option>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>Nama Produk</label>
        		<input type="text" required="" class="form-control" name="nama_produk">
        	</div>
			<div class="form-group">
        		<label>Stok Produk</label>
        		<input type="text" required="" class="form-control" name="stok_produk">
        	</div>
        	<div class="form-group">
        		<label>Harga Produk</label>
        		<input type="text" required="" class="form-control" name="harga_produk">
        	</div>
        	<div class="form-group">
        		<label>Satuan Produk</label>
        		<input type="text" required="" class="form-control" name="satuan_produk">
        	</div>
        	<!-- <div class="form-group" >
        		<label>Produksi Produk / Bulan</label>
        		<input type="text" required="" class="form-control" name="produksi_produk">
        	</div> -->
			<!-- <div class="form-group" >
				<label>Tanggal Kadaluarsa</label>
				<input type="date" name="tanggal-exp" id="tanggal-exp" class="form-control" required="" value="<?php echo $value['tgl_exp'] ?>">
			</div> -->
        	<div class="form-group">
        		<label>Kategori Produk</label>
        		<select class="form-control" required="" name="kategori_produk">
        			<option value="" disabled="" selected>Pilih Kategori ... </option>
        			<?php foreach ($newkategori as $key => $value): ?>
        				<option value="<?php echo $key ?>"><?php echo $value ?></option>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>Foto Produk</label>
        		<input type="file" name="foto_produk" accept="image/*">
        	</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>