<?php 

require_once '../config/db.php';
// print_r($_GET);
$db = new db();
session_start();
if (isset($_GET['checkout'])) {
	# code...
	$dataproduk = json_decode(json_encode($_SESSION['cart']), FALSE) ;
	$_SESSION['cart'] = null;
	// print_r($dataproduk);
	// die();
}else{
	$dataproduk = json_decode($_GET['dataproduk']);
}
// print_r($dataproduk);
$data  = array(
	'jenis_transaksi' => '-', 
	'id_user' => '', 
	'keterangan_transaksi' => 'pembelian', 
	'pembayaran_transaksi' => $_GET['pembayaran']
);
$db->insert("transaksi",$data);
$id_transaksi = mysqli_insert_id($db->res);
// $id_transaksi;
$tmptotal = 0;
// print_r($dataproduk);
foreach ($dataproduk as $key => $value) {
	# code...
	// print_r($value);
	if (isset($value->id_produk)) {
		# code...
		// echo "masuk";
		$datapurchase  = array(
			'id_barang' => $value->id_produk, 
			'jumlah_barang_purchase' => $value->jumlah_produk, 
			'harga_satuan_barang_purchase' => $value->harga_produk, 
			'harga_total_purchase' => $value->harga_total, 
			'id_transaksi' => $id_transaksi, 
			'jenis_purchase' => "-", 
			'diskon_purchase' => $value->diskon_purchase,
			'keterangan_purchase' => "pembelian",
		);
		$tmptotal += $value->harga_total;
		$datastok = $db->manual_query("select * from stok where id_produk = ".$value->id_produk)[0];
		$stok = $datastok['jumlah_stok'] - $value->jumlah_produk;   
		$db->edit("stok","jumlah_stok",$stok,"id_produk",$value->id_produk);
		$db->insert("purchase",$datapurchase);
	}
}
$db->edit("transaksi","harga_total_transaksi",$tmptotal,"id_transaksi",$id_transaksi);

if ($_GET['id_voucher'] != "") {
	# code...
	$db->edit("voucher","id_transaksi",$id_transaksi,"id_voucher",$_GET['id_voucher']);
	$db->edit("voucher","status_voucher",1,"id_voucher",$_GET['id_voucher']);

}
if ($_GET['diskon_transaksi'] != "" || $_GET['diskon_transaksi'] != 0 ) {
	# code...
	$db->edit("transaksi","diskon_transaksi",$_GET['diskon_transaksi'],"id_transaksi",$id_transaksi);

}
header("Location: export/print_nota.php?id=".$id_transaksi);
// $db->manual_query("update transaksi set harga_total_transaksi = ".$tmptotal." where id_transaksi = ".$id_transaksi);
?>