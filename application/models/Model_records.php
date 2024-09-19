<?php 

class Model_records extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

		public function view_all(){
		return $this->db->get('inputs')->result(); // Tampilkan semua data transaksi
	  }

	public function view_by_date($tgl_awal, $tgl_akhir){
			$tgl_awal = $this->db->escape($tgl_awal);
			$tgl_akhir = $this->db->escape($tgl_akhir);
			$this->db->where('DATE(date_time) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir); // Tambahkan where tanggal nya
			return $this->db->get('inputs')->result();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter


	}
	public function group_nama(){
		$this->db->select('nama,count(nama) as jumlahnama');
		$this->db->from('inputs');
		$this->db->group_by('nama');
		$query = $this->db->get();
		return $this->db->get('inputs')->result();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter


	}

	function hitungData()
{  
 $this->db->select('tgl, nama, 
 sum(goresan) as goresan, 
 SUM(tidaknempel) AS TIDAKNEMPEL,
		SUM(kebentur) AS KEBENTUR,
			SUM(saringanjebol) AS SARINGANJEBOL,
		SUM(gelembung) AS GELEMBUNG,
		SUM(bintik) AS BINTIK,
		SUM(lukadalam) AS LUKADALAM,
		SUM(lukaluar) AS LUKALUAR,
		SUM(retak) AS RETAK,
		SUM(bergaris) AS BERGARIS,
		SUM(hosependek) AS HOSEPENDEK,
		SUM(oper) AS OPER,
		SUM(wrappingan) AS WRAPPINGAN,
		SUM(braidingan) AS BRAIDINGAN,
		SUM(bolong) AS BOLONG,
		SUM(tipis) AS TIPIS,
		SUM(karetnempel) AS KARETNEMPEL,
		SUM(tebal) AS TEBAL,
		SUM(porisiti) AS PORISITI,
		SUM(bekastangan) AS BEKASTANGAN,
		SUM(sobek) AS SOBEK,
		SUM(oval) AS OVAL,
		SUM(benangrusak) AS BENANGRUSAK,
		SUM(siwak) AS SIWAK,
		SUM(keropos) AS KEROPOS,
		SUM(holetube) AS HOLETUBE,
		SUM(springpendek) AS SPRINGPENDEK,
		SUM(diameterkecil) AS DIAMETERKECIL,
		SUM(others) AS OTHERS,
SUM(ok) AS OK, 
SUM(ng) AS NG, 
SUM(total) AS TOTAL '); 
 //$this->db->join('tb_model','tb_asset.model = tb_model.id');
 //$this->db->join('tb_kategori', 'tb_model.kategori = tb_kategori.id'); 
 $this->db->group_by('nama');
 $this->db->order_by('id', 'desc'); 
 $query = $this->db->get('inputs');
 
 return $query;

}
}