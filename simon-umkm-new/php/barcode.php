<?php
// get the class
require_once 'BarCode128-master/src/Barcode128.class.php';
require_once '../config/db.php';
$db = new db();
$produk = $db->manual_query("select * from produk inner join umkm on produk.id_umkm = umkm.id_umkm left join diskon on produk.id_produk = diskon.id_produk where status_produk = 1");


foreach ($produk as $key => $value) {
	// Text to be converted
	$code = $value['id_produk'];

	// Text printed above the barcode
	$text = $value['nama_produk']." - ".$value['harga_produk'].' ( '.$value['jumlah_diskon'].' %)' ;

	// A font file located in the same directory
	// http://openfontlibrary.org/en/font/hans-kendrick
	$font = "BarCode128-master/data/HansKendrick-Regular.ttf";

	// corresponding fontsize in px
	$fontSize = 12;

	// height of the barcode in px
	$height = 130;

	// create an Object of BarCode128 Class
	$barcode = new AMWD\BarCode128($code, $height);

	// OPTIONAL: add the font
	// if not: no Text can be written (only bars)
	$barcode->addFont($font, $fontSize);

	// OPTIONAL: add the text above the barcode
	$barcode->CustomText($text);

	// Save the file to disk
	// $barcode->save('data/barcode.gif');
	$barcode->draw();

	echo "<br>";
}