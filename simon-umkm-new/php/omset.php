<?php 
require_once '../config/db.php';
$db = new db();
if (isset($_POST['insert'])) {
	# code...
	$data  = array(
		'id_umkm' => $_POST['id_umkm'], 
		'tahun_omset' => $_POST['tahun_omset'],
		'bulan_omset' => $_POST['bulan_omset'],
		'minggu_omset' => $_POST['minggu_omset'],
		'jumlah_omset' => $_POST['jumlah_omset']


	);
	$res = $db->insert("omset",$data);
	header("Location: ../index.php?content=omset&pesan=".$res);
}

if (isset($_POST['edit'])) {
	# code...
	foreach ($_POST as $key => $value) {
		# code...
		if ($key!="id_omset" && $key!="edit") {
			# code...
			$db->edit("omset","$key",$value,"id_omset",$_POST['id_omset']);
		}
	}
	header("Location: ../index.php?content=omset&pesan=".$res);
}

if (isset($_POST['import'])) {
	print_r($_POST);
}