<?php
require_once '../config/db.php';
$db = new db();
$umkm = $db->manual_query("select * from umkm where id_umkm = ".$_POST['id_umkm'])[0];

$data = $_POST['foto'];
$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));

$filename =  str_replace(" ", "_", $umkm['nik_umkm']."_".$umkm['nama_umkm']."_"."foto_ttd_umkm".".jpg");
$filename = str_replace("/","_", $filename);
$filename = str_replace("&","_", $filename); 

file_put_contents('images/'.$filename, $data);

$db->edit("umkm","foto_ttd_umkm",$filename,"id_umkm",$_POST['id_umkm']);

header("Location: ../index.php?content=profile_umkm&id_umkm=".$_POST['id_umkm']);

?>















