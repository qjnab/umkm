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
	// var_dump($_POST);
	// var_dump($_FILES);
	$up = true;
	foreach ($_FILES as $key => $value) {
		# code...
		if  (!is_uploaded_file($value['tmp_name'])) break;
		$filename =  str_replace(" ", "_", $_POST['id_umkm']."_".$_POST['nama_produk']."_".$key.".jpeg");
		$data[$key] = $filename;
		// echo "$filename";
	 
	  // Valid extension
		$valid_ext = array('png','jpeg','jpg');

		// Location
		$location = "images/produk/".$filename;

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
	if ($up) {
		foreach ($_POST as $key => $value) {
			# code...
			if ($key != "insert" ) {
				# code...
				$data[$key] = $value;
			}
		}
		// echo "select id_umkm where nama_umkm = '".$_POST['nama_umkm']."' and nik_umkm = '".$_POST['nik_umkm']."'";
		$db->insert('produk',$data);
		// var_dump($res);
		header("Location: ../index.php?content=profile_umkm&id_umkm=".$_POST['id_umkm']."&pesan=Produk ".$_POST['nama_produk']." berhasil ditambahkan");
	}else{
		echo "upload gagal";
	}
}
if (isset($_GET['jual'])) {
	# code...
	// edit($table,$col_new,$val_new,$col_clause,$val_clause)
	$db->edit("produk","status_produk",1,"id_produk",$_GET['jual']);
	// print_r($_GET);
	$stok = $db->manual_query("select * from stok where id_produk = ".$_GET['jual']);
	// var_dump($stok);
	if ($stok == null) {
		# code...
		$data = array(
			'id_produk' => $_GET['jual'] );
		$db->insert("stok",$data);
	}
	header("Location: ../index.php?content=profile_umkm&id_umkm=".$_GET['umkm']);
}
if (isset($_GET['tarik'])) {
	# code...

	$db->edit("produk","status_produk",0,"id_produk",$_GET['tarik']);
	header("Location: ../index.php?content=profile_umkm&id_umkm=".$_GET['umkm']);
	
	// print_r($_GET);
}

if (isset($_POST['edit'])) {
	# code...
	foreach ($_POST as $key => $value) {
		# code...
		if ($key != "edit" && $key != "id_produk" && $key !="from" ) {
			# code...
			$db->edit("produk",$key,$value,"id_produk",$_POST['id_produk']);
			// $data[$key] = $value;
		}
	}
	if (isset($_FILES['foto_produk'])) {
		# code...
		// var_dump($_FILES['foto_produk']);
		foreach ($_FILES as $key => $value) {
		# code...
			$filename =  str_replace(" ", "_", $_POST['id_umkm']."_".$_POST['nama_produk']."_".$key.".jpeg");
			$update = $filename;
			// echo "$filename";
		 
		  // Valid extension
			$valid_ext = array('png','jpeg','jpg');

			// Location
			$location = "images/produk/".$filename;

			// file extension
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower ($file_extension);
			if(in_array($file_extension,$valid_ext)){
				compressImage($value['tmp_name'],$location,60);
				// echo "uploaded";
			}else{
				// echo "Invalid file type.";
			}
		}
		$db->edit("produk","foto_produk",$update,"id_produk",$_POST['id_produk']);
		if (isset($_POST['from'])) {
			header("Location: ../index.php?content=update_stok&pesan=Data ".$_POST['nama_produk']." telah di update");
		}else{
			header("Location: ../index.php?content=profile_umkm&id_umkm=".$_POST['id_umkm']);
		}

	}
}