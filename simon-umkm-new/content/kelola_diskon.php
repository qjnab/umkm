<?php 
$diskon = $db->manual_query("select * from diskon inner join produk on produk.id_produk = diskon.id_produk");
$produk =  $db->manual_query("select * from produk where status_produk = 1");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<!-- <div class="card-title"> -->
					<h2 class="description-header">Diskon</h2>
				<!-- </div> -->
			</div>
			<div class="card-body">
				<form action="php/diskon.php" method="post">
				<input type="hidden" name="insert">	
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label>Produk</label>
							<select required="" class="form-control select2" name="id_produk" id="trigger-produk">
								<option>Pilih Barang</option>
								<?php foreach ($produk as $key => $value): ?>
									<option value="<?php echo $value['id_produk'] ?>"><?php echo $value['id_produk']." - ". $value['nama_produk'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Diskon</label>
						<div class="form-group">
							<input type="number" required="" name="jumlah_diskon" class="form-control" max="100" value="0" step="0.01" id="trigger-diskon">
						</div>
					</div>
					<div class="col-lg-4">
						<label>Harga Diskon</label>
						<div class="form-group">
							<input type="number" name="harga" class="form-control" id="harga-diskon">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<button class="btn btn-success float-right">Input</button>
					</div>
				</div>
				</form>

				<hr>

				<div class="row">
					<div class="col-lg-12">
						<table class="table datatable">
							<thead>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Diskon</th>
								<th>Harga</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($diskon as $key => $value): $no++ ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['jumlah_diskon'] ?> %</td>
									<?php $dsc = $value['harga_produk'] -  ( ($value['harga_produk'] * $value['jumlah_diskon'] )/100 ) ;?>
									<td><?php echo "<s>".number_format($value['harga_produk'])."</s> -> ".number_format($dsc); ?></td>
									<td><a onclick="return confirm('Yakin Hapus ?')" href="php/diskon.php?delete=&id=<?php echo $value['id_diskon'] ?>">Hapus</a></td>
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
