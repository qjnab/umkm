<?php 
$kategori = $db->manual_query('select * from kategori');

$binaan = $db->manual_query('select * from binaan');
// var_dump($kategori)
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h3>Input data UMKM</h3>
			</div>
			<div class="card-body">
				<form action="php/umkm.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Nama UMKM *</label>
								<input type="text" name="nama_umkm" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Kategori *</label>
								<select class="form-control"  name="kategori_umkm" required="">
									<option disabled="" selected="" value="">Pilih kategori</option>
									<?php foreach ($kategori as $key => $value): ?>
									<option value="<?php echo $value['id_kategori'] ?>"><?php echo $value['nama_kategori'] ?></option>	
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label>Umkm Binaan *</label>
								<select class="form-control"  name="binaan_umkm" required="">
									<option disabled="" selected="" value="">Pilih Tempat Binaan</option>
									<?php foreach ($binaan as $key => $value): ?>
									<option value="<?php echo $value['id_binaan'] ?>"><?php echo $value['nama_binaan'] ?></option>	
									<?php endforeach ?>
								</select>
							</div>
							<!-- <div class="form-group">
								<label>Jenis Izin Usaha </label>
								<input type="text" name="jenis_izin_usaha_umkm" class="form-control" >
							</div> -->
							<div class="form-group" >
								<label>Omset Perbulan *</label>
								<input type="text" name="omset_perbulan_umkm" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Tahun Berdiri </label>
								<input type="text" name="tahun_berdiri_umkm" class="form-control"  >
							</div>
							<div class="form-group">
								<label>Anggota UMKM </label>
								<input type="number" name="anggota_umkm" class="form-control"  >
							</div>
							<div class="form-group">
								<label>Produk Unggulan UMKM *</label>
								<input type="text" name="produk_unggulan_umkm" class="form-control"  required="">
							</div>
							<div class="form-group">
								<label>Produksi Per bulan *</label>
								<input type="text" name="produksi_umkm" class="form-control"  >
							</div>
							<div class="form-group">
								<label>Harga Produk UMKM *</label>
								<input type="text" name="harga_produk_umkm" class="form-control"  >
							</div>	
							<div class="form-group">
								<label>Pelatihan UMKM </label>
								<input type="text" name="pelatihan_umkm" class="form-control"  >
							</div>
							<div class="form-group">
								<label>Pameran / Event UMKM </label>
								<input type="text" name="seminar_umkm" class="form-control"  >
							</div>
							<div class="form-group">
								<label>Nama Pemilik *</label>
								<input type="text" name="nama_pemilik_umkm" class="form-control" required="" >
							</div>
							<div class="form-group">
								<label>NIK Pemilik *</label>
								<input type="text" name="nik_umkm" class="form-control" required="" >
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Umur Pemilik UMKM </label>
										<input type="number" name="umur_umkm" class="form-control" >
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Jenis Kelamin *</label>
										<select class="form-control" name="jenis_kelamin_umkm"  >
											<option>Pilih ... </option>
											<option>Laki - Laki</option>
											<option>Perempuan</option>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Alamat Pemilik *</label>
										<input type="text" name="alamat_ktp_umkm" class="form-control" required="" >
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Gang / Blok Rumah *</label>
										<input type="text" name="gang_blok_umkm" class="form-control" required="">
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label>No Rumah *</label>
										<input type="text" name="no_rumah_umkm" class="form-control" required="">
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label>RT *</label>
										<input type="text" name="rt_umkm" class="form-control" required="">
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label>RW  *</label>
										<input type="text" name="rw_umkm" class="form-control" required="">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Kelurahan Pemilik *</label>
										<input type="text" name="kelurahan_umkm" class="form-control" required="">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Kecamatan UMKM *</label>
										<input type="text" name="kecamatan_umkm" class="form-control" required="" value="<?php echo $_SESSION['kecamatan'] ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>No HP *</label>
								<input type="text" name="no_hp_umkm" class="form-control" required="">
							</div>
						</div>
						<!-- <div class="col-6">
							<div class="form-group">
								<label>Foto Pemilik UMKM</label>
								<input type="file" accept="image/*" name="foto_pemilik_umkm" class="form-control" >
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Foto KTP </label>
								<input type="file" accept="image/*" name="foto_ktp_pemilik_umkm" class="form-control" >
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Foto Produk UMKM </label>
								<input type="file" accept="image/*" name="foto_produk_umkm" class="form-control" >
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Foto TTD UMKM </label>
								<input type="file" accept="image/*" name="foto_ttd_umkm" class="form-control" >
							</div>
						</div> -->
						<div class="col-lg-12">
							<button type="submit" name="insert" class="btn btn-info float-right">Kirim</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>