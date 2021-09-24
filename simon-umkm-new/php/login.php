<?php 
session_start();
if (isset($_SESSION['name'])) {
	# code...
	header("Location: ../index.php?pesan=Anda Sudah Login");
}
require '../config/db.php';
$db = new db();
$pass = md5($_POST['password']);
$username = $_POST['username'];
$res = $db->manual_query("select * from user where nama_user = '$username' and password_user = '$pass'");
if ($res != null) {
	# code...
	$_SESSION['name'] = $res[0]['nama_user'];
	$_SESSION['role'] = $res[0]['role_user'];
	$_SESSION['id'] = $res[0]['id_user'];

	$_SESSION['kecamatan'] = $res[0]['kecamatan_user'];
	header("Location: ../index.php");

}else{
	
		header("Location: ../login.php?pesan=Login Gagal ! Username / Password Salah");
	
}
?>
