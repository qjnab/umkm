<?php 
require_once '../config/db.php';
$db = new db();
// echo json_encode($_GET);
// exit;
if (isset($_GET['plus'])) {
	// echo 'o';
	// exit;
	# code...
	// echo "masuk plus";
	// print_r($_GET);
	$datapurchase  = array(
		'id_barang' => $_GET['id_produk'], 
		'jumlah_barang_purchase' => $_GET['jumlah'], 
		'harga_satuan_barang_purchase' => 0, 
		'harga_total_purchase' => 0, 
		'id_transaksi' => 0, 
		'jenis_purchase' => "+",
		'keterangan_purchase' => $_GET['keterangan']
	);

	if (isset($_GET['exp'])) {
		$datapurchase['exp_date'] = $_GET['exp'];
	}
	// echo json_encode($_GET['id_produk']);
	// exit;
	$datastok = $db->manual_query("select * from stok where id_produk = ".$_GET['id_produk'])[0];
		// $stok = 
	$stok = $_GET['jumlah'] + $datastok['jumlah_stok'];   
	
	// echo "$stok";
	// echo "run";
	$db->edit("stok","jumlah_stok",$stok,"id_produk",$_GET['id_produk']);
	$db->insert("purchase",$datapurchase);
	
	header("Location: ../index.php?content=update_stok");
}
// echo 'k';
// exit;
// if (isset($_GET['plus'])) {
// 	# code...
// 	// echo "masuk plus";
// 	// print_r($_GET);
// 	$datastokexp  = array(
// 		'id_produk_exp' => $_GET['id_produk_exp'], 
// 		'produk_name' => $_GET['produk_name'], 
// 		'produk_stok' => $_GET['produk_stok'], 
// 		'tgl_exp' => $_GET['tgl_exp'],
// 	);
// 	$datastok = $db->manual_query("select * from produk_exp where id_produk_exp = ".$_GET['id_produk_exp'])[0];
// 		// $stok = 
// 	$stok = $_GET['jumlah'] + $datastok['jumlah_stok'];   
// 	$stok_exp = $_GET['jumlah'] - $datastok['jumlah_stok'];
// 	// echo "$stok";
// 	// echo "run";
// 	$db->edit("produk_exp","jumlah_stok",$stok,"id_produk_exp",$_GET['id_produk_exp']);
// 	// $db->insert("purchase",$datapurchase);
// 	$db->insert("produk_exp",$datastokexp);
// 	// header("Location: ../index.php?content=update_stok");
// }

if (isset($_GET['min'])) {
	# code...
	// echo "masuk min";
	// print_r($_GET);
	$datapurchase  = array(
		'id_barang' => $_GET['id_produk'], 
		'jumlah_barang_purchase' => $_GET['jumlah'], 
		'harga_satuan_barang_purchase' => 0, 
		'harga_total_purchase' => 0, 
		'id_transaksi' => 0, 
		'jenis_purchase' => "-", 
		'keterangan_purchase' => $_GET['keterangan'], 
		'exp_date' => $_GET['exp_date']
	);
	$datastok = $db->manual_query("select * from stok where id_produk = ".$_GET['id_produk'])[0];
		// $stok = 
	$stok = $datastok['jumlah_stok'] - $_GET['jumlah'] ;   
	$db->edit("stok","jumlah_stok",$stok,"id_produk",$_GET['id_produk']);

	// $db->edit("stok","id_produk",$_GET['id_produk'],"jumlah_stok",$stok);
	$db->insert("purchase",$datapurchase);
	header("Location: ../index.php?content=update_stok");
	
}