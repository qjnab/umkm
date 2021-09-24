<?php 
if (isset($_GET['bulan']) && isset($_GET['tahun']) ) {
	# code...
	$dataomset = $db->manual_query("select * from omset where bulan_omset = ".$_GET['bulan']." and "." tahun_omset = ".$_GET['bulan']);
	$bulan = $_GET['bulan'];
	$tahun= $_GET['tahun'] ;
}else{

	$omset = $db->manual_query("select * from omset left join umkm on umkm.id_umkm = omset.id_umkm order by id_omset desc");
}
$umkm = $db->manual_query("select * from umkm where binaan_umkm = 1");
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-info">
				<div class="row">
					<div class="col-lg-4">
						<span class="description-header"><b>Laporan Omset</b></span>
					</div>
					<div class="col-lg-8">
						<button class="btn btn-default btn-sm float-right" data-toggle="modal" data-target="#modal-tambah-omset"> <b>Tambah</b></button>
						<button class="btn btn-default btn-sm float-right" data-toggle="modal" data-target="#modal-rekap"> <b>Import</b></button>
					</div>
				</div>
			</div>
			<div class="card-body">
					<form>
					<div class="row">
						<input type="hidden" name="content" value="omset">
						<div class="col-lg-5">
							<div class="form-group">	
							<label>Bulan</label>
							<select name="bulan" class="form-control" required="">
								<option value="">Pilih</option>
								<?php for ($i=0; $i <12 ; $i++) { ?>
									<option><?php echo ($i+1) ?></option>
								<?php } ?>
							</select>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label>Tahun</label>
								<select name="bulan" class="form-control" required="">
								<option value="">Pilih</option>

								<?php for ($i=0; $i <5 ; $i++) { ?>
									<option><?php echo ($i+2021) ?></option>
								<?php } ?>
							</select>
							</div>
							
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-info float-right">Pilih</button> <!-- <button type="button" id="btn-cetak-laporan" class="btn btn-default" id="cetak-laporan-transaksi"><i class="fa fa-print"></i> Cetak</button> -->
						</div>
						<div class="col-lg-2">
							
						</div>
					</div>	
					</form>
				<!-- </div> -->
				<hr>
				<div class="row">
					<div class="col-lg-12">
					<!-- <h5>Total Omset : Rp. <?php echo number_format($omset['omset']) ?></h5> -->
					</div>
					<hr>
					<div class="col-lg-12">
						
					<table class="table data-table-responsive" style="width: 100%">
						<thead>
							<th>Kode</th>
							<th>Umkm</th>
							<th>Minggu</th>
							<th>Bulan</th>
							<th>Tahun</th>
							<th>Omset</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php if (isset($omset)): ?>
								
							<?php $no=0; foreach ($omset as $key => $value): $no++;?>
							<tr>
								<td><?php echo $value['id_omset'] ?></td>
								<td><?php echo $value['nama_umkm'] ?></td>
								<td><?php echo $value['minggu_omset'] ?></td>
								<td><?php echo $value['bulan_omset'] ?></td>
								<td><?php echo $value['tahun_omset'] ?></td>
								<td><?php echo number_format($value['jumlah_omset']) ?>
								</td>
								<td><button class="btn btn-info" data-toggle="modal" data-target="#modal-edit-omset-<?php echo($value['id_omset'])?>"><i class="fa fa-edit"></i></button></td>
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


<div class="modal" id="modal-tambah-omset" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Omset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="php/omset.php">
      	<input type="hidden" name="insert">	
      	<div class="row"> 
      		<div class="col-lg-12">
		      	<div class="form-group">
		      		<label>UMKM</label>
		      		<select class="select2 form-control" name="id_umkm" required="">
		      			<option value="">Pilih</option>
		      			<?php foreach ($umkm as $key => $value): ?>
			      			<option value="<?php echo $value['id_umkm'] ?>"><?php echo $value['nama_umkm'] ?></option>
		      			<?php endforeach ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Minggu</label>
		      		<select class=" form-control" name="minggu_omset" required="">
		      			<option value="">Pilih</option>
		      			<?php for ($i=0; $i <5 ; $i++) { ?>
							<option><?php echo ($i+1) ?></option>
						<?php } ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Bulan</label>
		      		<select class=" form-control" name="bulan_omset" required="">
		      			<option value="">Pilih</option>
		      			<?php for ($i=0; $i <12 ; $i++) { ?>
							<option><?php echo ($i+1) ?></option>
						<?php } ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Tahun</label>
		      		<select class=" form-control" name="tahun_omset" required="">
		      			<option value="">Pilih</option>
		      			<?php for ($i=0; $i <5 ; $i++) { ?>
							<option><?php echo ($i+2021) ?></option>
						<?php } ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Jumlah Omset</label>
		      		<input type="number " class="form-control" name="jumlah_omset" required="">
		      	</div>
      		</div>
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
<?php if (isset($omset)): ?>
<?php foreach ($omset as $key => $value): ?>
<div class="modal" id="modal-edit-omset-<? echo($value['id_omset'])?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Omset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="php/omset.php">
      	<input type="hidden" name="edit" value="">
      	<input type="hidden" name="id_omset" value="<?php echo $value['id_omset'] ?>">	
      	<div class="row"> 
      		<div class="col-lg-12">
		      	<div class="form-group">
		      		<label>UMKM</label>
		      		<input type="text" readonly="" class="form-control" value="<?php echo $value['nama_umkm'] ?>">
		      	</div>
		      	<div class="form-group">
		      		<label>Minggu</label>
		      		<select class=" form-control" name="minggu_omset" required="">
		      			<option><?php echo $value['minggu_omset']?></option>
		      			<?php for ($i=0; $i <5 ; $i++) { ?>
							<option><?php echo ($i+1) ?></option>
						<?php } ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Bulan</label>
		      		<select class=" form-control" name="bulan_omset" required="">
		      			<option><?php echo $value['bulan_omset']?></option>
		      			
		      			<?php for ($i=0; $i <12 ; $i++) { ?>
							<option><?php echo ($i+1) ?></option>
						<?php } ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Tahun</label>
		      		<select class=" form-control" name="tahun_omset" required="">
		      			<option><?php echo $value['tahun_omset']?></option>
		      			
		      			<?php for ($i=0; $i <5 ; $i++) { ?>
							<option><?php echo ($i+2021) ?></option>
						<?php } ?>
		      		</select>
		      	</div>
		      	<div class="form-group">
		      		<label>Jumlah Omset</label>
		      		<input type="number " class="form-control" name="jumlah_omset" required="" value="<?php echo $value['jumlah_omset'] ?>">
		      	</div>
      		</div>
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
<?php endif ?>

<div class="modal" id="modal-rekap" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rekap Dari Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="php/omset.php">
        <input type="hidden" name="import"> 
        	<div class="row">
        		<div class="col-lg-6">
					<div class="form-group">
					<label>Tanggal Mulai</label>
						<input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control" required="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Tanggal Selesai</label>
						<input type="date" name="tanggal-selesai" id="tanggal-selesai" class="form-control" required="">
					</div>
				</div>

				<hr>
				<h2>Import Ke Bulan dan Tahun</h2>
				<div class="col-6">
					<div class="form-group">
			      		<label>Bulan</label>
			      		<select class=" form-control" name="bulan_omset" required="">
			      			<?php for ($i=0; $i <12 ; $i++) { ?>
								<option><?php echo ($i+1) ?></option>
							<?php } ?>
			      		</select>
			      	</div>
				</div>
				<div class="col-6">
			      	<div class="form-group">
			      		<label>Tahun</label>
			      		<select class=" form-control" name="tahun_omset" required="">
			      			<?php for ($i=0; $i <5 ; $i++) { ?>
								<option><?php echo ($i+2021) ?></option>
							<?php } ?>
			      		</select>
			      	</div>
		      	</div>
        	</div>	
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>