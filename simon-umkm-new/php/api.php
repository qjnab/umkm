<?php 
require_once '../config/db.php';
$db = new db();
session_start();
if (isset($_GET['get_barang'])) {
	// echo "select * from produk inner join stok on produk.id_produk = stok.id_produk  where produk.id_produk = ".$_GET['id'];

	// query lama
	// $produk = $db->manual_query("select * from produk left join diskon on diskon.id_produk = produk.id_produk inner join stok on produk.id_produk = stok.id_produk  where produk.id_produk = ".$_GET['id']);

	// query baru
	$produk = $db->manual_query("select produk.id_produk, produk.nama_produk, produk.foto_produk, produk.harga_produk, diskon.id_diskon, diskon.jumlah_diskon, stok.jumlah_stok, ((select sum(p1.jumlah_barang_purchase) from purchase p1 where p1.id_barang = produk.id_produk and p1.jenis_purchase = '+') - (select sum(p2.jumlah_barang_purchase) sum from purchase p2 where p2.id_barang = produk.id_produk and ((p2.jenis_purchase = '-') or (p2.exp_date <= now() and p2.exp_date != '0000-00-00')))) total_stok from produk left join diskon on diskon.id_produk = produk.id_produk inner join stok on produk.id_produk = stok.id_produk where produk.id_produk = ".$_GET['id']);

	if ($produk !== null) {
		# code...
		echo json_encode($produk);
	}else{
		echo json_encode("gagal");
	}
}
if (isset($_GET['post_nota'])) {
	# code...
	print_r($_POST);
}
if (isset($_GET['purchase'])) {
	# code...
	$purchase = $db->manual_query("select * from purchase inner join produk on produk.id_produk = purchase.id_barang where id_transaksi = ".$_GET['id']);
	echo json_encode($purchase);
}
if (isset($_GET['transaksi'])) {
	# code...
	$transaksi = $db->manual_query("select * from transaksi where id_transaksi = ".$_GET['id'])[0];
	echo json_encode($transaksi);
}
if (isset($_GET['get_stok'])) {
	# code...
	$stok = $db->manual_query("select * from stok where id_produk = ".$_GET['id'])[0];
	echo json_encode($stok);
}

if (isset($_GET['add_cart'])) {

	$_SESSION['cart'][$_GET['id']]  = array( 
			'id_produk' => $_GET['id'], 
			'jumlah_produk' => $_GET['jumlah'], 
			'harga_produk' => $_GET['harga_satuan'], 
			'harga_total' => $_GET['harga_total'], 
			'diskon_purchase' =>  $_GET['diskon']
		);
	return "Berhasil Ditambakan Ke Cart";
	# code...
}

if (isset($_GET['clear-nota'])) {
	# code...
	$_SESSION['cart'] = null;
	// unset($_SESSION['cart']);
}
?>