<?php 
// print_r($_GET);
require_once '../../config/db.php';
$db = new db();

$trx = $db->manual_query('select * from transaksi where id_transaksi = '.$_GET['id']);
$purchase = $db->manual_query("select * from purchase inner join produk on produk.id_produk = purchase.id_barang where id_transaksi = ".$_GET['id']);
$voucher = $db->manual_query('select * from voucher where id_transaksi = '.$_GET['id']);
 
?>
<!DOCTYPE html>
<html>
<head>

	<title></title>
	<basefont color="black" size="2" face="verdana">
	<style type="text/css">

		@media print {
		    body{
		        width: 38mm;
		        /*margin: 2mm 2mm 2mm 2mm; */
		        /* change the margins as you want them to be. */
		   } 
		}
		br {
			   display: block;
			   margin: 10px 0;
			   line-height:22px;
			}
		.ctr {text-align: center;}
		.rght {text-align: right;}
	</style>
</head>
<body>
<!-- <?php  print_r($trx) ?> -->
<!-- <?php print_r($purchase) ?> -->
<!-- <font size="-1">
<div class="ctr"><hr></div>
<?php foreach ($trx as $key => $value): ?>
No Nota : <?php echo $value['id_transaksi'] ?><br>
<?php echo $value['tanggal_transaksi'] ?><br>
<?php $total = $value['harga_total_transaksi'] ?>
<?php endforeach ?>
<div class="ctr"><hr></div>
<?php foreach ($purchase as $key => $value): ?>
<?php echo $value['nama_produk'] ?><br>
<div class="ctr">x <?php echo $value['jumlah_barang_purchase'] ?></div>
<div class="rght"><?php echo $value['harga_satuan_barang_purchase'] ?></div>
<?php endforeach ?>
<div class="ctr"><hr></div>
Total : <?php echo $total ?><br>
<div class="ctr"><hr></div>
</font> -->
<div class="ctr">
	<a href="../../index.php?content=kasir">
		<img style="max-width: 50px;max-height: 50px" src="../../dist/img/logo.jpeg">
	</a>
</div>

<font size="-4">
Dolly Saiki Point <br>
Jl Putat Jaya Lebar B No. 27 , Putat Jaya, Kec. Sawahan, Kota Surabaya, Jawa Timur 60255

</font>	

<hr>
<?php foreach ($trx as $k => $v): ?>
<font size="-2">
Tanggal : <?php echo $v['tanggal_transaksi'] ?>	
<table style="size:100%">
	<tr><td>Nama</td></tr>
	<tr><td style="size: 30%">Harga</td><td  style="size: 20%">Unit</td><td  style="size: 20%">Diskon</td><td colspan="2" style="size: 30%;float: right">Total</td></tr>
	

	<tr><td colspan="4">-----------------------------------------</td></tr>
	<?php foreach ($purchase as $key => $value): ?>
	<tr><td colspan="4"><?php printf ("%20s",$value['nama_produk']); ?></td></tr>
	<tr>
		<td><?php printf ("%10s",number_format($value['harga_satuan_barang_purchase'])); ?></td>
		<td><?php printf ("%4s",number_format($value['jumlah_barang_purchase'])); ?></td>
		<td><?php printf ("%4s%%",number_format($value['diskon_purchase'])); ?></td>
		<td colspan="2" style="float: right"><?php printf ("%10s",number_format($value['harga_total_purchase'])); ?></td>
	</tr>	
	<?php endforeach ?>

</font>
<tr><td colspan="4">-----------------------------------------</td></tr>
<font size="-1">
	<tr>
		<td> </td>
		<td> </td>
		<td>Total</td>
		<td style="float: right"><?php echo number_format($v['harga_total_transaksi']) ?></td>
	</tr>
	<?php 
	$ulang = 0;
	 ?>
	<?php if ($v['diskon_transaksi'] != 0): ?>
	<tr>
		<td> <?php echo $v['diskon_transaksi'] ?> % </td>
		<td> </td>
		<td>Diskon</td>
		<?php 
		$ulang= 1;
		$diskontransaksi = (int) $v['diskon_transaksi'];
		$temp = ($v['diskon_transaksi'] * $v['harga_total_transaksi']) / 100;
		$v['harga_total_transaksi'] = $v['harga_total_transaksi'] - $temp;

		?>
		<td style="float: right">- <?php echo number_format($temp) ?></td>
	</tr>
	<?php endif ?>
	<?php 
		$potongan = 0; 
		if ($voucher) {
			foreach ($voucher as $kvoucher => $valuevoucher): 
				$potongan += $valuevoucher['potongan_voucher'];
				$ulang=1; 
	?>
	<tr>
		<td><?php echo $valuevoucher['kode_voucher']; ?></td>
		<td> </td>
		<td>Voucher</td>
		<td style="float: right">- <?php echo number_format($valuevoucher['potongan_voucher']) ?></td>
	</tr>	
	<?php endforeach;
		} ?>
	<?php if ($ulang): ?>
	<tr>
		<td> </td>
		<td> </td>
		<td> </td>
		<td style="float: right"><?php echo number_format($v['harga_total_transaksi'] - $potongan) ?></td>
	</tr>	
	<?php endif ?>
	<tr>
		<td> </td>
		<td> </td>
		<td>Cash</td>
		<td style="float: right"><?php echo number_format($v['pembayaran_transaksi']) ?></td>
	</tr>
	<tr>
		<td> </td>
		<td> </td>
		<td>Kembalian</td>
		<td style="float: right"><?php 
		$kembalian =  ($v['pembayaran_transaksi'] - $v['harga_total_transaksi']);
		if ($v['harga_total_transaksi'] < $potongan) {
			# code...
			$kembalian = 0 ;			
		}else{

			$kembalian += $potongan;  
		}
		echo number_format($kembalian);  ?></td>
	</tr>
</table>
</font>
<?php endforeach ?>
<hr>
<div class="ctr">
	<font size="-2">
		=== TERIMA KASIH ===<br>
		Dengan Membeli Produk DS Point Anda Turut Berkontribusi Merubah Wajah Dolly Menjadi Lebih Baik
	</font>
</div>
<script type="text/javascript">
	window.print();
	// window.location.href = "../../index.php?content=kasir";
</script>
</body>
</html>