<?php
/**
 * Description of Curd Model: Datatables Add, View, Edit, Delete, Export and Custom Filter Using Codeigniter with Ajax
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
//if (!defined('BASEPATH'))
 //   exit('No direct script access allowed');

class Model_filter extends CI_Model {

public function __construct()
	{
		parent::__construct();
	}
    public function gettahun()
    {
       
        $query = $this->db->query("SELECT YEAR(date_time) as tahun FROM inputs GROUP BY YEAR (date_time) ORdER BY YEAR(date_time) asc;");
        return $query->result();
    }
    
    
    public function filterbytanggal($tanggalawal, $tanggalakhir) 
    {        
           
        $query = $this->db->query("SELECT * FROM inputs WHERE date_time BETWEEN '$tanggalawal' and '$tanggalakhir' order by date_time asc");
       return $query->result();
    }
    public function filterbybulan($tahun1, $bulanawal, $bulanakhir) 
    {        
           
        $query = $this->db->query("SELECT * FROM inputs WHERE YEAR (date_time)='$tahun' AND MONTH(date_time) BETWEEN '$bulanawal' and '$bulanakhir' order by (date_time) asc");
        return $query->result();
    }
   
    public function filterbytahun($tahun2) 
    {        
           
        $query = $this->db->query("SELECT* from inputs WHERE YEAR(date_time)='$tahun2' ORDER BY date_time asc");
       return $query->result();
    } 
   
}