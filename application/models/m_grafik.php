<?php
class M_grafik extends CI_Model{
 
    function get_data_stok(){
      //  $query = $this->db->query("SELECT nama,SUM(ok) AS ok FROM inputs GROUP BY nama");
       $query =$this->db->query("SELECT nama, sum(ok) as ok FROM `inputs` WHERE waktu <= DATE_ADD(CURDATE(), INTERVAL 3 DAY) AND waktu >= DATE_ADD(CURDATE(), INTERVAL -3 DAY) GROUP by nama");
    //  $query =$this->db->query("SELECT nama, sum(ok) as ok FROM `inputs` WHERE waktu = DATE_ADD(NOW()) GROUP by nama");  
 //   $query =  $this->db->query("SELECT nama, sum(ok) as ok, COUNT(id) as count,MONTHNAME(waktu) as month_name FROM inputs WHERE YEAR(waktu) = '" . date('Y') . "' GROUP BY nama");
    
  //  $query =  $this->db->query("SELECT COUNT(id) as count,MONTHNAME(created_at) as month_name FROM users WHERE YEAR(created_at) = '" . date('Y') . "'
  //    GROUP BY YEAR(created_at),MONTH(created_at)"); 
    if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function get_data_stokng(){
       // $query = $this->db->query("SELECT nama,SUM(ng) AS ng FROM inputs GROUP BY nama Having ng > 100");
        $query =$this->db->query("SELECT SUM(ng) as ng,nama as namang, MONTH(waktu) `MONTH`, YEAR(waktu) `YEAR` FROM inputs GROUP BY nama HAVING ng > 100");  

        if($query->num_rows() > 0){
            foreach($query->result() as $datang){
                $hasilng[] = $datang;
            }
            return $hasilng;
        }
    }
 
}