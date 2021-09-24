<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ketersediaan extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	function manual_query($query){
		$data = $this->db->query($query);
		return $data;
	}

	function input_ketersediaan($id_komoditi,$tanggal_ketersediaan,$jumlah_ketersediaan,$jumlah_pedagang,$nama_pedagang,$pasar,$id_user,$asal_ketersediaan,$minggu,$bulan,$tahun){
		$data = $this->db->query("INSERT INTO `ketersediaan` (`id_ketersediaan`, `id_komoditi`, `tanggal_ketersediaan`, `tanggal_input`, `jumlah_ketersediaan`, `jumlah_pedagang`, `nama_pedagang`, `pasar_ketersediaan`, `id_user`,`asal_ketersediaan`,`minggu_ketersediaan`,`bulan_ketersediaan`,`tahun_ketersediaan`) VALUES (NULL, '".$id_komoditi."', '".$tanggal_ketersediaan."', CURRENT_TIMESTAMP, ".$jumlah_ketersediaan.", ".$jumlah_pedagang.", '".$nama_pedagang."', '".$pasar."', '".$id_user."' , '".$asal_ketersediaan."' , ".$minggu." , ".$bulan." , ".$tahun.")");
		
	}

	function edit_ketersediaan($coloumn,$new_val,$id){
		$data = $this->db->query("update kotersediaan set ".$coloumn." = '".$new_val."' where id_ketersediaan = ".$id);
	}
}