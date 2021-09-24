<?php
$dataumkm = $db->manual_query("select * from umkm where id_umkm = ".$_GET['id'])[0];
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h3>Upload foto UMKM <?php echo $dataumkm['nama_umkm'] ?></h3> 
				<div class="card-tools">
					<a class="btn btn-warning" href="index.php?content=profile_umkm&id_umkm=<?php echo $dataumkm['id_umkm'] ?>">Kembali</a>
				</div>
			</div>
			<div class="card-body">
				<form action="php/umkm.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $dataumkm['id_umkm'] ?>">
				<input type="hidden" name="nama_umkm" value="<?php echo $dataumkm['nama_umkm'] ?>">	
				<input type="hidden" name="nik_umkm" value="<?php echo $dataumkm['nik_umkm'] ?>">	
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label>Foto Pemilik UMKM</label>
							<input type="file" accept="image/*" name="foto_pemilik_umkm" class="form-control"  >
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Foto KTP </label>
							<input type="file" accept="image/*" name="foto_ktp_pemilik_umkm" class="form-control" >
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Foto Produk UMKM </label>
							<input type="file" accept="image/*" name="foto_produk_umkm" class="form-control" >
						</div>
					</div>
					<!-- <div class="col-6">
						<div class="form-group">
							<label>Foto TTD UMKM </label>
							<input type="file" accept="image/*" name="foto_ttd_umkm" class="form-control" >
						</div>
					</div> -->
					<div class="col-lg-12">
						<button type="submit" name="edit" class="btn btn-info float-right">Simpan</button>
					</div>
				</form>
				</div>
				<hr>
				<div class="row">
					<table class="table data-table-responsive">
						<thead>
							<th>Keterangan Foto</th>
							<th>Foto</th>
							<!-- <th>Action</th> -->
						</thead>
						<tbody>
							<tr>
								<td>Foto Pemilik UMKM</td>
								<td><img style="max-width: 100px;max-height: 100px" src="php/images/<?php echo $dataumkm['foto_pemilik_umkm'] ?>"></td>
								<!-- <td></td> -->
							</tr>
							<tr>
								<td>Foto KTP Pemilik UMKM</td>
								<td><img style="max-width: 100px;max-height: 100px" src="php/images/<?php echo $dataumkm['foto_ktp_pemilik_umkm'] ?>"></td>
								<!-- <td></td> -->
							</tr>
							<tr>
								<td>Foto Produk UMKM</td>
								<td><img style="max-width:100px;max-height: 100px" src="php/images/<?php echo $dataumkm['foto_produk_umkm'] ?>"></td>
								<!-- <td></td -->
							</tr>
							<tr>
								<td>Foto TTD UMKM</td>
								<td><img style="max-width: 100px;max-height: 100px" src="php/images/<?php echo $dataumkm['foto_ttd_umkm'] ?>"></td>
								<!-- <td></td> -->
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>