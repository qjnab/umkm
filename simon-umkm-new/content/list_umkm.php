<?php 
$kecamatan_umkm = "";
$query = "select * from umkm inner join kategori on umkm.kategori_umkm = kategori.id_kategori inner join binaan on umkm.binaan_umkm = binaan.id_binaan";
$kecamatan = $db->manual_query("SELECT DISTINCT kecamatan_umkm FROM umkm order by kecamatan_umkm");
if (isset($_GET['kecamatan_umkm']) && $_GET['kecamatan_umkm'] != "") {
	$query .= " and kecamatan_umkm = '".$_GET['kecamatan_umkm']."'";
	$kecamatan_umkm = $_GET['kecamatan_umkm'];
}elseif ($_SESSION['kecamatan'] != "") {
	# code...
	$query .= " and kecamatan_umkm = '".$_SESSION['kecamatan']."'";
	$kecamatan_umkm = $_SESSION['kecamatan'];
	$kecamatan = null;
	$kecamatan[0]['kecamatan_umkm'] = $_SESSION['kecamatan'];
}

// echo $query;
$umkm = $db->manual_query($query);

?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-gradient-info">
				<div class="row">
					<div class="col-4">
						<span class="card-title">Daftar UMKM</span>
					</div>
					<div class="col-4">
						<span class="card-title float-right">Kecamatan</span>
					</div>
					<div class="col-4">
						<div class="form-gorup">
							<select class="form-control float-right " name="kecamatan_umkm" id="kecamatan_umkm">
								<?php foreach ($kecamatan as $key => $value): ?>
									<option <?php if ($kecamatan_umkm == $value['kecamatan_umkm'] ): ?>
										selected
									<?php endif ?>><?php echo $value['kecamatan_umkm'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<!-- <div class="col-2">
						
						<a class="btn btn-default float-right" href="php/export/list_umkm.php">Download</a>
					</div> -->
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<table class="table data-table-responsive">
							<thead>
								<th>No</th>
								<th>Nama UMKM</th>
								<th>Nama Pemilik UMKM</th>
								<th>Alamat UMKM</th>
								<th>Produk</th>
								<th>Kategori UMKM</th>
								<th>Kecamatan UMKM</th>
								<th>Registrasi</th>
								<th>Act</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($umkm as $key => $value): $no++; ?>
									<tr class="clickable" onclick="location.href='index.php?content=profile_umkm&id_umkm=<?php echo($value["id_umkm"]) ?>'">
										<td><?php echo $no ?></td>
										<td><?php echo $value['nama_umkm'] ?></td>
										<td><?php echo $value['nama_pemilik_umkm'] ?></td>
										<!-- <td><?php echo $value['nama_kategori'] ?></td> -->
										<td><?php echo $value['alamat_ktp_umkm']." ".$value['gang_blok_umkm']." ".$value['no_rumah_umkm']." ,".$value['kelurahan_umkm']." , ".$value['kecamatan_umkm'] ?></td>
										<td><?php echo $value['produk_unggulan_umkm'] ?></td>
										<?php 
											// $produk = $db->manual_query("select nama_produk from produk where id_umkm = ".$value['id_umkm']);
											// $total = count($produk);
											// $count = 1;
										?>
										<!-- <td>
											<?php foreach ($produk as $k => $v): ?>
												<?php if ($count == $total): ?>
													<?php echo $v['nama_produk']."." ?>
												<?php else: ?>
													<?php echo $v['nama_produk']." , " ?>
												<?php endif ?>
												<?php $count ++ ?>
											<?php endforeach ?>
										</td> -->
										<td><?php echo $value['nama_kategori'] ?></td>
										<td><?php echo $value['kecamatan_umkm'] ?></td>
										<td><?php echo $value['tanggal_input_umkm'] ?></td>
										<td><a href="index.php?content=edit_umkm&id=<?php echo($value['id_umkm']) ?>">Edit</a> |  <a href="php/umkm.php?delete=&id=<?php echo($value['id_umkm']) ?>" onclick="return confirm('Yakin Hapus?')">Hapus</a></td>
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