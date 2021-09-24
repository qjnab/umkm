<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($page)
	{

	}

	public function get_data_harga($pasar){
		$this->load->model('harga');
		$data['pasar'] = $this->harga->manual_query("select * from harga where id_pasar='".$pasar."' and date(tanggal_harga) = current_date");
		// echo 'select * from harga where id_pasar="$pasar" and date(tanggal_harga) = current_date';
		// json_encode($data['pasar']);
		foreach ($data['pasar']->result_array() as  $value) {
			# code...
			$result[$value['id_komoditi']] = $value['harga_harga'];
		}
		echo json_encode($result);
	}
	public function get_data_stok($pasar){
		$this->load->model('stok');
		$data['pasar'] = $this->stok->manual_query("select * from stok where id_pasar='".$pasar."' and week(date(tanggal_stok)) = week(current_date)");
		foreach ($data['pasar']->result_array() as  $value) {
			# code...
			$result[$value['id_komoditi']] = $value['jumlah_stok'];
			// var_dump();
			// echo "<br>";
		}
		echo json_encode($result);
	}

	public function save_value_harga($kode,$harga){
		// $this->session-> ;
		$newdata = array(
        'tanggal'  	=> date("Y-m-d"),
        'kode'     => $kode,
        'harga' => $harga
		);
		$this->session->set_userdata($kode,$newdata);
		echo json_encode("saved $kode");
	}
	public function save_value_stok($kode,$stok){
		// $this->session-> ;
		$newdata = array(
        'tanggal'  	=> date("Y-m-d"),
        'kode'     => $kode,
        'harga' => $stok
		);
		$this->session->set_userdata('stk_'.$kode,$newdata);
		echo json_encode("saved $kode");
	}
	public function get_value_harga($kode){
		if ($this->session->has_userdata($kode)) {
			# code...
			if ($this->session->userdata($kode)['tanggal']==date("Y-m-d")) {
				# code...
				echo json_encode($this->session->userdata($kode));
			}
		}
	}
	public function get_value_stok($kode){
		$kode = 'stk_'.$kode;
		if ($this->session->has_userdata($kode)) {
			# code...
			if ($this->session->userdata($kode)['tanggal']==date("Y-m-d")) {
				# code...
				echo json_encode($this->session->userdata($kode));
			}
		}
	}

	public function get_manual($pasar,$tipe,$tanggal){
		$this->load->model($tipe);
		$data = $this->{$tipe}->manual_query("select * from ".$tipe." where id_pasar = ".$pasar." and date(tanggal_".$tipe.") = cast('".$tanggal."' as date)");
		foreach ($data->result_array() as  $value) {
			# code...
			$result[$value['id_komoditi']] = $value['harga_harga'];
		}
		echo json_encode($result);
	}

	public function get_grafik_komoditi($id_komoditi,$id_pasar){
		// $this->load->model('komoditi');
		$this->load->model('harga');
		$result = $this->harga->manual_query('select * from harga where id_komoditi = '.$id_komoditi.' and id_pasar = '.$id_pasar.' order by tanggal_harga limit 5')->result();
		echo json_encode($result);
	}

	public function get_data_ketersediaan($tanggal,$id_pasar){
		echo "ok";
	}

	public function save_webconfig($minggu,$bulan,$tahun){
		$this->load->model('webconfig');
			$this->webconfig->manual_query("update webconfig set minggu_ketersediaan_webconfig = ".$minggu." where id_webconfig = 1");
		
			$this->webconfig->manual_query("update webconfig set bulan_ketersediaan_webconfig = ".$bulan." where id_webconfig = 1");
		
			$this->webconfig->manual_query("update webconfig set tahun_ketersediaan_webconfig = ".$tahun." where id_webconfig = 1");
		echo json_encode("sukses");
	}
	public function save_tanggal_harga($tanggal){
		$this->load->model('webconfig');
			$this->webconfig->manual_query("update webconfig set tanggal_harga_webconfig = '".urldecode($tanggal)."' where id_webconfig = 1");
		echo json_encode("update webconfig set tanggal_harga_webconfig = '".urldecode($tanggal)."' where id_webconfig = 1");
	}

	public function get_tanggal_harga(){
		$this->load->model('webconfig');
		$res =	$this->webconfig->manual_query("select tanggal_harga_webconfig from webconfig where id_webconfig = 1")->result();
		echo json_encode($res);
	}
	public function lihat_harga(){
		$this->load->model('harga');
		$this->load->model("pasar");
		$query = "select * from pasar where nama_pasar in ('Tambahrejo','Pucang Anom','Wonokromo','Genteng Baru','Pabean','Kembang','Balongsari','Kendangsari') order by field( nama_pasar , 'Tambahrejo','Pucang Anom','Wonokromo','Genteng Baru','Pabean','Kembang','Balongsari','Kendangsari' )";
		$data['allpasar'] = $this->pasar->manual_query($query);
		$this->load->model("komoditi");
		$query = "select * from komoditi where status_komoditi=1 order by nama_komoditi asc";
		$data['allkomoditi'] = $this->komoditi->manual_query($query);
		foreach ($data['allkomoditi']->result() as $value) {
			$query = 'select harga_harga,komoditi.nama_komoditi,pasar.nama_pasar, status_harga from harga inner join pasar on harga.id_pasar = pasar.id_pasar inner join komoditi on harga.id_komoditi=komoditi.id_komoditi where harga.id_komoditi = '.$value->id_komoditi.' ';
			if (isset($_GET['tgl'])) {
				# code...
				$query.=" and date(tanggal_harga) = CAST('".$_GET['tgl']."' AS DATE)";
				$data['date']= $_GET['tgl'];
				$req = true;
				$data['query'] = $query;
			}else{
				$query.=" and date(tanggal_harga) = curdate()";

			}
			$query.= " and pasar.nama_pasar in ('Tambahrejo','Pucang Anom','Wonokromo','Genteng Baru','Pabean','Kembang','Balongsari','Kendangsari') order by pasar.nama_pasar asc ";
			$res = $this->harga->manual_query($query);
			$data['harga'][$value->id_komoditi] = $res->result();
			// $data['query'][$value->id_komoditi] = $query;
			
		}
		$data['pasar'] = $data['allpasar']->result();
		$data['komoditi'] = $data['allkomoditi']->result();
		echo json_encode($data);
	}
}