<?php //var_dump($_GET)
$profile = $db->manual_query("select * from umkm where umkm.id_umkm = ".$_GET['id_umkm'])[0];
// var_dump($profile);
$kategori = $db->manual_query("select * from kategori");
foreach ($kategori as $key => $value) {
	# code...
	$newkategori[$value['id_kategori']] = $value['nama_kategori'];
}
$produk = $db->manual_query("select * from produk where id_umkm = ".$_GET['id_umkm']." ");
$perizinan = $db->manual_query("select * from perizinan where id_umkm = ".$_GET['id_umkm']." ");
?>
<div class="row">
	<div class="col-12">
		<div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h5 class="widget-user-desc"><?php echo $profile['nama_umkm'] ?></h5>
      </div>
      <div class="widget-user-image " data-toggle="modal" data-target="#modal-foto-pemilik">
        <img class="img-circle elevation-2 clickable" src="php/images/<?php echo $profile['foto_pemilik_umkm'] ?>" alt="User Avatar">
      </div>
          
      <div class="card-footer"><br>
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <span class="description-text">Omset</span>
              <h5 class="description-header"><?php echo number_format($profile['omset_perbulan_umkm']) ?></h5>
            </div>
                <!-- /.description-block -->
          </div>
              <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <span class="description-text">Kategori</span>
              <h5 class="description-header"><?php echo $newkategori[$profile['kategori_umkm']] ?></h5>
            </div>
                <!-- /.description-block -->
          </div>
              <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <span class="description-text">Produk</span>
              <h5 class="description-header"><?php echo $produk!=null ? sizeof($produk):"0"; ?></h5>
            </div>
                <!-- /.description-block -->
          </div>
              <!-- /.col -->
        </div>
            <!-- /.row -->
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-sm-12">
          	<div class="card">
          		<div class="card-header bg-gradient-info">
          			<span class="description-header"><b>Profile UMKM</b></span>
          			<div class="card-tools">
                  <a href="index.php?content=edit_umkm&id=<?php echo($_GET['id_umkm']) ?>" class='btn btn-success btn-sm'> Edit Data</a>
                  <a href="index.php?content=upload_foto_umkm&id=<?php echo($_GET['id_umkm']) ?>" class='btn btn-success btn-sm'> Upload Foto</a>
			            <button class="btn btn-info btn-sm" id="bt-sign" data-toggle="modal" data-target="#modal-tandatangan">Sign</button>
          				<button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#modal-perizinan">
                    Kelola Perizinan
                  </button>
                  <a href="php/export/print_formulir.php?id=<?php echo $_GET['id_umkm'] ?>" class='btn btn-success btn-sm'> Cetak Form</a>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
				            <i class="fas fa-minus"></i>
				          </button>
          			</div>
          		</div>
          		<div class="card-body">
          			<div class="row">
	          			<div class="col-12">
	          				<table class="table">
	          					<tr>
	          						<td>Nama UMKM</td>
	          						<td> : </td>
	      								<td><?php echo $profile['nama_umkm'] ?></td>
	      							</tr>
        							<tr>
	          						<td>Kategori UMKM</td>
	          						<td> : </td>
	          						<td><?php echo $newkategori[$profile['kategori_umkm']] ?></td>
	          					</tr>
	      							<tr>
	      								<td>Omset UMKM</td>
        								<td> : </td>
	          						<td><?php echo number_format($profile['omset_perbulan_umkm']) ?> / Bulan</td>
	          					</tr>
	          					<tr>
	          						<td>Produk Unggulan UMKM</td>
	      								<td> : </td>
	      								<td><?php echo $profile['produk_unggulan_umkm'] ?></td>
        							</tr>
	          					<tr>
	          						<td>Harga Produk UMKM</td>
	          						<td> : </td>
	        							<td><?php echo $profile['harga_produk_umkm'] ?></td>
	      							</tr>
	          					<tr>
	          						<td>Nama Pemilik UMKM</td>
	          						<td> : </td>
	          						<td><?php echo $profile['nama_pemilik_umkm'] ?></td>
	          					</tr>
	          					<tr>
	          						<td>Alamat Pemilik UMKM</td>
	      								<td> : </td>
	      								<td><?php echo $profile['alamat_ktp_umkm']." ".$profile['gang_blok_umkm']." ".$profile['no_rumah_umkm']." ,".$profile['kelurahan_umkm']." , ".$profile['kecamatan_umkm'] ?></td>
        							</tr>
	          				</table>
	          			</div>
          			</div><hr>
          			<div class="row">
          				<div class="col-4" align="center">
      				  		<label>KTP</label><br>
          					<button class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal-foto-ktp-pemilik"><i class="fa fa-id-card"></i></button>
          				</div>
          				<div class="col-4" align="center">
          					<label>Produk</label>
      							<br>
          					<button class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal-foto-produk-unggulan"><i class="fa fa-cookie"></i></button>
          				</div>
          				<div class="col-4" align="center">
      							<label>Pemilik</label>
    								<br>
        							<button class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal-foto-pemilik"><i class="fa fa-user-tie"></i></button>
      						</div>
       					</div>
          		</div>
          	</div>
          </div>	
          <div class="col-lg-6 col-sm-12">
          	<div class="card">
        			<div class="card-header bg-gradient-success">
      					<span class="description-header"><b>Produk UMKM</b></span> 
      					<button class="btn btn-default float-right btn-sm" data-toggle="modal" data-target="#modal-tambah-produk"><i class="fa fa-plus"></i></button>
          		</div>
          		<div class="card-body">
      					<table class="table data-table-responsive" style="width: 100%" >
      						<thead>
          					<th>NO</th>
          					<th>Nama Produk</th>
      							<th>Harga</th>
      							<th>Produksi</th>
                    <th>Action</th>
          				</thead>
          				<tbody>
          					<?php if ($produk != null): ?>
          						<?php $no=0; foreach ($produk as $key => $value): $no++ ; ?>
          							<tr>
          								<td><?php echo "$no"; ?></td>
          								<td id="<?php echo $value['foto_produk'] ?>" data-toggle="modal" data-target="#modal-view" class="row-gambar clickable"><?php echo $value['nama_produk'] ?></td>
          								<td><?php echo number_format($value['harga_produk'] )?></td>
          								<td><?php echo $value['produksi_produk']." ".$value['satuan_produk'] ?></td>
                          <td>
                            <?php if ($profile['binaan_umkm'] == 1): ?>
                              <?php if ($value['status_produk'] == 0): ?>
                                <button class="btn btn-success" onclick="location.href='php/produk.php?jual=<?php echo($value['id_produk']) ?>&umkm=<?php echo($_GET['id_umkm']) ?>'" >Jual</button>
                              <?php else: ?>
                                <button class="btn btn-secondary" onclick="location.href='php/produk.php?tarik=<?php echo($value['id_produk']) ?>&umkm=<?php echo($_GET['id_umkm']) ?>'" >Non Aktif</button>
                              <?php endif ?>
                            <?php else: ?>
                                <button class="btn btn-danger">Hapus</button> 
                            <?php endif ?>
                            <button class="btn btn-primary" role="button" data-toggle="modal" data-target="#modal-edit-produk-<?php echo $value['id_produk'] ?>"><i class="fa fa-edit"></i></button>
                          </td>
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
        	<input type="hidden" name="id_umkm" value="<?php echo $_GET['id_umkm'] ?>">
        	<input type="hidden" name="insert" >
        	<div class="form-group">
        		<label>Nama Produk</label>
        		<input type="text" required="" class="form-control" name="nama_produk">
        	</div>
        	<div class="form-group">
        		<label>Harga Produk</label>
        		<input type="text" required="" class="form-control" name="harga_produk">
        	</div>
        	<div class="form-group">
        		<label>Satuan Produk</label>
        		<input type="text" required="" class="form-control" name="satuan_produk">
        	</div>
        	<div class="form-group" >
        		<label>Produksi Produk / Bulan</label>
        		<input type="text" required="" class="form-control" name="produksi_produk">
        	</div>
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
<div class="modal" id="modal-view" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Gambar Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="gambar-produk" style="max-width: 100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modal-foto-pemilik" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto Pemilik UMKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="php/images/<?php echo $profile['foto_pemilik_umkm'] ?>"  style="max-width: 100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal-foto-ktp-pemilik" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto Ktp Pemilik UMKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="php/images/<?php echo $profile['foto_ktp_pemilik_umkm'] ?>"  style="max-width: 100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal-foto-produk-unggulan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto Produk Unggulan UMKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="php/images/<?php echo $profile['foto_produk_umkm'] ?>"  style="max-width: 100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
          <input type="hidden" name="id_umkm" value="<?php echo $_GET['id_umkm'] ?>">
          <input type="hidden" name="id_produk" value="<?php echo $value['id_produk'] ?>">
          <input type="hidden" name="edit" >
          <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" value="<?php echo $value['nama_produk'] ?>">
          </div>
          <div class="form-group">
            <label>Harga Produk</label>
            <input type="text"  class="form-control" name="harga_produk" value="<?php echo $value['harga_produk'] ?>">
          </div>
          <div class="form-group">
            <label>Satuan Produk</label>
            <input type="text" class="form-control" name="satuan_produk" value="<?php echo $value['satuan_produk'] ?>">
          </div>
          <div class="form-group" >
            <label>Produksi Produk / Bulan</label>
            <input type="text" class="form-control" name="produksi_produk" value="<?php echo $value['produksi_produk'] ?>">
          </div>
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

<div class="modal" id="modal-perizinan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kelola Perizinan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="php/perizinan.php" enctype="multipart/form-data">
          <input type="hidden" name="id_umkm" value="<?php echo $_GET['id_umkm'] ?>">
          <input type="hidden" name="insert" >
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Unit Pengolahan</label>
                <select class="form-control" name="unit_pengolahan_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Terpisah</option>
                  <option value="0">Jadi Satu</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Sertifikasi Halal</label>
                <select class="form-control" name="halal_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Baru</option>
                  <option value="0">Perpanjang</option>
                </select>
              </div>
              <div class="form-group">
                <label>SKP</label>
                <select class="form-control" name="skp_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Baru</option>
                  <option value="0">Perpanjang</option>
                </select>
              </div>
              <div class="form-group">
                <label>NIB</label>
                <select class="form-control" name="nib_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Ada</option>
                  <option value="0">Tidak Ada</option>
                </select>
              </div>
              <div class="form-group">
                <label>PIRT</label>
                <select class="form-control" name="pirt_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Ada</option>
                  <option value="0">Tidak Ada</option>
                </select>
              </div>
              <div class="form-group">
                <label>IUMK</label>
                <select class="form-control" name="iumk_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Ada</option>
                  <option value="0">Tidak Ada</option>
                </select>
              </div>
              <div class="form-group">
                <label>TDUPHP</label>
                <select class="form-control" name="tduphp_perizinan">
                  <option value="">Pilih ... </option>
                  <option value="1">Ada</option>
                  <option value="0">Tidak Ada</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Sertifikasi Halal</label>
                <input type="file" class="form-control" name="upload_halal_perizinan">
              </div>
              <div class="form-group">
                <label>SKP</label>
                <input type="file" class="form-control" name="upload_skp_perizinan">
              </div>
              <div class="form-group">
                <label>NIB</label>
                <input type="file" class="form-control" name="upload_nib_perizinan">
              </div>
              <div class="form-group">
                <label>PIRT</label>
                <input type="file" class="form-control" name="upload_pirt_perizinan">
              </div>
              <div class="form-group">
                <label>IUMK</label>
                <input type="file" class="form-control" name="upload_iumk_perizinan">
              </div>
              <div class="form-group">
                <label>TDUPHP</label>
                <input type="file" class="form-control" name="upload_tduphp_perizinan">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="modal-tandatangan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Tanda Tangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="wrapper-signature">
          <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
        </div>
        <button id="clear">Clear</button>  
      </div>
      <div class="modal-footer">
        <form id="my-form" action="php/ttd.php" method="post">
          <input type="hidden" id="signature-data" name='foto' />
          <input type="hidden" name="id_umkm" value="<?php echo $_GET['id_umkm'] ?>">
          <button type="button" id="bt-ttd" class="btn btn-primary">Simpan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>