<?php 
require_once '../config/db.php';
$db = new db();
function compressImage($source, $destination, $quality) {

	$info = getimagesize($source);

	if ($info['mime'] == 'image/jpeg') 
	$image = imagecreatefromjpeg($source);

	elseif ($info['mime'] == 'image/gif') 
	$image = imagecreatefromgif($source);

	elseif ($info['mime'] == 'image/png') 
	$image = imagecreatefrompng($source);

	imagejpeg($image, $destination, $quality);

}
if (isset($_POST['insert'])) {
	# code...               
	// print_r($_POST);
	// print_r($_FILES);
	$up = true;
	foreach ($_FILES as $key => $value) {
		# code...
		$filename =  str_replace(" ", "_", $_POST['nik_umkm']."_".$_POST['nama_umkm']."_".$key.".jpeg");
		$data[$key] = $filename;
		// echo "$filename";
	 
	  // Valid extension
		$valid_ext = array('png','jpeg','jpg');

		// Location
		$location = "images/".$filename;

		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower ($file_extension);
		if(in_array($file_extension,$valid_ext)){
			compressImage($value['tmp_name'],$location,60);
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
		$db->insert('umkm',$data);
		$res = $db->manual_query("select id_umkm from umkm where nama_umkm = '".$_POST['nama_umkm']."' and nik_umkm = '".$_POST['nik_umkm']."'")[0];
		header("Location: ../index.php?content=profile_umkm&id_umkm=".$res['id_umkm']."&pesan=Umkm ".$_POST['nama_umkm']." berhasil ditambahkan");
	}else{
		echo "upload gagal";
	}
	
}

if (isset($_POST['edit'])) {
	# code...
	// var_dump($_POST);
	foreach ($_POST as $key => $value) {
		# code...
		if ($key!="id" && $key!="edit") {
			# code...
			$db->edit("umkm","$key",$value,"id_umkm",$_POST['id']);
		}
	}
	$up = true;
	// print_r($_FILES);
	// die();
	foreach ($_FILES as $key => $value) {
		if ($value['size'] != 0) {
			# code...
		# code...
			$filename =  str_replace(" ", "_", $_POST['nik_umkm']."_".$_POST['nama_umkm']."_".$key.".jpeg");
			$filename = str_replace("/","_", $filename);
			$filename = str_replace("&","_", $filename);
			$data[$key] = $filename;
			// echo "$filename";
		 
		  // Valid extension
			$valid_ext = array('png','jpeg','jpg');

			// Location
			$location = "images/".$filename;

			// file extension
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower ($file_extension);
			if(in_array($file_extension,$valid_ext)){
				// echo "$location";
				unlink($location);
				compressImage($value['tmp_name'],$location,60);
				// echo "uploaded";
				echo $db->edit("umkm","$key",$filename,"id_umkm",$_POST['id']);
			}else{
				echo "Invalid file type.";
				$up = false;
			}
		}
	}
	header("Location: ../index.php?content=profile_umkm&id_umkm=".$_POST['id']);
}
if (isset($_GET['delete'])) {
	# code...
	// echo $_GET['id'];
	$db->manual_query("delete from umkm where id_umkm = ".$_GET['id']);
	header("Location: ../index.php?content=list_umkm&pesan=data umkm berhasil di hapus");
}

 ?>