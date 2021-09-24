<?php 

?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-success">
				<span class="description-header"><b>Checkout</b></span>
				<div class="card-tools">
					<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                </button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<table class="table datatable-nosort">
							<thead>
								<th>Produk</th>
								<th>Jumlah</th>
								<th>Harga satuan</th>
								<th>Diskon</th>
								<th>Harga Total</th>
							</thead>
							<tbody>
								<?php $total =0; foreach ($_SESSION['cart'] as $key => $value): ?>
									<?php 
										$produk = $db->manual_query("select nama_produk from produk where id_produk = ".$key);
										$total += $value['harga_total'];
									 ?>
									<tr>
										<td><?php echo $produk[0]['nama_produk'] ?></td>
										<td><?php echo $value['jumlah_produk'] ?></td>
										<td><?php echo $value['harga_produk'] ?></td>
										<td><?php echo $value['diskon_purchase'] ?></td>
										<td><?php echo $value['harga_total'] ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<h2>PEMBAYARAN : </h2>
						</div>
						<div class="col-lg-6" style="text-align: right">
							<h2>RP. <span id="tagihan"><?php echo $total ?></span></h2>
							
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
						<div class="col-lg-12">
							<button class="btn btn-info float-right" id="checkout-nota">Bayar</button>
							<button class="btn btn-danger float-left" id="cancel-nota">Batal</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>