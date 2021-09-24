<?php
require_once '../config/db.php';
$db = new db();
if (isset($_POST['insert'])) {
	# code...
	$data  = array(
		'kode_voucher' => $_POST['kode_voucher'], 
		'tanggal_voucher' => $_POST['tanggal_voucher'],
		'potongan_voucher' => $_POST['potongan_voucher'],
		'status_voucher' => 0

	);
	$res = $db->insert("voucher",$data);
	header("Location: ../index.php?content=kelola_voucher&pesan=".$res);
}


if (isset($_GET['delete'])) {
	// # code...
	// $db->delete("diskon","id_diskon",$_GET['id']);
	// header("Location: ../index.php?content=kelola_diskon&pesan=Diskon di hapus");
}