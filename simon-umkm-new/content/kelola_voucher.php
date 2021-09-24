<?php 
$voucher = $db->manual_query("select * from voucher left join transaksi on voucher.id_transaksi = transaksi.id_transaksi");
$status[1] = "red";
$status[0] = "white";
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<!-- <div class="card-title"> -->

					<h2 class="description-header">Voucher</h2>
					<button class="btn btn-default float-right" data-toggle="modal" data-target="#modal-tambah-voucher"><i class="fa fa-plus"></i> Tambah</button>
				<!-- </div> -->
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table data-table">
							<thead>
								<th>No</th>
								<th>Kode Voucher</th>
								<th>Masa Berlaku</th>
								<th>Potongan</th>
								<th>Transaksi</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($voucher as $key => $value): $no++; ?>
                  <tr style="background-color: <?php echo $status[$value['status_voucher']] ?>">
                    <td><?php echo $no ?></td>
                    <td><?php echo $value['kode_voucher'] ?></td>
                    <td><?php echo $value['tanggal_voucher'] ?></td>
                    <td><?php echo $value['potongan_voucher'] ?></td>
                    <td><?php echo $value['id_transaksi'] ?> | <button class="btn btn-default" data-toggle="modal" data-target="#modal-transaksi-<?php echo($value['id_transaksi']) ?>"><i class="fa fa-eye"></i></button></td>
                    <?php
                      if ($value['id_transaksi'] != "") {
                        # code...
                        $trx[$value['id_transaksi']] = $db->manual_query('select * from transaksi where id_transaksi = '.$value['id_transaksi'])[0]; 
                      }
                    ?>
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

<div id="modal-tambah-voucher" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<form action="php/voucher.php" method="post">
      		<input type="hidden" name="insert" value="">	
      		<div class="col-lg-12">
      			<div class="form-group">
      				<label>Kode Voucher</label>
      				<input type="text" name="kode_voucher" class="form-control">
      			</div>
      		</div>
      		<div class="col-lg-12">
      			<div class="form-group">
      				<label>Masa Berlaku</label>
      				<input type="date" name="tanggal_voucher" class="form-control">
      			</div>
      		</div>
      		<div class="col-lg-12">
      			<div class="form-group">
      				<label>Potongan</label>
      				<input type="number" name="potongan_voucher" class="form-control">
      			</div>
      		</div>
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
<?php foreach ($trx as $key => $value): ?>
<div class="modal" tabindex="-1" id="modal-transaksi-<?php echo $value['id_transaksi'] ?>" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rincian Transaksi <?php echo $value['id_transaksi'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
          $datatrx = $db->manual_query("select * from purchase inner join produk on produk.id_produk = purchase.id_barang where id_transaksi = ".$value['id_transaksi']);
          // var_dump($datatrx);
        ?>
        <table class="table">
          <thead>
            <th>Kode Brang</th>
            <th>Nama Barang</th>
            <th> </th>
            <th>Total</th>
          </thead>
          <tbody>
            <?php foreach ($datatrx as $k => $val): ?>
              <tr>
                <td><?php echo $val['id_barang'] ?></td>
                <td><?php echo $val['nama_produk'] ?><br><?php echo $val['harga_satuan_barang_purchase'] ?></td>
                <td><br> x <?php echo $val['jumlah_barang_purchase'] ?></td>
                <td><br><?php echo $val['harga_total_purchase'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td><b>TOTAL</b></td>
              <td></td>
              <td></td>
              <td><?php echo $value['harga_total_transaksi'] ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
<?php endforeach ?>  