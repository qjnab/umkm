<?php 
$kategori = $db->manual_query("select * from kategori");
foreach ($kategori as $key => $value) {
	# code...
	$newproduk[$value['nama_kategori']] = $db->manual_query("select * from produk left join diskon on diskon.id_produk = produk.id_produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1 and kategori_produk = ".$value['id_kategori'].' order by nama_produk');
}
$produk = $db->manual_query("select * from produk left join diskon on diskon.id_produk = produk.id_produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						<h2 class="description-header"><b>Katalog</b></h2>
					</div>
					<div class="col-2">
						<input type="text" class="form-control float-right" name="-" id="search-nama" placeholder="cari" >
					</div>
				</div>
			</div>
<!-- 				<?php $count = 0; ?>
				<div class="row">
				<?php foreach ($produk as $key => $value): $count++; ?>
					<div class="col-lg-2 col-6 col-md-2 col-sm-4 ">
						<div class="card">
							<div class="clickable" role="button" data-toggle="modal" data-target="#produk-<?php echo $value['id_produk'] ?>">	
							  <img src="dist/img/default-150x150.png" alt="Avatar" width="100%" height="100%">
							</div>
							  <div class="container">
							    <b><?php echo $value['nama_produk'] ?></b>
							    <?php $harga[$value['id_produk']] = $value['harga_produk'] -  ( ($value['harga_produk'] * $value['jumlah_diskon'] )/100 ) ?>
							    <?php if ($value['jumlah_diskon'] != "" && $value['jumlah_diskon'] != 0 ): ?>
							    	<p><s>Rp. <?php echo number_format($value['harga_produk']) ?></s> -> Rp. <?php echo number_format($harga[$value['id_produk']]) ?></p>
							    <?php else: ?>
								    <p>Rp. <?php echo number_format($harga[$value['id_produk']]) ?></p>
							    <?php endif ?>
							  </div>
						</div>
					</div>
					<?php if ($count >5): $count = 0; ?>
						</div><div class="row">
					<?php endif ?>
				<?php endforeach ?>
				</div> -->
		</div>
	</div>
</div>
<?php foreach ($produk as $key => $value): ?>
	<div class="modal" tabindex="-1" id="produk-<?php echo $value['id_produk'] ?>" role="dialog">
  		<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title">Produk Detail</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body">
      				<div class="row">
      					<div class="col-lg-8 col-12">
      						<img loading="lazy" src="php/images/produk/<?php echo $value['foto_produk'] ?>" class="center" style="max-width: 100%;max-height: 100%">
      					</div>
						<div class="col-lg-4 col-12">
							<div class="form-group">
								<label>Nama Barang</label>
								<input type="text" class="form-control" name="nama_produk" value="<?php echo $value['nama_produk'] ?>" readonly >
							</div>
							<div class="form-group">
								<label>Diskon</label>
								<input type="text" class="form-control" name="diskon_produk" value="<?php echo $value['jumlah_diskon'] ?> %" readonly id="dsc-<?php echo $value['id_produk'] ?>" >
							</div>
							<div class="form-group">
								<label>Harga Barang</label>
								<input type="text" class="form-control" name="harga_produk" value="<?php echo number_format($harga[$value['id_produk']]) ?>" readonly id="hrg-<?php echo $value['id_produk'] ?>" >
							</div>
							<div class="form-group">
								<label>Stok Barang</label>
								<input type="text" class="form-control" name="stok_produk" value="<?php echo $value['jumlah_stok']." ".$value['satuan_produk'] ?> " readonly >
							</div>
      					</div>
      				</div>
        		</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
    		</div>
  		</div>
	</div>	
<?php endforeach ?>

