<?php 
require_once '../config/db.php';
$db = new db();
if (isset($_POST['insert'])) {
	# code...
	$data  = array(
		'id_produk' => $_POST['id_produk'], 
		'jumlah_diskon' => $_POST['jumlah_diskon']
	);
	$res = $db->insert("diskon",$data);
	header("Location: ../index.php?content=kelola_diskon&pesan=".$res);
}
if (isset($_GET['delete'])) {
	# code...
	$db->delete("diskon","id_diskon",$_GET['id']);
	header("Location: ../index.php?content=kelola_diskon&pesan=Diskon di hapus");
}