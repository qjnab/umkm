<?php
require('pdf/fpdf.php');
require_once '../../config/db.php';
$db = new db(); 
$pdf = new FPDF('P','mm',array(215,330));
$id = $_GET['id'];
$umkm = $db->manual_query('select * from umkm where id_umkm = '.$id)[0];
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Image('pdf/logo-pemkot.png',30,10,-1700);

if (file_exists("../images/".$umkm['foto_ktp_pemilik_umkm']) && $umkm['foto_ktp_pemilik_umkm'] !="") {
 	# code...
 	$image_format = strtolower(pathinfo("../images/".$umkm['foto_ktp_pemilik_umkm'], PATHINFO_EXTENSION));
 	$pdf->Rect(29,189,82,52);
	$pdf->Image("../images/".$umkm['foto_ktp_pemilik_umkm'],30,190,80,50,$image_format);

}
if (file_exists("../images/".$umkm['foto_ttd_umkm']) && $umkm['foto_ttd_umkm'] !="" ) {
 	# code...
 	$image_format = strtolower(pathinfo("../images/".$umkm['foto_ttd_umkm'], PATHINFO_EXTENSION));

	$pdf->Image("../images/".$umkm['foto_ttd_umkm'],80,200,80,50);
}


$pdf->Cell(200,7,'PEMERINTAH KOTA SURABAYA',0,2,'C');
$pdf->Cell(200,7,'DINAS KETAHANAN PANGAN DAN PERTANIAN',0,2,'C');

$pdf->SetFont('Arial','',12 );
$pdf->Cell(200,7,'Jalan Pagesangan II Nomor 56 Surabaya 60233',0,2,'C');
$pdf->Cell(200,7,'Telp. (031) 8282328 Fax (031) 8282328',0,2,'C');

$pdf->SetFont('Arial','B',12 );

$pdf->Cell(200,12,'FORMULIR PENDATAAN UMKM',0,2,'C');

$pdf->SetFont('Arial','',12 );

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(170,6,'Yang bertanda tangan di bawah ini,',0,2,'L');

$pdf->Cell(50,6,'UMKM',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['nama_umkm'],0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Nama (Ketua)',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['nama_pemilik_umkm'],0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'NIK',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['nik_umkm'],0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Alamat',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['alamat_ktp_umkm']." ".$umkm['gang_blok_umkm']." ".$umkm['no_rumah_umkm']." ,".$umkm['kelurahan_umkm']." , ".$umkm['kecamatan_umkm'],0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Alamat UMKM',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['alamat_ktp_umkm']." ".$umkm['gang_blok_umkm']." ".$umkm['no_rumah_umkm']." ,".$umkm['kelurahan_umkm']." , ".$umkm['kecamatan_umkm'],0,1,'L');


$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Jabatan di UMKM',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,'Ketua UMKM',0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Jumlah Anggota',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['anggota_umkm'],0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Produk',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,'$',0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Produk Unggulan',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,'$',0,1,'L');

$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(50,6,'Jumlah Produksi',0,0,'L');
$pdf->Cell(2,6,':',0,0,'L');
$pdf->Cell(2,6,$umkm['produksi_umkm'],0,1,'L');

$pdf->Cell(2,6,'',0,1,'L');


$pdf->Cell(15,6,'',0,0,'L');
$pdf->Cell(170,6,'Pelatihan yang pernah di ikuti',0,2,'L');
$pdf->Cell(170,6,'1. ....................................................................................................................................',0,2,'L');
$pdf->Cell(170,6,'2. ....................................................................................................................................',0,2,'L');
$pdf->Cell(170,6,'3. ....................................................................................................................................',0,2,'L');

$pdf->Cell(170,6,'',0,2,'L');

$pdf->Cell(170,6,'Pameran / Event yang pernah di ikuti',0,2,'L');
$pdf->Cell(170,6,'1. ....................................................................................................................................',0,2,'L');
$pdf->Cell(170,6,'2. ....................................................................................................................................',0,2,'L');
$pdf->Cell(170,6,'3. ....................................................................................................................................',0,2,'L');

$pdf->Cell(150,6,'',0,2,'L');
$pdf->Cell(170,6,'',0,2,'L');
$pdf->Cell(100,6,'',0,0,'L');

$pdf->Cell(50,6,'Surabaya, ..........................',0,2,'C');
$pdf->Cell(50,6,'Yang Membuat,',0,2,'C');
$pdf->Cell(50,6,'',0,2,'L');
$pdf->Cell(50,6,'',0,2,'L');
$pdf->Cell(50,6,'',0,2,'L');
$pdf->Cell(50,6,'',0,2,'L');
$pdf->Cell(50,6,'(.................................)images/'.$umkm['foto_ttd_umkm'],0,2,'C');


$pdf->Output();
?>
