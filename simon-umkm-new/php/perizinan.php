<?php 
require_once '../config/db.php';
$db = new db();
session_start();
// print_r($_POST);
// print_r($_FILES);
if (isset($_POST['insert'])) {
	# code...
	// print_r($_POST);
	// echo "delete from perizinan where id_umkm = ".$_POST['id_umkm'];
	// die();
	$db->manual_query("delete from perizinan where id_umkm = ".$_POST['id_umkm']);
	$up = true;
	foreach ($_FILES as $key => $value) {
		# code...
		$filename =  str_replace(" ", "_", $_POST['id_umkm']."_".$key.".pdf");
		$data[$key] = $filename;
		// echo "$filename";
	 
	  // Valid extension
		$valid_ext = array('pdf');

		// Location
		$location = "perizinan/".$filename;

		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower ($file_extension);
		if(in_array($file_extension,$valid_ext)){
			move_uploaded_file($value['tmp_name'], $location);
			// echo "uploaded";
		}else{
			echo "Invalid file type.";
			$up = false;
		}
	}
	// var_dump($up);
	if ($up) {
		foreach ($_POST as $key => $value) {
			# code...
			if ($key != "insert") {
				# code...
				$data[$key] = $value;
			}
		}
		// echo "select id_umkm where nama_umkm = '".$_POST['nama_umkm']."' and nik_umkm = '".$_POST['nik_umkm']."'";
		$db->insert('perizinan',$data);
		$res = $db->manual_query("select nama_umkm,id_umkm from umkm where id_umkm = '".$_POST['id_umkm']."'")[0];
		header("Location: ../index.php?content=profile_umkm&id_umkm=".$res['id_umkm']."&pesan=Umkm ".$res['nama_umkm']." berhasil diubah");
	}else{
		echo "upload gagal";
	}
	// header("Location: index.php?content=profile_umkm&id_umkm=".$_POST['id']);
}